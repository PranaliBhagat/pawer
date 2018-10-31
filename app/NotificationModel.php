<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    protected $table = 'notification'; // table name
	 public $timestamps = false;

	  protected $fillable = [
       'id', 'category_id','category_name', 'age_group','type', 'title','message','url','image','question','option1','option2','option3','option4','correctoption','correctpoints','wrongpoints'
    ];
}
