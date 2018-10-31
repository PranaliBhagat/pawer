<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\categorymodel; 
use App\Users; 
use Illuminate\Support\Facades\Auth; 

class CategoryController extends Controller 
{
public $successStatus = 200;

    public function getallcategory()
    { 
              $category = categorymodel::All();
             // $success['token'] =  $user->createToken('MyApp')-> accessToken; 
          
               //$success['Categories'] = $category;
              // return response()->json(['success' => $success], $this-> successStatus);
              $success['status'] = 200;
              $success['message'] = "OK";
              $success['category'] = $category;
              return response()->json(['success' => $success], $this-> successStatus);  
    }

}