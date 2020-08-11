@extends('theme::layouts.my_frame')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Create Comment:</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form method="post" action="{{url('admin/comments')}}" class="form-group" enctype="multipart/form-data">

                    <div class="box-body">
                        @csrf
                        <div class="form-group">
                            <label for="post_id">Post : </label>
                                <select class="form-control form-control-sm" name="post_id" id="post_id">
                                    @foreach($posts as $item)
                                        <option value="{{$item->id}}">
                                            {{$item->title}}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name: </label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-3">Email: </label>
                                <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="text">Text: </label>
                                <input type="text" class="form-control form-control-sm" id="text" name="text" value="{{old('text')}}">
                                    @error('text')
                                        <span>{{$message}}</span>
                                    @enderror
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(".comments").addClass('active');
        $(".comments_create").addClass('active');
    </script>
@endsection