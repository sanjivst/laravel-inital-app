<?php

namespace Access\Setting;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use File;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Image;


class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $setting=Setup::all();
        return view('setting::setup')->with('setting',$setting);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('setting::setup_create');
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
            'about_us'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'cell'=>'required|string',
            'email'=>'required|email',
        ]);

        $data=$request->except('_token');

        if($request->logo){
            $image = $request->file('logo');
            $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->logo->getClientOriginalName();;
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
            $img->resize(500,'', function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['image_name']);

            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['image_name']);
            $data['logo']=$input['image_name'];
        }

        if($request->favicon){
            $image = $request->file('favicon');
            $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->favicon->getClientOriginalName();;

            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['image_name']);
            $data['favicon']=$input['image_name'];
        }

        $setting=new Setup();
        $setting->fill($data);
        $setting->save($data);
        return redirect('admin/setup')->with('success', 'Setup Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Setup $setup
     * @return void
     */
    public function show(Setup $setup)
    {
        dd($setup);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Setup $setup
     * @return Response
     */
    public function edit(Setup $setup)
    {
        return view('setting::setup_edit')->with('setting',$setup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Setup $setup
     * @return Response
     */
    public function update(Request $request,Setup $setup)
    {
        $request->validate([
            'name'=>'required|string',
            'about_us'=>'required',
            'address'=>'required|string',
            'phone'=>'required|string',
            'cell'=>'required|string',
            'email'=>'required|email',
        ]);

        $data=$request->except('_token');

        if ($file = $request->hasFile('logo')) {
            $image = $request->file('logo');
            $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->logo->getClientOriginalName();;

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
            $data['logo']=$input['image_name'];
        }

        if ($file = $request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $input['image_name'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->favicon->getClientOriginalName();;

            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['image_name']);
            $data['favicon']=$input['image_name'];
        }

        $setup->fill($data);
        $setup->save($data);
        return redirect('admin/setup')->with('success', 'Setup Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Setup $setup
     * @return Response
     * @throws Exception
     */
    public function destroy(Setup $setup)
    {
        $path=public_path().'/thumbnail';
        $path1=public_path().'/img';
        $path2=public_path().'/images';
        if(!empty($setup->logo) && file_exists($path.'/'.$setup->logo))
        unlink($path.'/'.$setup->logo);
        if(!empty($setup->logo) && file_exists($path1.'/'.$setup->logo))
        unlink($path1.'/'.$setup->logo);
        if(!empty($setup->logo) && file_exists($path2.'/'.$setup->logo))
        unlink($path2.'/'.$setup->logo);
        if(!empty($setup->favicon) && file_exists($path.'/'.$setup->favicon))
        unlink($path2.'/'.$setup->favicon);

        $setup->delete();
        return redirect('admin/setup')->with('success', 'Setup Deleted Successfully.');
    }
}
