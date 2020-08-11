@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h1 class="text-center">Gallery Create Form:</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <form method="post" action="{{url('admin/galleries')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="form-group">
                            <label for="post_id">Select Post:</label>
                            <select class="form-control" name="post_id" id="post_id">
                                <option value="">Select Post</option>
                                @foreach($posts as $post)
                                    <option value="{{$post->id}}">{{$post->title}}</option>
                                @endforeach
                            </select>
                             @error('post_id')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input  type="text" name="name" id="name" class="form-control form-control-sm" value="{{old('name')}}">
                                @error('name')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="note">Note:</label>
                            <input type="text" name="note" id="note" class="form-control form-control-sm" value="{{old('note')}}">
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
    <script>
        $('#post_id').select2();
        $('.galleries').addClass('active');
        $('.galleries_create').addClass('active');
    </script>
@endsection
