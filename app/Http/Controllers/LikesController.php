<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;

class LikesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function onlike(Request $request)
    {
        // GET THE USER ID AND POST ID
        $post_id = $request->POST_ID;
        $user_id = Auth::user()->id;
        // FIND THE CURRENY POST 
        $post = Post::find($post_id);
        // CHECK IF THE USER HAS ALREADY LIKED THAT POST
        $check_post= Like::where([['user_id','=',$user_id],['post_id','=',$post_id]])->first();
        // IF USER HAS LIKED, THEN UNLIKE THE IMAGE BY DELETING THAT RECORD
        if($check_post){
            $liked_post_id= $check_post->id;
            $liked_post= Like::find($liked_post_id);
            $liked_post->delete();
            
            // UPDATE TEH LIKES IN THAT POST
            $liked_post = $post->likes;
            $post->likes = $liked_post-1;
            $post->save();
        }
        // ELSE ADD A LIKE TO THAT POST
        else{
            $like = new Like;
            $like->user_id=$user_id;
            $like->post_id=$post_id;
            $like->save();

            // UPDATE TEH LIKES IN THAT POST
            $liked_post = $post->likes;
            $post->likes = $liked_post+1;
            $post->save();
        }

        return redirect('/posts/'.$post_id); 

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
        //
    }

}
