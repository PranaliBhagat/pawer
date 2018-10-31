<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationModel;
use App\UserNotificationModel;
Use DB;
use App\categorymodel;
use App\UserModel;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notification = NotificationModel::All();
        //dd($notification);
        return view('notification.index')->with('notification',$notification);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
      {
        // $getid =   categorymodel::find($id);
        //  $getid = find::$category->id;
        //dd($getid);
        // dd($request->id);

     

         $category = new categorymodel;
         //$category = categorymodel::All();
         $category_id= $request->id;
         $category = categorymodel::where('id', $category_id)->get()->first(); 
         $category_name = $category->category_name;
        //dd( $category->age_group);
          $age_group =  explode (',', $category->age_group);

            
            //dd( $category_name,$age_group) ;
         return view('notification.create', compact('category_name','age_group','category')); 
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       //dd($request->category_name);
        $notification = new NotificationModel;
       
   
        $category = categorymodel::where('category_name', $request->category_name)->get()->first();  
        //dd($category);  
        $notification->category_id = $category->id;
        $notification->category_name = $category->category_name;
        $notification->age_group =  implode(', ',$request->age_group);

        //$users = UserModel::where('age_group', $request->age_group)->get();  
        // dd($users);
        

        //  $file = $request->logo->store('images');
      
        // dd($category->age_group);

        // if($request->title != null )

        if($request->type[0] == 'url' )
        { 
            //dd("url");


         $this->validate($request, [
               'title' => 'required',
                'message' => 'required',
                'url' => 'required'
        ]);
                  $notification->type= 'URL';
                  $notification->title= $request->title;
                  $notification->message= $request->message;
                  $notification->url= $request->url;
        }
        else
        {

         $this->validate($request, [
               'normaltitle' => 'required',
                'normalmessage' => 'required',
                'image' => 'required'
        ]);
                
                  $notification->type= 'Normal';
                  $notification->title= $request->normaltitle;
                  $notification->message= $request->normalmessage;
                 //$file = $request->image->storeAs('logos', $request->logo->getClientOriginalName());
                  $file = $request->image->store('images');
                  $notification->image = $file;     
        }
           $this->validate($request, [
               'question' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'option3' => 'required',
                'option4' => 'required',
                'correctoption' => 'required',
                'correctpoints' => 'required',
                'wrongpoints' => 'required'
        ]);
           $notification->question = $request->question;
           $notification->option1 = $request->option1;
           $notification->option2 = $request->option2;
           $notification->option3= $request->option3;
           $notification->option4= $request->option4;
           $notification->correctoption = $request->correctoption;
           $notification->correctpoints= $request->correctpoints;
           $notification->wrongpoints = $request->wrongpoints;       
           $notification->save();

        $users = UserModel::where('role', 2)->get();   
        $tokens =$users->pluck('token');
        $user_id= $users->pluck('id');

        $noti_id  = NotificationModel::find(DB::table('notification')->max('id'));
        $max_id =$noti_id->id;
     
        foreach($user_id as $id)
        {
             $usernotification = new UserNotificationModel;
             $usernotification->user_id =  $id;
             $usernotification->noti_id =  $max_id;
             $usernotification->save();
        }

     
        // $token= 'eai7eYsv6o8:APA91bHgZtfsFvYx4LCVHXvhPwjotz0tivoJ-_JJ91kzSub28aQPOmN-Ay_pHlGUuh5KS68DOtUUDVP85LH_5xhitKbzupXh2bzZ3b3BnH6P3oH62X6QHSerASljcwMEnFRqbuwpYrrC','dPqZObXnhk0:APA91bGXF6k2cFhSGYXag37K43fS53TglgPO2X8mbsAcUZcUo9NnoLGgUdzc5UuOpLyz7UDGWubAahXxym6QXdf1kRgiUdWzoXHuCY7PKkbW8saVpYwz-VoxPd_sEae4TlWX8zByULkw_wD97cYiyLefl1cKZCPRhA';  
   
       return $this->test($request->title,$request->message,$tokens);
        //return redirect('/notification');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $notification = NotificationModel::find($id);
      // dd($notification->type);
       return view('notification.view')-> with('notification',$notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $notification = NotificationModel::find($id);
      
      //  $category_id = $notification->category_id;
        $notification->delete();
        return redirect('/category');//->with('success','Post Removed');
    }

    public function test($title,$message,$token)
    {

       // dd($token);
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
   
    

    $notification = [
        'title' =>$title,
        'body' => $message,
        'sound' => true
    ];
    
    $extraNotificationData = ["message" => $notification];

    $fcmNotification = [
        'registration_ids' => $token, //multple token array
     //   'to'        => $token, //single token
        'notification' => $notification,
        'data' => $extraNotificationData
    ];

    $headers = [
        'Authorization: key=AIzaSyCoTlh7BxFMy9-U60wgpWu3uKrsc0KiPMg',
        'Content-Type: application/json'
    ];


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    $result = curl_exec($ch);
    curl_close($ch);
   //dd($result);
 //  return redirect('/category')->with('status','Notification Sent Successfully');
    return redirect('/category/$category_id/edit')->with('status','Notification Sent Successfully');
 
    }   
}
