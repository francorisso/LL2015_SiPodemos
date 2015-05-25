<?php
namespace App\Models;

class Picture extends \Eloquent {

  public function getImagePath(){
    return storage_path() . '/app/images/' . $this->filename;
  }

}