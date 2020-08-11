<?php

namespace Access\Media;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Image;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $medium=Media::all();
        return view('media::media_list')->with('medias', $medium);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('media::media_create');
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
            'name'=>'required|string',
            'filename'=>'mimes:jpeg,jpg,png,gif|required|max:500|',
        ]);



        $data=$request->except('_token');

        $medium =new Media();

        $image = $request->file('filename');
        $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->filename->getClientOriginalName();;
        $path=public_path().'/thumbnail';
        if(!File::exists($path)){
            File::makeDirectory($path,0777,true,true);
        }
        $destinationPath = public_path().'/thumbnail';
        $img = Image::make($image->getRealPath());
        $img->resize(100,'',  function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['image_name']);

        $path=public_path().'/img';
        if(!File::exists($path)){
            File::makeDirectory($path,0777,true,true);
        }
        $destinationPath = public_path().'/img';
        $img = Image::make($image->getRealPath());
        $img->resize(500,'',  function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['image_name']);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['image_name']);
        $data['filename']=$input['image_name'];

        $data['url'] = asset('thumbnail').'/'.$input['image_name'];

        $medium->fill($data);
        $medium->save();
        return redirect('admin/media')->with('success', 'Media Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param Media $medium
     * @return void
     */
    public function show(Media $medium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Media $medium
     * @return Response
     */
    public function edit(Media $medium)
    {
        return view('media::media_edit')->with('media',$medium);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Media $medium
     * @return Response
     */
    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'name'=>'required|string',
            //'filename'=>'mimes:jpeg,jpg,png,gif|required|max:500',
        ]);

        $data=$request->except('_token');

        if($request->hasFile('image')){
            if($medium->image)
            {
                $usersImage = public_path("thumbnail/{$medium->image}");
                $usersImage1 = public_path("img/{$medium->image}");
                $usersImage2 = public_path("images/{$medium->image}");
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
        }
        $image = $request->file('filename');
        $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->filename->getClientOriginalName();;
        $path=public_path().'/thumbnail';

        if(!File::exists($path)){
            File::makeDirectory($path,0777,true,true);
        }
        $destinationPath = public_path().'/thumbnail';
        $img = Image::make($image->getRealPath());
        $img->resize(100,'', function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['image_name']);

        $path=public_path().'/img';
        if(!File::exists($path)){
            File::makeDirectory($path,0777,true,true);
        }
        $destinationPath = public_path().'/img';
        $img = Image::make($image->getRealPath());
        $img->resize(500,'',  function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['image_name']);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['image_name']);
        $data['filename']=$input['image_name'];
        $data['url'] = asset('thumbnail').'/'.$input['image_name'];

        $medium->fill($data);
        $medium->save();
        return redirect('admin/media')->with('request',$medium)->with('success', 'Media Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $medium
     * @return Response
     * @throws \Exception
     */
    public function destroy(Media $medium)
    {
        if($medium->filename)
        {
            $path=public_path().'/thumbnail';
            $path1=public_path().'/img';
            $path2=public_path().'/images';
            if (File::exists($path.'/'.$medium->filename))
            unlink($path.'/'.$medium->filename);
            if (File::exists($path1.'/'.$medium->filename))
            unlink($path1.'/'.$medium->filename);
            if (File::exists($path2.'/'.$medium->filename))
            unlink($path2.'/'.$medium->filename);
        }

        $medium->delete();
        return redirect('admin/media')->with('success', 'Media Deleted Successfully.');
    }
}
