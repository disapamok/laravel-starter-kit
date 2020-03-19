<?php

namespace App\Http\Controllers\ActionControllers;

use App\Components\UploadField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageComponentController extends Controller
{
    public function customers(){
        return view('admin.image-uploader')->with(array(
            'view' => true,
            'component' => UploadField::Create('Customer Images','cus_logo')->uploadURL('uploadImages')->maxFiles(20)->removeURL('removeCusLogo')->fetchURL('getUploads')->uploadDir('customers/'),
            'title' => 'Customer Logos'
        ));
    }

    public function getUploads(Request $request){
        $dir = $request->path;

        $filesWithSizes = array();
        $files = Storage::disk('public')->files($dir);
        foreach ($files as $key => $file) {
            $filesWithSizes[$key]['name'] = explode('/',$file)[1];
            $filesWithSizes[$key]['size'] = Storage::disk('public')->size($file);
            $filesWithSizes[$key]['url'] = asset('storage/'.$file);
        }

        return response()->json(array(
            'files' => $filesWithSizes
        ));
    }

    public function uploadImages(Request $request){
        if ($request->hasFile($request->name)){
            $img = $request->file($request->name);
            Storage::putFileAs($request->path, $img, $img->getClientOriginalName());
            return response()->json(array(
                'success' => true,
                'image'   => Storage::url($request->path.$img->getClientOriginalName())
            ));
        }
    }

    public function deleteLogo(Request $request){
        $filename = $request->fileName;
        $fileDir = $request->fileDir;

        Storage::delete($fileDir.$filename);

        return response()->json(array(
            'success' => true,
            'filename' => $filename
        ));
    }

}
