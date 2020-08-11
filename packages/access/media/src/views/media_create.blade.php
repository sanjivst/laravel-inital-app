@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <h4 class="text-center">Media Add form:</h4>
        <hr>
    </div>
    <div class="content">
        <div class="row">
            <div class="box">

                <form method="post" action="{{url('admin/media')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input  type="text" name="name" id="name" class="form-control form-control-sm" value="{{old('name')}}">
                                @error('name')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>

                        

                        <div class="form-group">
                            <label for="filename">File:</label>
                            <input type="file" name="filename" id="filename" accept="image/*">
                                @error('filename')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" name="description" class="form-control form-control-sm" id="description" value="{{old('description')}}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>

            </form>
        </div>
    </div>
    </div>

    <script>
        $('.media').addClass('active');
        $('.media_create').addClass('active');
    </script>
@endsection
