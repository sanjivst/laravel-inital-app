<?php
namespace Access\Page;
use Access\Theme\Runner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;
use Get;
class PageController extends Controller
{
    public function display($slug)
    {
        $page = Page::where('slug',$slug)->where('status',true)->first();
        if($page) {
            $runner = new Runner();
//            dd('themes.'.$runner->theme->name.'.layouts.page_frame');
            if (view()->exists('themes.'.$runner->theme->name.'.default_page'))
            {
                return view('themes.'.$runner->theme->name.'.default_page')
                    ->with('page', $page)
                    ->with('runner', $runner);
            }
            else{
                return view('page::layouts/my_page')
                    ->with('page', $page)
                    ->with('runner', $runner);
            }
        }
        else
            return abort(404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($page);
        $page=Page::all();
        return view('page::page')->with('page',$page);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = File::files(resource_path('views/themes/'.Get::theme()->name));
        
        return view('page::page_create',['templates'=>$templates]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request)
        $request->validate([
            'name'=>'required|string',
            'title'=>'required|string',
            'body_content'=>'required|string',
        ]);
        $data=$request->except('_token');
        if($request->image){
            $image = $request->file('image');
            $input['imagename'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->image->getClientOriginalName();;
            $path=public_path().'/thumbnail';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/thumbnail';
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
            $path=public_path().'/imgupload';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/imgupload';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $data['image']=$input['imagename'];
        }
        $page=new Page();
        $page->fill($data);
        if($page->title == null)
        {
            $page->title = $page->name;
        }
        if($page->slug !=null) {
            $page->slug = strtolower(preg_replace('/\s+/', '-', $page->slug));
        }
        else
        {
            $page->slug = strtolower(preg_replace('/\s+/', '-', $page->name));
        }
        $page->slug = $this->getSlug($page->slug);
        $page->save($data);
        return redirect('admin/pages')->with('success', 'New Page Created Successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        dd($page);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $templates = File::files(resource_path('views/themes/'.Get::theme()->name));
        
        return view('page::page_edit',['page'=>$page,'templates'=>$templates]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Page $page)
    {
        $request->validate([
            'name'=>'required|string',
            'title'=>'required|string',
            'body_content'=>'required|string',
        ]);
        $data=$request->except('_token');
        if($request->hasFile('image')){
            $usersImage = public_path("thumbnail/{$request->image}");
            $usersImage1 = public_path("imgupload/{$request->image}");
            $usersImage2 = public_path("images/{$request->image}");
            if (File::exists($usersImage)) { // unlink or remove previous image from folder
                unlink($usersImage);
            }
            if (File::exists($usersImage1)) { // unlink or remove previous image from folder
                unlink($usersImage1);
            } if (File::exists($usersImage2)) { // unlink or remove previous image from folder
                unlink($usersImage2);
            }
        }
        if($request->image){
            $image = $request->file('image');
            $input['imagename'] =  "Image-".date('Ymdhis').rand(0,1234).".".$request->image->getClientOriginalName();;
            $path=public_path().'/thumbnail';
            //           //dd($path);
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/thumbnail';
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
            $path=public_path().'/imgupload';
            if(!File::exists($path)){
                File::makeDirectory($path,0777,true,true);
            }
            $destinationPath = public_path().'/imgupload';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $data['image']=$input['imagename'];
        }
        $page->fill($data);
        if($page->title == null)
        {
            $page->title = $page->name;
        }
        if($page->slug !=null) {
            $page->slug = strtolower(preg_replace('/\s+/', '-', $page->slug));
        }
        else
        {
            $page->slug = strtolower(preg_replace('/\s+/', '-', $page->name));
        }
        $page->slug = $this->getSlug($page->slug,$page->id);
        $page->save($data);
        return redirect('admin/pages')->with('success', 'Page Updated Successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        if($page->image){
            $path=public_path().'/thumbnail';
            $path1=public_path().'/imgupload';
            $path2=public_path().'/images';
            unlink($path.'/'.$page->image);
            unlink($path1.'/'.$page->image);
            unlink($path2.'/'.$page->image);
        }
        $page->delete();
        return redirect('admin/pages')->with('success', 'Page Deleted Successfully.');
    }
    private function getSlug($r_slug,$model_id=null)
    {
        if(Page::where('slug',$r_slug)->whereNotIn('id',[$model_id])->get()->count()>0)
        {
            $string_slug = explode('-',$r_slug);
            $increment = end($string_slug);
            if(is_numeric($increment))
            {
                $increment ++;
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










