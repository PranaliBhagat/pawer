<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotificationModel extends Model
{
    protected $table = 'usernotification'; // table name
	 public $timestamps = false;

	  protected $fillable = [
       'id', 'user_id','noti_id'
    ];
}
