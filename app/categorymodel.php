<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorymodel extends Model
{
	 protected $table = 'category'; // table name
	 public $timestamps = false;

	  protected $fillable = [
        'category_name', 'age_group', 'color'
    ];
}
