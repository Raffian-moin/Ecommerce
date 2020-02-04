<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function PresentPrice(){
    	return "$ ".number_format($this->price / 100);
    }
}
