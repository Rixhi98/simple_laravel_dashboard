<?php

namespace goni\Http\Controllers;
use goni\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get_text()
    {
        $other_user_email=$_COOKIE["other_email"];
        $user_id=0;
        $users=User::all();
        foreach($users as $user){
            if($user->email==$other_user_email){
                $user_id=$user->id;
            }
        }
        if(Auth::user()){
            $currentuser = User::find(Auth::user()->id);
            $other_user= User::find($user_id);
            if($currentuser){
                $conversation = Chat::conversations()->between($currentuser, $other_user);
                return $conversation;
            }
        }
 
    }
    public function submit_text(Request $request)
    {
        $user_id=0;
        $users=User::all();
        foreach($users as $user){
            if($user->email==$request->other_user){
                $user_id=$user->id;
            }
            
        }
        if(Auth::user()){
            $currentuser = User::find(Auth::user()->id);
            $other_user= User::find($user_id);
            if($currentuser){
                if($other_user){
                $participants =[$currentuser,$other_user];
                $conversation = Chat::conversations()->between($currentuser, $other_user);
                if(!$conversation){
                    $conversation = Chat::createConversation($participants);
                }
                
                $message = Chat::message($request->msg)
                ->from($currentuser)
                ->to($conversation)
                ->send();
                }

            
            }

    }
  }
}
