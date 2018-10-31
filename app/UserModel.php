<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Notification;
class UserModel extends Model
{
	use Notifiable;
	 protected $table = 'users'; // table name
	 public $timestamps = false;
}
