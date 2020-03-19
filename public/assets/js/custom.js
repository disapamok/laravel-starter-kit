Dropzone.autoDiscover = false;
$(document).ready(function () {
    var token = $('meta[name="csrf-token"]').attr('content');

    $(".upload-field").dropzone({
        paramName: Name,
        url: UploadURL,
        params: {
            path: UploadDir,
            name: Name,
            _token: token
        },
        dictDefaultMessage: "Drop or click to upload images",
        clickable: true,
        maxFilesize: 8,
        addRemoveLinks: true,
        uploadMultiple: false,
        maxFiles: MaxFileCount,
        init: function (){
            const DZ = this;
            $.ajax({
				url: FetchURL,
				type: 'POST',
				dataType: 'json',
				data: {
                    _token: token,
					path: UploadDir
				},
			})
			.done(function(data) {
				for (const key in data.files) {
                    var resOb = data.files[key];
                    var mockFile = { name: resOb.name, size: resOb.size };

                    DZ.emit('addedfile',mockFile);
                    DZ.createThumbnailFromUrl(mockFile, resOb.url);
                    DZ.emit("complete", mockFile);
                }
			})
			.fail(function(e) {
				console.log(e);
			});
        },
        removedfile: function (file) {
            // @TODO : Make your own implementation to delete a file
            file.previewElement.remove();
            $.ajax({
				url: RemoveURL,
				type: 'POST',
				dataType: 'json',
				data: {
                    _token: token,
                    fileDir: UploadDir,
					fileName: file.name
				},
			})
			.done(function(data) {
				//console.log(data);
			})
			.fail(function(e) {
				//console.log(e);
			});
        },
        queuecomplete: function (e) {
            //console.log(e);
            // @TODO : Ajax call to load your uploaded files right away if required
        },
        success: function(event,data){
            $("input[name='uploaded_image']").val(data.image);
        }
    });

});

$(document).on('click','.submit-nearby',function (){
   $("form[data-modal='"+$(this).attr('data-modal')+"']").submit();
});

/*
Zoom Gallery
*/
$('.zoom-gallery').magnificPopup({
    delegate: 'a',
    type: 'image',
    closeOnContentClick: false,
    closeBtnInside: false,
    mainClass: 'mfp-with-zoom mfp-img-mobile',
    image: {
        verticalFit: true,
        titleSrc: function(item) {
            return item.el.attr('title') + ' &middot; <a href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
        }
    },
    gallery: {
        enabled: true
    },
    zoom: {
        enabled: true,
        duration: 300, // don't foget to change the duration also in CSS
        opener: function(element) {
            return element;
        }
    }
});
