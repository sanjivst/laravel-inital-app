<?php

namespace Access\Media;

use Access\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery=Gallery::all();

        return view('media::gallery_list')->with('galleries', $gallery);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media::gallery_create',['posts'=>Post::all()->where('status',1)]);
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
            'name'=>'required|string',
            'thumbnail'=>'mimes:jpg,jpeg,png,gif|required|max:500',
        ]);

        $data=$request->except('_token');

        $gallery =new Gallery();

        if ($request->thumbnail){
            $image = $request->file('thumbnail');
            $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->thumbnail->getClientOriginalName();;
            $path=public_path().'/thumbnail';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/thumbnail';
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['image_name']);

            $path=public_path().'/img';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/img';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['image_name']);

            $destinationPath = base_path('/images');
            $image->move($destinationPath, $input['image_name']);
            $data['thumbnail']=$input['image_name'];
        }

        $gallery->fill($data);

        $gallery->save();
        return redirect('admin/galleries')->with('success', 'Gallery Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);
        return view('media::gallery_show')
            ->with('gallery',$gallery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery=Gallery::find($id);
        return view('media::gallery_edit',['gallery'=>$gallery,'posts'=>Post::all()->where('status',1)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|string',
        ]);



        $data=$request->except('_token');
        $gallery=Gallery::find($id);


        if($request->hasFile('thumbnail')) {
            if($gallery->thumbnail)
            {
                $usersImage = base_path("thumbnail/{$gallery->thumbnail}");
                $usersImage1 = base_path("img/{$gallery->thumbnail}");
                $usersImage2 = base_path("images/{$gallery->thumbnail}");

                if (File::exists($usersImage)) { // unlink or remove previous image from folder
                    unlink($usersImage);
                }
                if (File::exists($usersImage1)) { // unlink or remove previous image from folder
                    unlink($usersImage1);
                }
                if (File::exists($usersImage2)) { // unlink or remove previous image from folder
                    unlink($usersImage2);
                }
            }

            $image = $request->file('thumbnail');
            $input['image_name'] = "Image-" . date('Ymdhis') . rand(0, 1234) . "." . $request->thumbnail->getClientOriginalName();;
            $path = public_path() . '/thumbnail';

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $destinationPath = public_path() . '/thumbnail';
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['image_name']);

            $path = public_path() . '/img';
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $destinationPath = public_path() . '/img';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['image_name']);

            $destinationPath = base_path('/images');
            $image->move($destinationPath, $input['image_name']);
            $data['thumbnail'] = $input['image_name'];
        }

        $gallery->fill($data);
        $gallery->save();
        return redirect('admin/galleries')->with('request',$gallery)->with('success', 'Gallery Updated Successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery=Gallery::find($id);
        if($gallery->thumbnail)
        {
            $path=public_path().'/thumbnail';
            $path1=public_path().'/img';
            $path2=public_path().'/images';
            unlink($path.'/'.$gallery->thumbnail);
            unlink($path1.'/'.$gallery->thumbnail);
            unlink($path2.'/'.$gallery->thumbnail);
        }
        $gallery->delete();

        return redirect('admin/galleries')->with('success', 'Gallery Deleted Successfully.');
    }

    public function gallery_media_create()
    {
        $galleries=Gallery::all();
        $media=Media::all();

        return view('media::gallery_media_create')
            ->with('media',$media)
            ->with('galleries',$galleries)
            ->with('success', 'Gallery Media Created Successfully.')
            ;
    }
    public function gallery_media_upload(Request $request)
    {
        $gallery = Gallery::find($request->gallery_id);
        $gallery->media()->sync($request->media_id);

        return redirect('admin/galleries')->with('success', 'Gallery Media Uploaded Successfully.');
    }

    public function gallery_media_modify($id)
    {
        $gallery=Gallery::find($id);
        $media=Media::all();

        return view('media::gallery_media_edit')
            ->with('media',$media)
            ->with('gallery',$gallery)
            ->with('success', 'Gallery Media Modified Successfully.')
            ;
    }

}
