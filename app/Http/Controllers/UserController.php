<?php
namespace goni\Http\Controllers;
use goni\User;
use goni\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller{
    public function update_password(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
            return view('update_pass')->withUser($user);
            }
            else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    
        
    }
    public function change_password(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
        $user ->password = Hash::make($request['password']);
        $user->save();
        return redirect()->back();
        }else{
            return redirect()->back();
        }
        
    }
    public function change_profile_pic(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $str = $user->email;
            str_replace('@', '.', $str);
            $filename =$request->profile_pic->hashName();
            Storage::disk('local')->put("public/".$str, $request['profile_pic']);
            $user ->avatar =$filename;
            $user->save();

            return view('home')->withUser($user);
        }else{
            return redirect()->back();
        }
    }
    public function get_profile_pic(){
        $user = User::find(Auth::user()->id);
        if($user){
            $str = $user->email;
            str_replace('@', '.', $str);
            $filename =$user ->avatar;
            return Storage::get("public/".$str."/".$filename);
        }
    }
    public function user_manager(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                if($user->id==1){
                    $users = User::all();
                    $departments = Department::all();
                    return view('manageUsers', ['users' => $users,'departments'=>$departments]);
                }
            }
            else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }

    }
    public function create_user(Request $request){
        $user_id=1;
        $dep_id;
        $already_exists=0;
        $users = User::all();
        $departments = Department::all();
        foreach($users as $user){
            if($user->email==$request->email){
                $user_id=$user->id;
                $already_exists=1;
            }
            
        }
        foreach($departments as $dep){
            if($dep->name==$request->department){
                $dep_id=$dep->id;
            }
            
        }
       $user;
        if($already_exists==1){
            $user=User::find($user_id);
        }
        else{
            $user= new User();
            $user->password=Hash::make('password');
        }
        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->user_has_department=$dep_id;

        $user->save();
        return redirect()->back();
       }

}