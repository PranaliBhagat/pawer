<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
Use DB;
use Mail;
use Response;

class ReguserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserModel::All();
        return view('home')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
       $user = UserModel::find($id);
       if($user->status_id== 1)
       {
        $status= 'Pending';

       }
      else if($user->status_id== 2)
       {
        $status= 'Approved';
        
       }
      else if($user->status_id== 3)
       {
        $status= 'Rejected';
        
       }
      
       //return view('edit')-> with('user',$users);
  
       return view('edit',compact('user','status'));
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
       // dd('hi'); 
    	
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'dob' => 'required',           
            'email' => 'required|email',           
            'parent_contact' => 'min:8|numeric',
            'parent_address' => 'email',
        ]);

//       $user = UserModel::where('user_email', $user_email)->get()->first();  
//dd($request->btn_status);
  $users = UserModel::find($id);
  //   switch($request->btn_status) 
  //   {

  //   case 'Approve':   
  // //  dd('accept');
  //     $users->status_id = 2;
  //   break;

  //   case 'Reject': 
  // //  dd('Reject');
  //   //  $status= UserModel::where('email', $email)->update(array('status_id' =>'3')); 
  //     $users->status_id = 3;
  //   break;
  //   }

	// $user_firstname= UserModel::where('email', $email)->update(array('user_firstname' =>$request-> input('firstname')));  
        $users->user_firstname = $request-> input('firstname');
        $users->user_lastname = $request-> input('lastname');
        $users->name = $request-> input('username');
        $users->user_dob = $request-> input('dob');
        $users->email = $request-> input('email');
        $users->parent_name = $request->input('parent_name');
        $users->parent_name = $request->input('parent_name');
        $users->parent_contact = $request->input('parent_contact');
        $users->parent_address = $request->input('parent_address');
        $users->status_id = $request->input('status');
        $users->save();

     return redirect('/home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // dd('delete');
         $users = UserModel::find($id);
        $users->delete();
        return redirect('/home')->with('status','User Deleted Successfully');
    }

    public function changepwd($id)
    { 
       $user = UserModel::find($id);
         
       return view('changepwd',compact('user'));
    }

     public function changepassword(Request $request, $id)
    {
    	 $request->validate([
         'newpassword' =>'required',
         'confirmpassword'=>'required|same:newpassword',
           
        ]);
         $users = UserModel::find($id);
         $encryptpassword = bcrypt($request-> input('newpassword'));       
    	   $users->password = $encryptpassword;
         $users->save();
        // $status= UserModel::where('email', $email)->update(array('password' =>$encryptpassword)); 
         return redirect('/home')->with('status','Password Changed Successfully');;

    }

    public function statusaccept( Request $request , $email )
    {
     
      $status= UserModel::where('email', $email)->update(array('status_id' => 2 ));
      $users = UserModel::where('email', $email)->get()->first();    
      $data = array(
                    'name' =>  $users->name,
                    'email'=>  $email
                   );

       Mail::send(['html'=>'mails.usermail'], $data, function($message)  use ($data)
         {
                $message->to( $data['email'], $data['name'])->subject
                      ('Welcome to Pawer Learning ');
                 $message->from('admin@pawerlearning.com','Pawer Learning');
         });
       return View('/status'); 
    }

  public function statusreject( Request $request , $email)
      {  
        $status= UserModel::where('email', $email)->update(array('status_id' => 3 ));
        return View('/mails.reject'); 
      }


 public function search(Request $request)
 {
       // dd($request);
        $q = $request->input('q');
       // dd( $q);
        $names = explode(" " , $q);
      //  dd(count($names));

        if($q != "")
        {

        // $users = UserModel::where('user_firstname','LIKE', $names[0].'%')->orWhere('user_lastname','LIKE', '%'.$names[1].'%')->orWhere(DB::raw("CONCAT('user_firstname', ' ', 'user_lastname')",'LIKE', '%'.$q.'%'))->orWhere('status_id','LIKE', '%'.$q.'%')->paginate(50);
            // Split each Name by Spaces
    
    // Search each Name Field for any specified Name
        $users = UserModel::where(function($query) use ($names) {
        $query->whereIn('user_firstname', $names);
        $query->orWhere(function($query) use ($names) {
            $query->whereIn('user_lastname', $names);
        });
      })->get(); 
  //For exact search
       $users = UserModel::whereRaw('CONCAT(user_firstname, " ", user_lastname) LIKE ? ', '%' . $q . '%')->get();  
    //  dd(count($users));     
      if (count($users) <=0) 
       {
       //dd(count($users));
      // $users = UserModel::where('role', 2)->get();  
        return view('home',compact('users'));
        }
    else
       {
     //  dd($q);
        return view('home',compact('users',$q));
       }
      }

         else
           {
            //dd(' users');
             return redirect('/home');
           }
  }


  public function getUsers($status)
  {
 //  dd($status);
      if($status== 0)
        {
           $users = UserModel::where('role', 2)->get()->toArray(); 
        }
       else
        {
            $users = UserModel::where('status_id', $status)->get()->toArray();       
         //  return view('home')->with('users',$users);      
        }
      //  return view('home')->with('users',$users);   
       return response($users);
}
public function approve(Request $request)
{
   // dd($request->status);
  if($request->status== 0)
  {
    $users = UserModel::where('role',2)->get();  
    return view('home')->with('users',$users);
  }
  else
  {
      $users = UserModel::where('status_id',$request->status)->get();  
      if(count($users)<=0)
      {
      //  $users = UserModel::where('role',2)->get();  
        return view('home',compact('users'))->with('status','No result found');
      }
      return view('home')->with('users',$users);
  }
   
//
    
}

public function adminpassword(Request $request)
{
  
    
  return View('/adminpwd'); 

}

public function adminpwd(Request $request)
{
   $request->validate([
     'newpassword' =>'required',
     'confirmpassword'=>'required|same:newpassword',
       
    ]);
    $users = auth()->user();
  //  dd($users);
//    $users = Auth::find();
     $encryptpassword = bcrypt($request-> input('newpassword'));       
     $users->password = $encryptpassword;
     $users->save();
    // $status= UserModel::where('email', $email)->update(array('password' =>$encryptpassword)); 
     return redirect('/home')->with('status','Password Changed Successfully');;

}
}
