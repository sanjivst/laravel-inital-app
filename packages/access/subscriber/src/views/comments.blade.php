@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Comments List: </h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <table class="table table-bordered">
                    <thead>
                    <thead>
                    <th>Post ID</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Verified</th>
                    <th>Edit</th>
                    <th>Delete</th>

                    </thead>
                    </thead>
                    <tbody>
                    @foreach($comments as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->subscriber->name}}</td>
                            <td>{{$item->post->title}}</a></td>
                            <td>{{$item->text}}</td>
                            <td>{{($item->verified)?"Yes":"No"}}</td>
                              <td><a href="{{url('admin/comments/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                             <td>
                                <form method="post" action="{{url('admin/comments/'.$item->id)}}">
                            @csrf
                            @method('DELETE')
                           <button style="border-radius:50%" onclick="return confirm('Do you want to delete this?')" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                        </form>
                            </td>
                           
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
        $(".comments").addClass('active');
        $(".comments_list").addClass('active');
    </script>
@endsection