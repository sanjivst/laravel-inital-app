<?php

namespace Access\Subscriber;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Post\Post\Comment;
use Illuminate\Support\Facades\Redirect;
use Validator;


class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers=Subscriber::all();
         return view('subscriber::subscriber_list')
          ->with('subscribers', $subscribers);     
        
    }
        
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('subscriber::subscriber_create');
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
             'email'=>'required'
         ]);

        $data=$request->except('_token');
        $subscriber =new Subscriber();
        $subscriber->fill($data);
        $subscriber->save();

        return redirect('admin/subscribers')->with('success', 'Subscriber Stored Successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
//        dd($subscriber);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscriber=Subscriber::find($id);
        return view('subscriber::subscriber_edit')->with('subscriber',$subscriber);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $subscriber=Subscriber::find($id);

        $subscriber->fill($data);
        $subscriber->save();
        return redirect('admin/subscribers')->with('request', $subscriber)->with('success', 'Subscriber Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber=Subscriber::find($id);
        $subscriber->delete();

        return redirect('admin/subscribers')->with('success', 'Subscriber Deleted Successfully.');
    }
    public function contact_us()
    {

        return view('subscriber::contactus');
    }


    public function contact_us_store(Request $request)
    {

       
    $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|integer|digits:10',
            'subject'=>'required|max:100', 
            'contents'=>'required|string',
        ]);


        $subscriber = Subscriber::updateOrCreate(
            ['email' =>$request->email],
            ['name' =>$request->name,
                'phone' => $request->phone
            ]);
        $message = new Message();

        $message->subscriber_id = $subscriber->id;
        $message->subject = $request->subject;
        $message->contents = $request->contents;
        $message->save();
        return Redirect::back()->with(['success'=>'Thank you for contacting us. We will contact you soon.']);
    }


    public function contact_us_edit($id)
    {
        // //dd($id);
        //$subscriber=Subscriber::find($id);
        //return view('subscriber::contact_us_edit')->with('subscriber',$subscriber);
    }
    public function send_message(Request $request)
    {
        $subscriber = Subscriber::updateOrCreate(
            ['email' =>$request->email],
            ['name' =>$request->name,
                'phone' => $request->phone
            ]);
        $message = new Message();
        $message->subscriber_id = $subscriber->id;
        $message->subject = $request->subject;
        $message->contents = $request->contents;
        $message->save();

        return response()->json($subscriber);
    }
    public function comment(Request $request)
    {
        $subscriber = Subscriber::updateOrCreate(
            ['email' =>$request->email],
            ['name' =>$request->name,
                'phone' => $request->phone
            ]);
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->subscriber_id = $subscriber->id;
        $comment->text = $request->text;
        $comment->save();
        return response()->json($subscriber);
    }
    public function subscribeMe(Request $request)
    {
        $subscriber = Subscriber::updateOrCreate(
            ['email' =>$request->email]
        );
		return Redirect::back()->with(['success'=>'Thank you for subscribing us.']);
    }
}
