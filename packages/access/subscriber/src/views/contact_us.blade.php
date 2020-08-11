@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Create Post:</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <form role="form" method="post" action="{{ url('contact_us_store')}}" class="form-group">
                    <div class="box-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input class="form-control" id="name" name="name" type="text" value="{{old('name')}}">
                                
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input class="form-control" id="email" name="email" type="text">
                        </div>

                        
                        <div class="form-group">
                            <label for="phone">Phone: </label>
                            <input class="form-control" id="phone" name="phone" type="number" value="{{old('phone')}}">
                                   
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject: </label>
                            <input class="form-control" id="subject" name="subject" type="text" value="{{old('subject')}}">
                                   
                        </div>
                        <div class="form-group">
                            <label for="contents">Message: </label>
                            <textarea class="form-control" id="contents" name="contents" required>{{old('contents')}}</textarea>
                               
                        </div>
                        

                    <div class="box-footer">
                        <button class="btn btn-success"  type="submit" id="submit" >Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
@endsection