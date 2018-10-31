<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
Use Session;
use Illuminate\Support\Facades\Auth;  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $login_user_id = auth()->user()->id;
      
          $loginuser = UserModel::where('id', $login_user_id)->get()->first();  
          $role = $loginuser->role;
            //dd($role);
        if($role == 1)
        {
           // dd("Admin");
     //    $users = UserModel::All();
            $users = UserModel::where('role', 2)->get();  
     
             return view('home')->with('users',$users);
         }
         else
         {
            //  dd("User");
           // Session::flush();
            Auth::logout();
           return view('auth/login');
//
         }
    }
}
