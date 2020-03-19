<?php

namespace App\Components;

class Modal{
    public $title,$id,$action,$close = true, $submit = true;
    public $fields,$submitBtn, $updateBtn,$updateAction,$deleteAction;

    public function __construct($title,$id,$action,$close = true, $submit = true, $submitBtn = 'Save', $updateBtn = 'Update'){
        $this->title = $title;
        $this->id = $id;
        $this->action = $action;
        $this->close = $close;
        $this->submit = $submit;
        $this->submitBtn = $submitBtn;
        $this->updateBtn = $updateBtn;
        return $this;
    }

    public static function Create($title,$id,$action,$close = true, $submit = true){
        return new Modal($title,$id,route($action),$close,$submit);
    }

    public function fields($fields){
        $this->fields = $fields;
        return $this;
    }

    public function getFields(){
        return $this->fields;
    }

    public function id(){
        return $this->id;
    }

    public function updTitle($title){
        $this->updateTitle = $title;
        return $this;
    }

    public function upAction($route){
        $this->updateAction = route($route);
        return $this;
    }

    public function delAction($delAction){
        $this->deleteAction = route($delAction);
        return $this;
    }

}
