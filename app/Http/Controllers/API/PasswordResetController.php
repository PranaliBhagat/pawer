<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Notification;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\UserModel;
use App\PasswordResetModel;
/**
 * @resource ResetPassword
 * 
 */
class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    /**
     * @bodyParam email email required Email of the User.
     * 
     * @response {
     *  "message":"We have e-mailed your password reset link!"
     * }
     */ 
    public function create(Request $request)
    {
      
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = UserModel::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);

        $passwordReset = PasswordResetModel::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
             ]
        );
     // print_r($passwordReset->token);
      //exit();
        if ($user && $passwordReset)

             $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
     /**
     * @bodyParam token string required Password Token.
     * 
     * @response {
     *  
     * }
     */ 
    public function find($token)
    {
        //dd($token);
        $passwordReset = PasswordResetModel::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
     
     /**
     * @bodyParam email email required Email of the Login.
     * @bodyParam password string required Password of the Login.
     * @bodyParam password_confirmation string required Confirm Password of the Login.
     * @bodyParam token string required Token.
     * @response {
     *  "message":"We have e-mailed your password reset link!"
     * }
     */ 
    public function reset(Request $request)
    {
       
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordResetModel::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();

       
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
      
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json($user);
    }
}
