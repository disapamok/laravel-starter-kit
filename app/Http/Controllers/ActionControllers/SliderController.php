<?php

namespace App\Http\Controllers\ActionControllers;

use Illuminate\Http\Request;
use App\Components\HiddenField;
use App\Components\Modal;
use App\Components\TextField;
use App\Components\UploadField;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller{

    public $sliderModal;

    public function __construct(){
        $fields = array(
            TextField::Create('Title','title','Title of the slide')->rules('required'),
            TextField::Create('Caption','caption','Caption')->rules('required'),
            UploadField::Create('Slider Image','slider_image')->uploadURL('uploadSliderImage'),
            HiddenField::Create('','uploaded_image')->rules('required')->value(''),
            HiddenField::Create('','id')->value(''),
        );
        $this->sliderModal = Modal::Create('Add Slider','make_slider','makeSlider')->fields($fields)->updTitle('Update Slider')->upAction('dashboard')->delAction('dashboard');
    }

    /*
    Homepage sliders
    */
    public function sliders(){
        $data = Slider::all();
        return view('admin.object-handler')->with(array(
            'modal' => $this->sliderModal,
            'data'  => $data
        ));
    }

    /*
    Upload homepage slider images
    */
    public function uploadSliderImage(Request $request){
        if ($request->hasFile('slider_image')){
            $img = $request->file('slider_image');
            Storage::putFileAs('slider/', $img, $img->getClientOriginalName());
            return response()->json(array(
                'success' => true,
                'image'   => Storage::url('slider/'.$img->getClientOriginalName())
            ));
        }
    }

    public function makeSlider(Request $request){

        $rules = array();
        foreach($this->sliderModal->fields as $field){
            if($field->hasRule())
                $rules[$field->name] = $field->rules;
        }

        //var_dump($rules); exit();

        $validator = validator($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $slider = new Slider();
            $slider->title = $request->title;
            $slider->caption = $request->caption;
            $slider->img = $request->uploaded_image;
            $slider->save();

            return redirect()->back()->with(array(
                'success' => 'true'
            ));
        }
    }


}
