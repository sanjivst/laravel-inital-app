@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <h4 class="text-center">Page Edit form:</h4>
                <hr>
            </div>

            <div class="box">
                <div class="box-body">
                    <form method="post" action="{{ url('admin/pages/'.$page->id)}}" class="form-group" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" >Name: </label>
                            <input type="text" class="form-control form-control-sm" id='name' name="name" value="{{old('name',$page->name)}}">
                            @error('name')
                            <span>{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group ">
                            <label for="slug" class="col-2">Slug: </label>
                            <div class="col-10">
                                <input class="form-control form-control-sm" id="slug" name="slug" type="text"
                                       value="{{old('slug',$page->slug)}}">
                                @error('slug')
                                <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="template" >Template: </label>
                            <select  class="form-control form-control-sm" id='template' name="template" required style="width: 100%">
                                @foreach ($templates as $template)
                                <option value="{{chop($template->getFilename(),'blade.php')}}" {{(chop($template->getFilename(),'blade.php') == old('template',$page->template))? 'selected':''}}>{{$template->getFilename()}}</option>
                                @endforeach
                            </select>
                            @error('template')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-3">Image: </label>
                            <div class="col-9">
                                <img src="{{asset('images/'.$page->image)}}" height="100" id="img" width="100px" alt="">

                                <input type="file" id="image" name="image" accept="image/*" value="{{$page->image}}">

                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="phone" class="col-2">Title: </label>

                            <input class="form-control form-control-sm" id="title" name="title" type="text"
                                   value="{{old('title',$page->title)}}">
                            @error('title')
                            <span>{{$message}}</span>
                            @enderror


                        </div>

                        <div class="form-group ">
                            <label for="body_content" class="col-3">Body Content: </label>

                            <textarea class="form-control" id="body_content" name="body_content" required style="resize:none" ;>{{old('body_content',$page->body_content)}}</textarea>

                            @error('body_content')
                            <span>{{$message}}</span>
                            @enderror


                        </div>
                        <div class="form-group ">
                            <label for="header_asset" class="col-3">Header Asset: </label>

                            <textarea class="form-control" id="header_asset" name="header_asset" style="resize:none" ;>{{$page->header_asset}}</textarea>

                        </div>
                        <div class="form-group ">
                            <label for="footer_asset" class="col-3">Footer Asset: </label>

                            <textarea class="form-control" id="footer_asset" name="footer_asset" style="resize:none" ;>{{$page->footer_asset}}</textarea>

                        </div>
                        <div class="form-group ">
                            <label for="status" class="col-3">Status: </label>

                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="1" @if ($page->status=="1"){{"selected"}} @endif>Active</option>
                                <option value="0" @if ($page->status=="0"){{"selected"}} @endif>Inactive</option>
                            </select>

                        </div>
                        <div class="form-group ">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <button class="btn btn-danger" type="reset">Reset</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace('body_content');
        $('#template').select2();
    </script>
    <script >
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);

                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function(){
            readURL(this);
        });
        $('.pages').addClass('active');
    </script>


@endsection
