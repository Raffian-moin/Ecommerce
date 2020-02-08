<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function PresentPrice(){
    	return "$ ".number_format($this->price / 100);
    }

    public function ScopeMightAlsoLike($query){
    	return $query->inRandomOrder()->take(4);
    }
}
