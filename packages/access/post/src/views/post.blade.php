@extends('theme::layouts.my_frame')
@section('title','List')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Posts List: </h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-bordered" id="posts_list">
                        <thead>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Thumbnail</th>
                        <th>Highlights</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Categories</th>
                        <th>Views</th>
                        <th>Edit</th>
                        <th>Delete</th>

                        </thead>
                        <tbody>

                        @if($posts)
                            @php($key=0)
                            @foreach($posts as $item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->slug}}</td>
                                    <td><img src="{{asset('thumbnail/'.$item->image)}}" alt="image" height="100" width="100"></td>
                                    <td>
                                        @if (strlen($item->highlights) >=50 )
                                            {{substr(strip_tags($item->highlights), 0, 50). " ... " }}
                                        @else
                                            {{strip_tags($item->highlights)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if (strlen($item->description) >=50 )
                                            {{substr(strip_tags($item->description), 0, 50). " ... "}}
                                        @else
                                            {{strip_tags($item->description)}}
                                        @endif
                                    </td>
                                    <td>{{($item->status)?"Active":"Inactive"}}</td>
                                    <td>{{$item->type->name}}</td>
                                    <td>
                                        @foreach($item->categories as $cat)
                                            {{$cat->name.', '}}
                                        @endforeach
                                    </td>
                                    <td>{{$item->views}}</td>
                                    <td><a href="{{url('admin/posts/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <form method="post" action="{{url('admin/posts/'.$item->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button style="border-radius:50%" onclick="return confirm('Do you want to delete this?')" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#posts_list').DataTable( {
                "scrollX": true
            } );

            $(".posts").addClass('active');
            $(".posts_list").addClass('active');
        } );
    </script>
@endsection
