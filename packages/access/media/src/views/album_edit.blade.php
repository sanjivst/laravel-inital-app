@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <h2 class="text-center">Album Edit form:</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form method="post" action="{{url('admin/albums')}}/{{$album->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        <div class="form-control">
                            <label for="name">Name:</label>
                            <input  type="text" name="name" class="form-control form-control-sm" id="name" value="{{old('name',$album->name)}}">
                                @error('name')
                                    <span>{{$message}}</span>
                                @enderror

                        </div>

                        <div class="form-control">
                            <label for="description">Description:</label>
                            <input type="text" name="description" id="description" class="form-control form-control-sm" value="{{old('description',$album->description)}}">
                                @error('description')
                                    <span>{{$message}}</span>
                                @enderror

                        </div>

                        <div class="form-control">
                            <label for="thumbnail">Thumbnail:</label>

                            <img src="{{asset('thumbnailuploads/').'/'.$album->thumbnail}}" height="100px" alt="null">
                            <input type="file" name="thumbnail" id="thumbmnail" accept="image/*" >
                               


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

@endsection
