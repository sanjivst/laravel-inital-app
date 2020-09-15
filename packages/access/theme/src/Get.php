<?php


namespace Access\Theme;

use Access\Post\Post;
use Access\Subscriber\Subscriber;
use Access\Setting\Setup;
use Access\Post\Category;
use Access\Post\Type;
use Access\Page\Page;


class Get
{
    public static function posts($type = '',$categories = [], $paginate=10,$page_name='page')
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

    public static function postsOfCategories( $categories = [], $paginate='10')
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

    public static function postsOfCategory( $category = '', $paginate='10')
    {
        return Post::whereHas('categories', function($q) use ($category)
        {
            $q->where('name', $category);

        })->orderBy('priority','desc')->orderBy('created_at','desc')->paginate($paginate);
    }

    public static function popularPosts($type_name='', $category_name = '', $limit=5)
    {
        $type = Type::where('name',$type_name)->first();
        $cat = ($category_name)?Category::where('name',$category_name)->first():null;
        $posts = [];
        if($cat && $type)
        {
            $posts = $cat->posts->where('type_id',$type->id)->sortByDesc('views')->take($limit);
        }
        if($type)
        {
            $posts = $type->posts->sortByDesc('views')->take($limit);
        }
        return $posts;
    }

	public static function mostCommented($type='', $paginate=5)
    {
        $type = Type::where('name',$type)->first();
        $posts = [];
        if($type)
        {
			$posts = Post::where('type_id',$type->id)->withCount('comments')->orderBy('comments_count', 'desc')->paginate($paginate);
        }
        return $posts;
    }

    public static function relatedPosts($type='', $category = '', $limit=5)
    {
        $type = Type::where('name',$type)->first();
        $cat = Category::where('name',$category)->first();
        $posts = [];
        if($cat && $type)
        {
            $posts = $cat->posts->where('type_id',$type->id)->take($limit);
        }
        return $posts;
    }

    public static function postsOfType( $type = '', $paginate=10)
    {
        $type = Type::where('name',$type)->first();
        return ($type)?
            Post::where('type_id',$type->id)->where('status',1)->orderBy('priority','desc')->orderBy('created_at','desc')->paginate($paginate)
            :null;
    }

    public static function allPosts($paginate=4)
    {
        return Post::where('status',1)->orderBy('priority','desc')->orderBy('created_at','desc')->paginate($paginate);
    }

    public static function comments(Post $post)
    {
        $post_comments = $post->comments();
        $post_comments = $post_comments->map(function ($item, $key) {
            $subscriber = Subscriber::find($item->subscriber_id);
            $item = $item->merge(['subscriber_id' => $subscriber->id, 'name' => $subscriber->name]);
            return $item;
        });
        return $post_comments;
    }

    public static function theme()
    {
        if (Theme::first()) {
            return Theme::first();
        } else {
            $theme = new Theme();
            $theme->name = "default";
            $theme->detail = "Default Theme";
            $theme->save();
            return $theme;
        }
    }

    public  static function asset($path='')
    {
        return asset('theme_assets/'.Get::theme()->name.'/assets/'.$path);
    }

    public static function setup()
    {
        if(Setup::first())
        {
            return Setup::first();
        }
        else {
            $setting = new Setup();
            $setting->name = "Access";
            $setting->about_us = "CMS developed by Global Interface";
            $setting->address = "empty";
            $setting->phone = "000000000";
            $setting->cell = "000000000";
            $setting->email = "default@email.com";
            $setting->save();
            return $setting;
        }
    }

    public static function page($page)
    {
        return Page::where('name',$page)->first();

    }

    public static function category()
    {
        return Category::all();
    }
}
