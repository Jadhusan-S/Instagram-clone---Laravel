<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function onsubmit(Request $requests){
        $this->validate($requests,
        ['comment'=> 'required']);

        // GET THE POST ID
        $post_id = $requests->POST_ID;
        
        $comment= new Comment;
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$post_id;
        $comment->comment=$requests->comment;
        $comment->save();

        return redirect('/posts/'.$post_id);

    }
}
