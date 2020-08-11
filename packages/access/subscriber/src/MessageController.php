<?php

namespace Access\Subscriber;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use File;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //echo "index";
         $message=Message::all();
         return view('subscriber::message_list')
          ->with('messages', $message);     
         // return view('subscriber::application'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // //dd('dfadfa');
        //return view('subscriber::contact_us');
            //return redirect('admin/contact_us')->with('request',$media);

        //return view ('subscriber::subscriber_create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $data=$request->except('_token');
           $message =new Message();
           $message->fill($data);
            $message->save();
        
        return redirect('admin/messages')->with('success', 'Message Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $message->seen = 1;
        $message->save();
        return view('subscriber::message_show')
        ->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // //dd($id);
        $message=Message::find($id);
        return view('subscriber::message_edit')
            ->with('message',$message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $data=$request->except('_token','_method');


        $message=Message::find($id); 
        $message->fill($data);
        $message->seen=1;
        //dd($message);
        $message->save();
        return redirect('admin/messages')->with ('request', $message)->with('success', 'Message Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertise  $advertise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message=Message::find($id);
        $message->delete();

        return redirect('admin/messages')->with('success', 'Message Deleted Successfully.');
    }
  
}
