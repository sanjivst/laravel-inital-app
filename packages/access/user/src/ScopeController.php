<?php

namespace Access\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ScopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user::scope',['scopes'=>Scope::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user::scope_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->except('_token'), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $scope = new Scope;
        $data=$request->except('_token');
        $scope->fill($data);
        $scope->save();
        return redirect('admin/scopes')->with('success', 'New Scope Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function show(Scope $scope)
    {
        return $scope;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function edit(Scope $scope)
    {
        return view('user::scope_edit',['scope'=>$scope]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scope $scope)
    {
        Validator::make($request->except('_token'), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
        $data=$request->except('_token');
        $scope->fill($data);
        $scope->save();
        return redirect('admin/scopes')->with('success', 'Scope Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scope  $scope
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scope $scope)
    {
        $scope->delete();
        return redirect('admin/scopes')->with('success', 'Scope Deleted Successfully.');
    }
}
