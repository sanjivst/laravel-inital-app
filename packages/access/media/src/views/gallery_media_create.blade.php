@extends('theme::layouts.my_frame')
@section('content')
    <style>
        .flex-box
        {
            display: flex;
            flex-flow: wrap;
        }
        .flex-box div
        {
            height: 150px;
            margin: 5px;
            padding: 20px;
            box-shadow:5px 5px 10px #101;
        }
    </style>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <h2 class="text-center">Add Media in Gallery form:</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form method="post" action="{{url('admin/gallery_media_upload')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="form-group">
                            <label for="gallery_id">Gallery Name:</label>
                            <select class="form-control" id="gallery_id" name="gallery_id">
                                @foreach($galleries as $gallery)
                                    <option value="{{$gallery->id}}">{{$gallery->name}}</option>
                                    }
                                @endforeach
                            </select>
                        </div>
                        <!------- media list ------------->

                            <div class="flex-box">
                                @foreach($media as $key=>$med)
                                    <div>
                                        <img src="{{asset('/images').'/'.$med->filename}}" alt="No Image" height="100px">
                                        <br>
                                        <input id="media_id_{{$key}}" name='media_id[]' type='checkbox'
                                               value='{{$med->id}}'/>
                                        <label for="media_id_{{$key}}" >{{$med->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.media-list -->

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
        $('.galleries').addClass('active');
        $('.gallery_media_create').addClass('active');
    </script>

@endsection
