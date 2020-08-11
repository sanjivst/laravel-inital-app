@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Ceate Post:</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <form role="form" method="post" id="myForm" class="field" action="{{ url('admin/posts')}}" class="form-group"  enctype="multipart/form-data" id = 'searchInput'>
                    <div class="box-body">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input class="form-control" id="title" name="title" type="text" value="{{old('title')}}">
                            @error('title')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug: </label>
                            <input class="form-control" id="slug" name="slug" type="text">

                        </div>

                        <div class="form-group">
                            <label for="image" >Thumbnail: </label>
                            <input type="file" name="image" id="image" accept="image/* ">
                            @error('image')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="highlights" class="col-3">Short Description </label>

                            <textarea class="form-control" id="highlights" name="highlights" ></textarea>
                            @error('highlights')
                            <span>{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="description">Description: </label>
                            <textarea class="form-control" id="description" name="description" required>{{old('description')}}</textarea>
                            @error('description')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" >Status: </label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tag">Tag: </label>
                            <input class="form-control" id="tag" name="tag" type="text">
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type </label>
                            <select class="form-control" id="type_id" name="type_id">
                                @foreach($types as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category: </label><span> multiple select</span>
                            <select class="form-control select_group" id="category_id" name="category_id[]" multiple style="width: 100%">
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="priority">Priority: </label>
                            <input class="form-control" id="priority" name="priority" type="number" min="0" value="{{old('priority','0')}}">
                            @error('priority')
                            <span>{{$message}}</span>
                            @enderror
                        </div>

                        <div class="box-footer">
                            <button class="btn btn-success"  type="submit" id="submit" >Submit</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function () {

            CKEDITOR.replace('description');
            // $('.textarea').ckeditor(); // if class is prefered.
            CKEDITOR.replace('highlights');
            $(".posts").addClass('active');
            $(".posts_create").addClass('active');

            $('.popup').click(function (event) {
                event.preventDefault();
                window.open('{{url('admin/select-image')}}', "popupWindow", "width=600,height=400,scrollbars=yes");
            });

            $(".select_group").select2();

        });
    </script>

@endsection
