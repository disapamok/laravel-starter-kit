<div class="modal fade" id="{{$modal->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">{{$modal->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form data-modal="{{$modal->id}}" method="POST" action="{{$modal->action}}" enctype='multipart/form-data'>
                    {{csrf_field()}}
                    @foreach ($modal->fields as $field)
                        {!!$field->get()!!}
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button data-modal="{{$modal->id}}" type="button" class="btn btn-primary waves-effect waves-light submit-nearby">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
