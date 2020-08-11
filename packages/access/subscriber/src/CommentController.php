<?php

namespace Access\Subscriber;

use Access\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=Comment::all();
        // dd($comment);
        return view('subscriber::comments')->with('comments',$comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts=Post::all();
        return view('subscriber::comment_create')
            ->with('posts',$posts)
            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text'=>'required|string',
        ]);

        $subscriber = Subscriber::updateOrCreate(
            ['email' =>$request->email],
            ['name' =>$request->name,
                'phone' => $request->phone
            ]);
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->subscriber_id = $subscriber->id;
        $comment->text = $request->text;
        $comment->save();
        return redirect('admin/comments')->with('success', 'Comment Sent Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('subscriber::post_description');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //dd($comment);
        $posts=Post::all();
        return view('subscriber::comment_edit')->with('comment',$comment)
        ->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'text'=>'required|string',
        ]);
        
        $comment->text=$request->text;
        $comment->verified=$request->verified;
        // dd($comment);
        $comment->save();
        return redirect('admin/comments')->with('success', 'Comment Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect('admin/comments')->with('success', 'Comment Deleted Successfully.');
    }
	
	public function addComment(Request $request)
	{
		$request->validate([
			'text'=>'required|string',
		]);

		$subscriber = Subscriber::updateOrCreate(
			['email' =>$request->email],
			['name' =>$request->name,
			 'phone' => $request->phone
			]);
		$comment = new Comment();
		$comment->post_id = $request->post_id;
		$comment->subscriber_id = $subscriber->id;
		$comment->text = $request->text;
		$comment->save();
		return redirect()->back()->with('success', 'Comment Added Successfully.');
	}
}
