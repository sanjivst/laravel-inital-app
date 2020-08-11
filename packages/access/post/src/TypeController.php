<?php

namespace Access\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=Type::all();
        return view('posts::type')->with('type',$type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts::type_create');
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
        'name' => 'required|string',
        ]);
        


        $data=$request->except('_token');
        // dd($data);
        $type=new Type();
        $type->fill($data);
        $type->save($data);
        return redirect('admin/types')->with('success', 'Post Type Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        

        return view('posts::type_edit')->with('type',$type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate ([
            "name"=>'required|string'
        ]);
        
        $type->name=$request->name;
        // dd($type);
        // $type->fill($type);
        $type->save();
        return redirect('admin/types')->with('success', 'Post Type Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        // dd($type);
        $type->delete();
        return redirect('admin/types')->with('success', 'Post Type Deleted Successfully.');
    }
}
