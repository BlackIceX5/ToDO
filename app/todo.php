<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class todo extends Model
{
    protected $fillable = ['title', 'description', 'state'];
	public $timestamps = false;
}
