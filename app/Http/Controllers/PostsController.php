<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Comment;

class PostsController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // CHECKS IF THE USER IS LOGED IN AND 
        // EXCEPTS THE VIEWS MENTIONED TO BE ACCESSED WITHOUT LOGGING IN 
        $this->middleware('auth', ['except'=>['index','show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SHOW ALL THE POSTS BY THE USERS 
        $posts= Post::orderBy('created_at','desc')->get();
        return view('posts.index')->with('post',$posts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // POST CREATE FORM VIEW 
        return view('posts.posts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // Validation
        $this->validate($request,[
            'title' => 'required',
            'post_image' => ['required','image','max:2000']
        ]);
        
        $image = $request->file('post_image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $post = new Post;
        $post->user_id=Auth::user()->id;
        $post->title=$request->title;
        $post->img_name=$new_name;
        $post->save();
        $posts= Post::orderBy('created_at','desc')->get();
        return redirect('/posts')->with('post',$posts); 

    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts= Post::find($id);
        // IF USER IS NOT LOGGED IN 
        if(Auth::guest()){
            $created_by =  $posts->user->Firstname;
        }
        else{
            // IF USER IS LOGGED IN 
            // IF THE POST IS LIKED BY THE OWNER OF THE POST THEN ADD 'You'
            if ($posts->user->Firstname==Auth::user()->Firstname){
                $created_by = 'You';
            }
            else{
                $created_by = $posts->user->Firstname;
            }
        }
        // GETS THE NUMBER OF LIKS FOR THAT POST 
        $likes = $posts->likes;
        // FIND THE USERS WHO LIKED THAT POST AND TAKE 2 
        $liked_ = Like::where('post_id','=',$id)->take(2)->get();
        // IF THERE ARE LIKES 
        if(count($liked_)>=1){
             $liked_by = array();
            foreach($liked_ as $value){
                if(!Auth::guest()){
                    if($value->user->Firstname==Auth::user()->Firstname){
                        array_push($liked_by,'You');
                    
                    }else{
                        array_push($liked_by,$value->user->Firstname);
                    }
                }else{
                    array_push($liked_by,$value->user->Firstname);
                }
            }
        }else{
            $liked_by = array('No one');
        }


        // comments
        $comments = Comment::where('post_id','=',$id)->get();
        if (count($comments)>0){
        $comment_by = array();

            foreach($comments as $value){
                if(!Auth::guest()){
                    if($value->user->Firstname==Auth::user()->Firstname){
                        array_push($comment_by,array(
                        'id'=>$value->user->id,
                        'by'=>'You',
                        'comment'=>$value->comment
                        )
                    );
                    
                    }else{
                        array_push($comment_by,array(
                        'id'=>$value->user->id,
                        'by'=>$value->user->Firstname,
                        'comment'=>$value->comment
                        )
                    );
                    }
                }else{
                    array_push($comment_by,array(
                        'id'=>$value->user->id,
                        'by'=>$value->user->Firstname,
                        'comment'=>$value->comment
                    ));
                }
            }
        }else{
                $comment_by =array('No comments');
        }

        // THE DATA ARRAY SENT TO THE SHOW POST VIEW 
        $data = array(
            'post' => $posts,
            'created_by' => $created_by,
            'likes' => $likes,
            'liked_by'=> $liked_by,
            'comments'=>$comment_by
        );

        // dd($comment_by);
        return view('posts.show')->with('data',$data); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
