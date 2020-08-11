@extends('theme::layouts.my_frame')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Edit Comment:</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    <div class="form-group">
                        <label for="name">Name : </label>
                        <div class="form-control" id="name">
                            {{$comment->subscriber->name}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Post : </label>
                        <div id="title" class="form-control">
                            {{$comment->post->title}}
                        </div>
                    </div>

                </div>
            </div>
            <div class="box">

                <form role="form" method="post" action="{{url('admin/comments/'.$comment->id)}}" class="form-group" enctype="multipart/form-data">
                    <div class="box-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="text">Comment Text: </label>
                            <input type="text" class="form-control form-control-sm" id="text" name="text" value="{{$comment->text}}">
                                @error('text')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="verified">Verify: </label>
                            <select class="form-control form-control-sm" id="verified" name="verified" type="text">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success">Update</button>
                        <button class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(".comments").addClass('active');
    </script>

@endsection