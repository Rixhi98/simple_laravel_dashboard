<?php

namespace goni\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use goni\Department;
use goni\User;

class DepartmentController extends Controller
{
    public function show_departments(){
        $departments=Department::all();
        dd($departments);
       }

       public function create_department(Request $request){
        $user_id=1;
        $dep_id;
        $already_exists=0;
        $users = User::all();
        $departments = Department::all();
        foreach($users as $user){
            if($user->email==$request->owner){
                $user_id=$user->id;
            }
            
        }
        foreach($departments as $dep){
            if($dep->name==$request->name){
                $already_exists=1;
                $dep_id=$dep->id;
            }
            
        }
$department;
        if($already_exists==1){
            $department=Department::find($dep_id);
        }
        else{
            $department= new Department();
        }
        
        $department->name=$request->name;
        $department->owner=$user_id;
        $department->save();
        return redirect()->back();
       }
       public function show_departments_view(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                if($user->id==1){
                    $users = User::all();
                    $departments = Department::all();
                    return view('departments', ['users' => $users,'departments'=>$departments]);
                }
            }
            else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
       }

}
