<?php

namespace Access\Post;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use File;
use Illuminate\Http\Response;
use Image;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts=Post::all()->sortByDesc('updated_at');
        return view('posts::post')
            ->with('posts',$posts)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories=Category::all();
        $types=Type::all();

        return view('posts::post_create')
            ->with('categories',$categories)
            ->with('types',$types)
            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'highlights'=>'required|string',
            'description'=>'required|string',
            'priority'=>'numeric|min:0',
        ]);

        $data=$request->except('_token');

        if($request->image){
            $image = $request->file('image');
            $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->image->getClientOriginalName();;
            $path=public_path().'/thumbnail';

            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/thumbnail';
            $img = Image::make($image->getRealPath());
            $img->resize(100, '', function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['image_name']);

            $path=public_path().'/img';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/img';
            $img = Image::make($image->getRealPath());
            $img->resize(500, '', function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['image_name']);

            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['image_name']);
            $data['image']=$input['image_name'];
        }
        $data['user_id']=Auth::user()->id;

        $post=new Post();

        if($request->slug)
        {
            $slug = $request->slug;
        }
        else
        {
            $slug = $request->title;
        }
        $slug=trim($slug);
        $slug = preg_replace('/(\s+|\?|\/|\-+)/', '-', $slug);
        $data['slug']=$this->getSlug($slug);

        $post->fill($data);

        $post->save($data);
        $post->categories()->sync($request->category_id);

        return redirect('admin/posts')->with('success', 'Post Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {
    }
    public function single($slug)
    {
        $post = Post::where('slug',$slug)->first();
        dd($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $types = Type::all();
        return view('posts::post_edit')
            ->with('post',$post)
            ->with('categories',$categories)
            ->with('types',$types)
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|string',
            'highlights'=>'required|string',
            'description'=>'required|string',
            'priority'=>'numeric|min:0',
        ]);

        $data=$request->except('_token');

        if($request->hasFile('image')){
            $usersImage = public_path("thumbnail/{$request->image}");
            $usersImage1 = public_path("img/{$request->image}");
            $usersImage2 = public_path("images/{$request->image}");

            if (File::exists($usersImage)) { // unlink or remove previous image from folder
                unlink($usersImage);
            }
            if (File::exists($usersImage1)) { // unlink or remove previous image from folder
                unlink($usersImage1);
            } if (File::exists($usersImage2)) { // unlink or remove previous image from folder
                unlink($usersImage2);
            }

            $image = $request->file('image');
            $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->image->getClientOriginalName();;
            $path=public_path().'/thumbnail';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/thumbnail';
            $img = Image::make($image->getRealPath());
            $img->resize(100, '', function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['image_name']);

            $path=public_path().'/img';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/img';
            $img = Image::make($image->getRealPath());
            $img->resize(500, '', function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['image_name']);

            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['image_name']);
            $data['image']=$input['image_name'];
        }

        $data['user_id']=Auth::user()->id;
        $post->fill($data);
        if($post->slug !=null) {
            $post->slug = trim(preg_replace('/(\s+|\?|\/|\-+)/', '-', $post->slug));
        }
        else
        {
            $post->slug = trim(preg_replace('/(\s+|\?|\/|\-+)/', '-', $post->title));
        }
        $post->slug = $this->getSlug($post->slug,$post->id);

        $post->save($data);
        $post->categories()->sync($request->category_id);

        return redirect('admin/posts')->with('success', 'Post Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        if(!empty($image) && file_exists(public_path().'/thumbnail/'.$image))
        {
            unlink(public_path().'/thumbnail/'.$image);
        }
        if(!empty($image) && file_exists(public_path().'/img/'.$image))
        {
            unlink(public_path().'/img/'.$image);
        }
        if(!empty($image) && file_exists(public_path().'/images/'.$image))
        {
            unlink(public_path().'/images/'.$image);
        }
        $post->delete();
        return redirect('admin/posts')->with('success', 'Post Deleted Successfully.');
    }

    private function getSlug($r_slug,$model_id=0)
    {
        if(Post::where('slug',$r_slug)->whereNotIn('id',[$model_id])->get()->count()>0)
        {
            $string_slug = explode('-',$r_slug);
            $increment = end($string_slug);
            if(is_numeric($increment))
            {
                $increment++;
                array_pop($string_slug);
            }
            else
            {
                $increment = 1;
            }
            $r_slug = implode('-',$string_slug);
            $r_slug .= '-'.$increment;

            return $this->getSlug($r_slug,$model_id);
        }
        else
        {
            return $r_slug;
        }
    }
}
