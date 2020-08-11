@extends('theme::layouts.my_frame')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Edit Type:</h4>
                <hr>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form method="post" action="{{ url('admin/types/'.$type->id)}}" class="form-group" enctype="multipart/form-data">
                    <div class="box-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name: </label>
                                <input class="form-control form-control-sm" id="name" name="name" type="text"
                                       value="{{old('name',$type->name)}}">
                                       @error('name')
                                            <span>{{$message}}</span>  
                                       @enderror  
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Update</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $(".types").addClass('active');
        })
    </script>
@endsection