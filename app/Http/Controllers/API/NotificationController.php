<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 

use App\Http\Controllers\Controller; 
use App\UserModel; 
use App\NotificationModel; 
use App\UserNotificationModel; 
use App\User; 
Use DB;
use Illuminate\Support\Facades\Auth; 

class NotificationController extends Controller 
{
public $successStatus = 200;

    public function addpoints(Request $request)
    { 
             //$users = UserModel::find($request->id);
          	$users = UserModel::where('id', $request->id)->get()->first();  
          	if($users == Null)
          	{
          		$success['status'] = 404;
              $success['message'] = "User information Not Found";
              $success['user-info'] = $users;
              return response()->json(['success' => $success], $this-> successStatus); 
          	}
        
             $users->points = $request->points;
             $users->save();
             $success['status'] = 200;
             $success['message'] = "Successfully Added Points";
             $success['user-info'] = $users;
              return response()->json(['success' => $success], $this-> successStatus); 
    }
    

    public function getallnotification(Request $request)
    { 
      $users = UserModel::where('id', $request->id)->get()->first();  
      if($users == Null)
      {
        $success['status'] = 404;
        $success['message'] = "User information Not Found";
        $success['user-info'] = $users;
        return response()->json(['success' => $success], $this-> successStatus); 
      }
             $notification = DB::table('usernotification')->where('user_id', $request->id)
           ->join('notification', 'usernotification.noti_id', '=', 'notification.id')->get();  
          
             $success['status'] = 200;
             $success['message'] = 'OK';
             $success['Notification'] = $notification;
            
             return response()->json(['success' => $success], $this-> successStatus); 
    }

}