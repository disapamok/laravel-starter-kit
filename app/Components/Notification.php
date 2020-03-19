<?php 

namespace App\Components;

class Notification{
    public static $ERROR = 'error', $SUCCESS = 'success', $WARNING = 'warning';
    public $title, $message,$type;

    public function __construct($title,$message,$type = 'success'){
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        return $this;
    }    

    public function title(){
        return $this->title;
    }

    public function message(){
        return $this->message;
    }
}