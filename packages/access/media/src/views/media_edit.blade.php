@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <h4 class="text-center">Media edit form:</h4>
        <hr>
    </div>
    <div class="content">
        <div class="row">
            <div class="box">

                <form method="post" action="{{url('admin/media')}}/{{$media->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input  type="text" name="name" id="name" class="form-control form-control-sm" value="{{old('name', $media->name)}}">
                                @error('name')
                                    <span>{{$message}}</span>
                                @enderror

                        </div>

                      
                        <div class="form-group">
                            <label for="filename">File:</label>
                            <img src="{{asset('thumbnail/'.$media->filename)}}" height=100px alt="image">
                            <input type="file" name="filename" id="filename" accept="image/*" value="{{$media->filename}}">
                        </div>

                        <div class="form-group">

                            <label for="description">Description:</label>
                            <input type="text" name="description" class="form-control form-control-sm" value="{{old('description', $media->description)}}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        $('.media').addClass('active');
    </script>

@endsection







