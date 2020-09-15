<?php

namespace Access\Theme;
use Access\Post\Category;
use Illuminate\Support\Facades\Paginator;
use Access\Post\Type;
use Access\Post\Post;
use Access\Page\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class PublicController extends Controller
{    
    
    public function home()
    {
        return view('themes/'.Get::theme()->name.'/index');
    }

    public function page($slug)
    {
        if($page = Page::where('slug',$slug)->first())
        {
            if(view()->exists('themes/'.Get::theme()->name.'/'.$page->template))
            {
                return view('themes/'.Get::theme()->name.'/'.$page->template)

                    ->with('page',$page);
            }
            else
				return view('themes/'.Get::theme()->name.'/page')

				->with('page',$page);
        }
        else
            return abort(404);
    }

    // public function singlePost($slug)
    // {
    //     $post= Post::where('slug',$slug)->first();
    //     if(!$post)
    //         return abort(404);
	// 	$post->views +=1;
	// 	$post->save();
    //     return view('themes/'.Get::theme()->name.'/single_post')->with('post',$post);
    // }

    // public function search(Request $request){

    //     $title=$request->key;
    //     $posts= (!$title)?[]:Post::where('title','LIKE', "%".$title."%")->take(7)->get();
    //     return view('themes/'.Get::theme()->name.'/search-list')->with('posts',$posts);
    // }


    // public function find(Request $request)
    // {
    //     $title=$request->key;
    //     $posts= (!$title)?[]:Post::where('title','LIKE', "%".$title."%")->take(7)->get();

    //     return view('themes/'.Get::theme()->name.'/search-list')->with('posts',$posts);
    // }
}
