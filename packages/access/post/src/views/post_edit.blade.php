@extends('theme::layouts.my_frame')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Edit Post:</h4>
                <hr>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <form role="form" method="post" action="{{ url('admin/posts/'.$post->id)}}" class="form-group" enctype="multipart/form-data">

                    <div class="box-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{old('title',$post->title)}}">
                                @error('title')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug: </label>
                            <input type="text" class="form-control form-control-sm" id="slug" name="slug" value="{{$post->slug}}">
                        </div>
                        <div class="form-group">
                            <label for="highlights">Short Description: </label>
                            <textarea class="form-control" id="highlights" name="highlights">{{old('highlights',$post->highlights)}}</textarea>
                                @error('highlights')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" >Thumbnail: </label>
                            <img height="50px" src="{{asset('thumbnail/'.$post->image)}}">
                            <input type="file" name="image" id="image" accept="image/*" value="{{$post->image}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description: </label>
                            <textarea class="form-control" id="description" name="description">{{old('description',$post->description)}}</textarea>
                                @error('description')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status: </label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="1" @if ($post->status=="1"){{"selected"}} @endif>Active</option>
                                <option value="0" @if ($post->status=="0"){{"selected"}} @endif>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tag">Tag: </label>
                            <input type="text" class="form-control form-control-sm" id="tag" name="tag" value="{{$post->tag}}">
                        </div>

                        <div class="form-group">
                            <label for="type_id" >Type: </label>
                            <select class="form-control form-control-sm" id="type_id" name="type_id">
                                @foreach($types as $item)
                                    <option value="{{$item->id}}" @if ($post->type_id==$item->id)
                                        {{"selected"}}
                                            @endif >
                                        {{$item->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id" >Categories </label><span> multiple select</span>
                            <select class="form-control select_group" id="category_id" name="category_id[]" multiple style="width: 100%">
                                @foreach($categories->toArray() as $item)

                                    <option value="{{$item['id']}}"  {{($post->categories->where('name',$item['name'])->count()==0)?'':'selected'}}>

                                        {{$item['name']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="priority">Priority: </label>
                            <input class="form-control" id="priority" name="priority" type="number" min="0" value="{{old('priority',$post->priority)}}">
                            @error('priority')
                            <span>{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success" type="submit">Update</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
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
            $(".select_group").select2();
        });
    </script>
@endsection
