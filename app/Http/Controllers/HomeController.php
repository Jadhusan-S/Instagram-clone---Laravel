<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['view_profile']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
 
    public function profile($id)
    {
        if (Auth::user()->id == $id){
            return view('profile.profile');
        }else{
            return view('home');
        }
    }
    public function view_profile($id)
    {   
        if(!Auth::guest()){
            if (Auth::user()->id == $id){
                return view('home');
            }else{
    
                $posts = User::find($id);
                $data=array(
                    'posts'=> $posts
                );
        
                return view('profile.viewprofile')->with('data',$data);
            }

        }else{
            $posts = User::find($id);
                $data=array(
                    'posts'=> $posts
                );
        
                return view('profile.viewprofile')->with('data',$data);
        }
    }
}
