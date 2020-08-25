<?php

namespace goni\View\Components;
use goni\Department;
use goni\User;
use Illuminate\View\Component;

class chatview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $users=User::all();
        $departments=Department::all();
        return view('components.chatview',['users' => $users,'departments'=>$departments]);
    }
}
