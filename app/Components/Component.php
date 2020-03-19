<?php

namespace App\Components;

class Component{
    public $title,$name,$type,$classes,$styles,$placeholder,$groupClasses,$rules,$value,$uploadURL,$maxfiles = 1,$removeURL, $fetchURL, $uploadDir;

    public function __construct($title,$name,$placeholder="",$type="text",$classes = "", $styles = "",$groupClasses ="",$value = ""){
        $this->title = $title;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->classes = $classes;
        $this->styles = $styles;
        $this->groupClasses = $groupClasses;
        $this->value = $value;
        return $this;
    }

    public static function Create($title="",$name,$placeholder="",$type="text",$classes = "", $styles = "",$groupClasses =""){
        $class = get_called_class();
        $thisOb = new $class($title,$name,$placeholder,$type,$classes, $styles,$groupClasses);
        return $thisOb;
    }

    public function rules($rules){
        $this->rules = $rules;
        return $this;
    }

    public function value($value){
        $this->value = $value;
        return $this;
    }

    public function getRules(){
        return $this->rules;
    }

    public function hasRule(){
        return $this->rules != '';
    }

    public function uploadURL($uploadURL){
        $this->uploadURL = $uploadURL;
        return $this;
    }

    public function getUploadURL(){
        return route($this->uploadURL);
    }

    public function maxFiles($value){
        $this->maxfiles = $value;
        return $this;
    }

    public function getMaxFiles(){
        return $this->maxfiles;
    }

    public function removeURL($route){
        $this->removeURL = route($route);
        return $this;
    }

    public function getRemoveURL(){
        return $this->removeURL;
    }

    public function getFetchURL(){
        if(isset($this->fetchURL))
            return route($this->fetchURL);
    }

    public function fetchURL($route){
        $this->fetchURL = $route;
        return $this;
    }

    public function uploadDir($uploadDir){
        $this->uploadDir = $uploadDir;
        return $this;
    }

    public function getUploadDir(){
        return $this->uploadDir;
    }
}
