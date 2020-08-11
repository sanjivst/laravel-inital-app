<?php


namespace Access\Theme;
use Illuminate\Support\Facades\Paginator;


use Access\Setting\Setting;
use Access\Post\Post;
use Access\Subscriber\Subscriber;
use Access\Setting\Setup;
use Access\Post\Category;
use Access\Post\Type;
use Access\Page\Page;
use Access\Media\Gallery;
use Access\Media\Media;



class Runner
{
    public $theme;
    public $setting;

    public function __construct()
    {
        if(Theme::first())
        {
            $this->theme = Theme::first();
        }
        else{
            $theme = new Theme();
            $theme->name = "default";
            $theme->detail = "Default Theme";
            $theme->save();
            $this->theme = $theme;
        }
        if(Setup::first())
        {
            $this->setting = Setup::first();
        }
        else {
            $setting = new Setup();
            $setting->name = "Access";
            $setting->about_us = "CMS developed by Access";
            $setting->address = "empty";
            $setting->phone = "000000000";
            $setting->cell = "000000000";
            $setting->email = "default@email.com";
            $setting->save();
            $this->setting = $setting;
        }
    }


    public function posts($type = '',$categories = [], $paginate=10,$page_name='page')
    {
        $type = Type::where('name',$type)->first();
        $all_posts =  ($type)
            ? Post::where('type_id',$type->id)
                ->where('status',1)
                ->get()
            :Post::where('status',1)
                ->get();
        $posts =$all_posts->map(function ($post) use($categories) {
            $cats =[];
            foreach($post->categories as $v)
            {
                array_push($cats,$v->name);
            }
            return (array_diff($categories ,$cats) === [])?$post:null;
        })->reject(function ($post) {
            return empty($post);
        });

//        $ids = array_column($posts->toArray(), 'id');
        $ids = $posts->pluck( 'id');
        return Post::whereIn('id',$ids)
            ->orderBy('created_at','desc')
            ->paginate($paginate,["*"],$page_name);
    }
    public function posts_of_categories( $categories = [], $paginate='10')
    {
        $posts = Post::select('id')->get()->map(function ($post) use($categories) {
            $cats =[];
            foreach($post->categories as $v)
            {
                array_push($cats,$v->name);
            }
            return (array_diff($categories ,$cats) === [])?
                $post
                :null;
        })
            ->reject(function ($post) {
                return empty($post);
            });

        $ids = array_column($posts->toArray(), 'id');
        return Post::whereIn('id',$ids)->orderBy('priority','desc')->orderBy('created_at','desc')->paginate($paginate);
    }
    public function posts_of_category( $category = '', $paginate='10')
    {
        return Post::whereHas('categories', function($q) use ($category)
        {
            $q->where('name', $category);

        })->orderBy('priority','desc')->orderBy('created_at','desc')->paginate($paginate);
    }

    public function posts_of_type( $type = '', $paginate=10)
    {
        $type = Type::where('name',$type)->first();
        return ($type)?
            Post::where('type_id',$type->id)->where('status',1)->orderBy('priority','desc')->orderBy('created_at','desc')->paginate($paginate)
            :null;
    }

    public function all_posts($paginate=10)
    {
        return Post::where('status',1)->orderBy('priority','desc')->orderBy('created_at','desc')->paginate($paginate);
    }
    public function comments(Post $post)
    {
        $post_comments = $post->comments();
        $post_comments = $post_comments->map(function ($item, $key) {
            $subscriber = Subscriber::find($item->subscriber_id);
            $item = $item->merge(['subscriber_id' => $subscriber->id, 'name' => $subscriber->name]);
            return $item;
        });
        return $post_comments;
    }
    public function asset()
    {
        $theme_base_url = asset('theme_assets/'.$this->theme->name.'/assets');
        return $theme_base_url;
    }
    public function page($page)
    {
        $page = Page::where('name',$page)->first();
        return $page;

    }
    public function category()
    {
        $category = Category::all();
        return $category;
    }

    public function setup(){
        $setup=Setup::first();
        return $setup;
    }
    public function gallery(){
        $gallery=Gallery::all();
        return $gallery;
    }
    public function medias(){
        $media=Media::all();
        return $media;
    }
}
