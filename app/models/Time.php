<?php
class Time extends Eloquent {
//    protected $table = 'times';
    public $timestamps = false;
  public function user(){
    return $this->hasMany('User');
  }

}