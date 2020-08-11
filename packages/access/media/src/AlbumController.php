<?php

namespace Access\Media;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use File;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $album=Album::all();
        return view('media::album_list')->with('albums', $album);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media::album_create');
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
            'description'=>'required|string',
            'thumbnail'=>'mimes:jpg,jpeg,png,gif|required|max:5000',
        ]);

        $data=$request->except('_token');
        $album =new Album();
        if ($request->thumbnail)
        {
            $path = public_path().'/thumbnail';
            if (!File::exists($path))
            {
                File::makeDirectory($path, 0777, true, true);
            }
            $file_name="thumbnail-".date('Ymdhis').rand(0,1234).".".$request->thumbnail->getClientOriginalExtension();
            $success=$request->thumbnail->move($path,$file_name);
            $data['thumbnail'] = $file_name;
        }

        $album->fill($data);

        $album->save();
        return redirect('admin/albums')->with('success', 'Album Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::find($id);
        return view('media::album_show')
            ->with('album',$album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album=Album::find($id);
        return view('media::album_edit')->with('album',$album);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            ]);
        
        $data=$request->except('_token');
        $album=Album::find($id);
        if ($request->thumbnail)
        {
            $path = public_path().'/thumbnail';
            if (!File::exists($path))
            {
                File::makeDirectory($path, 0777, true, true);
            }
            $file_name="thumbnail-".date('Ymdhis').rand(0,1234).".".$request->thumbnail->getClientOriginalExtension();
            $success=$request->thumbnail->move($path,$file_name);
            $data['thumbnail'] = $file_name;
        }
        $album->fill($data);
        $album->save();
        return redirect('admin/albums')->with('request',$album)->with('success', 'Album Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album=Album::find($id);
        $album->delete();
        return redirect('admin/albums')->with('success', 'Album Deleted Successfully.');
    }
}
