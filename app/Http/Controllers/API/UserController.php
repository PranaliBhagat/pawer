<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\UserModel;
use Mail;
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
//public $data;
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        { 
            $user = Auth::user(); 
            //  print_r($user->status_id);
            //exit();
            if($user->status_id == 1)
            {
              $success['status'] = 201;
              $success['message'] = "Waiting for Approval from parent";
              $success['user-info'] = $user;
              return response()->json(['success' => $success], $this-> successStatus); 
            }
            elseif ($user->status_id == 3) 
            {
              $success['status'] = 202;
              $success['message'] = "Sorry , Your application is Rejected";
              $success['user-info'] = $user;
              return response()->json(['success' => $success], $this-> successStatus); 
            
            }
           
          //  $success['token'] =  $user->createToken('MyApp')-> accessToken; 
             elseif ($user->status_id == 2) 
             {
              $success['status'] = 200;
              $success['message'] = "Login Successfull";
              $success['user-info'] = $user;
              return response()->json(['success' => $success], $this-> successStatus); 
            }
        } 
        else
        { 
             $success['status'] = 401;
              $success['message'] = "Unauthorized! Invalid Credentials. ";
              $success['user-info'] = $user;
              return response()->json(['success' => $success], $this-> successStatus); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users',        
            'password' => 'required', 

            //'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) 
        { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
       

    //  $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        

        //send mail
       $data = array('name'=> $request->name ,
                    'email'=> $request->email,
                    'parent_name'=> $request->parent_name,
                    'parent_address'=> $request->parent_address,
                   );
      // print_r($data);
     // exit();
        $email = $request->email;
     
       Mail::send(['html'=>'mail'], $data, function($message)  use ($data)
         {
           $message->to( $data['email'], $data['name'])->subject
                      ('Welcome to Pawer Learning ');
           $message->from('admin@pawerlearning.com','Pawer Learning');
         });
        

      if ($request->parent_address != null)
      {
          Mail::send(['html'=>'mails.parentmail'], $data, function($message)  use ($data)
        {
            $message->to($data['parent_address'], $data['parent_name'])->subject
            ('Please approve or reject registration'); 
            $message->from('admin@pawerlearning.com','Pawer Learning');

        });
    
      }
            $success['status'] = 200;
              $success['message'] = "Registration Successfull";
              $success['user-info'] = $user;

         return response()->json(['success' => $success], $this-> successStatus); 
    }

        /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 

     public function updatetoken(Request $request) 
    { 

       // print_r($request->token);
       //  exit();
        $users = UserModel::where('id', $request->id)->get()->first();  
        // print_r($users);
        // exit();
            if($users == Null)
            {

              $success['status'] = 404;
              $success['message'] = "User information Not Found";
              $success['user-info'] = $users;
              return response()->json(['success' => $success], $this-> successStatus); 
            }
        
             $users->token = $request->token;
             $users->save();
             $success['status'] = 200;
             $success['message'] = "Successfully Saved Token";
             $success['user-info'] = $users;
              return response()->json(['success' => $success], $this-> successStatus); 
     } 




}