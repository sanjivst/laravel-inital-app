<?php

namespace Access\Post;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $category=Category::all();
        return view('posts::category')->with('category',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts::category_create')
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
            
                'name'=>'required|string',
            ]);

        $data=$request->except('_token');
        $category=new Category();
        $category->fill($data);
        $category->save($data);
        return redirect('admin/categories')->with('success', 'Post Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Category
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('posts::category_edit')
            ->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate
        ([
            "name"=>'required|string'
        ]);

        $category->name=$request->name;
        $category->save();
        return redirect('admin/categories')->with('success', 'Post Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('admin/categories')->with('success', 'Post Category Deleted Successfully.');
    }
}
