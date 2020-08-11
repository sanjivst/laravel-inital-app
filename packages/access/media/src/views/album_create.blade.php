@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <h2 class="text-center">Album Add form:</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form method="post" action="{{url('admin/albums')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input class="form-control form-control-sm" id="name" name="name" type="text" value="{{old('name')}}">
                                @error('name')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" name="description" id="description" class="form-control form-control-sm" value="{{old('description')}}">
                                @error('description')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="thumbnail">Thumbnail:</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
                                @error('thumbnail')
                                    <span>{{$message}}</span>
                                @enderror
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

@endsection