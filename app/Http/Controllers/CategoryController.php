<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categorymodel;
use App\NotificationModel;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $category = categorymodel::All();
        return view('category.index')->with('category',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:category',
            'age_group'=>'required',
             'color' => 'required|max:7|unique:category',
        ]);

        // $customMessages = [
        //     'color.max' => 'The :attribute should be HEX value'
        // ];
        //dd($request);
        $category = new categorymodel;
        $category->category_name= $request->category_name;
        $category->age_group =  implode (', ',$request->age_group);
       // dd($category->age_group);
        $category->color= $request->color;
       
        //dd($category);
        $category->save();
        return redirect('/category');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {  

           $category = new categorymodel;
           $category = categorymodel::find($id);
       //  $category->age_group = explode(' ', $category->age_group);

           $age_group = explode(",", $category->age_group);
           $category_name = $category->category_name;
           $category_id = $category->id;
           $color = $category->color;

           $notification = NotificationModel::where('category_id', $category_id)->get();  
            return view('category.edit', compact('category_name','age_group','color','category','notification'));
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
         $this->validate($request, [
            'categoryname' => 'required',
            'age_group'=>'required',
             'color' => 'required'
          ]);
        
        $category = categorymodel::find($id);
        $category->category_name = $request-> input('categoryname');
        $category->age_group = implode (',',$request->age_group);
        $category->color = $request-> input('color');
        $category->save();

       return redirect('/category')->with('status','Category Edit Successful');;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //  dd($id);
    
     // $notification = NotificationModel::where('category_id', $id)->pluck('id'); 
      // $category_id=  $notification->pluck('category_id');
         
       // dd($notification);
       
        $category = categorymodel::find($id);
        $category->delete();
     
        return redirect('/category')->with('status','Category Deleted');
    }

    public function destroynotification($id)
    {
       // dd($id);
        $notification = NotificationModel::find($id);
      
      //  $category_id = $notification->category_id;
        $notification->delete();
        return redirect('/category')->with('status','Notification deleted successfully');
    }
}
