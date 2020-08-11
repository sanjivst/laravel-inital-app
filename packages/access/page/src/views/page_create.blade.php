@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <h4 class="text-center">Page form:</h4>
                <hr>
            </div>

            <div class="box">
            <div class="box-body">
                <form method="post" action="{{ url('admin/pages')}}" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" >Name: </label>
                        <input type="text" class="form-control form-control-sm" id='name' name="name" value="{{old('name')}}">
                            @error('name')
                                <span>{{$message}}</span>
                            @enderror
                    </div>
                    <div class="form-group ">
                        <label for="slug" class="col-2">Slug: </label>
                        <div class="col-10">
                            <input type="text" class="form-control form-control-sm" id="slug" name="slug" value="{{old('slug')}}">
                                @error('slug')
                                    <span>{{$message}}</span>
                                @enderror

                        </div>

                        <div class="form-group">
                            <label for="template" >Template: </label>

                            <select  class="form-control form-control-sm" id='template' name="template" required style="width: 100%">
                                @foreach ($templates as $template)
                                <option value="{{chop($template->getFilename(),'blade.php')}}" {{(chop($template->getFilename(),'blade.php') == old('template'))? 'selected':''}}>{{$template->getFilename()}}</option>
                                @endforeach
                            </select>
                            @error('template')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="title" class="col-2">Title: </label>

                            <input class="form-control form-control-sm" id="title" name="title" type="text" value="{{old('title')}}">
                                @error('title')
                                    <span>{{$message}}</span>
                                @enderror


                        </div>

                        <div class="form-group ">
                            <label for="image" class="col-3">Image: </label>

                            <input type="file" name="image" id="image" accept="image/*">
                            <img src="" id="img" width="50px"  alt=""/>

                            <div class="form-group ">
                                <label for="body_content" class="col-3">Body Content: </label>

                                <textarea class="form-control" id="body_content" name="body_content"  required style="resize:none" ; required>{{old('body_content')}}
                               </textarea>
                                    @error('body_content')
                                        <span>{{$message}}</span>
                                    @enderror

                            </div>
                            <div class="form-group ">
                                <label for="header_asset" class="col-3">Header Asset: </label>

                                <textarea class="form-control" id="header_asset" name="header_asset" style="resize:none" ;></textarea>
                            </div>
                            <div class="form-group ">
                                <label for="footer_asset" class="col-3">Footer Asset: </label>

                                <textarea class="form-control" id="footer_asset" name="footer_asset" style="resize:none" ;></textarea>

                            </div>
                            <div class="form-group ">
                                <label for="status" >Status: </label>
                                    @error('status')
                                        <span>{{$message}}</span>
                                    @enderror

                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                            </div>
                            <div class="form-group ">

                                <button class="btn btn-success" type="submit">Submit</button>
                                <button class="btn btn-danger" type="reset">Reset</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace('body_content');
        $('#template').select2();
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
        $('.pages_create').addClass('active');

    </script>


@endsection
