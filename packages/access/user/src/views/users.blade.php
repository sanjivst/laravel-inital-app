@extends('layouts.my_frame')
@section('title','List')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table id="news_list" class="table table-bordered">
                        <thead>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Scope</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </thead>
                        <tbody>

                        @if($user)
                            @foreach($user as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->scope->name}}</td>

                                    <td><a href="{{url('admin/users/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>

                                    <td>   <form method="post" action="{{url('admin/users/'.$item->id)}}">
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
        $(function () {
            $(".users").addClass('active');
            $(".users_list").addClass('active');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#news_list').DataTable( {
                "scrollX": true
            } );
        } );
        $('.users').addClass('active');
        $('.users_list').addClass('active');
    </script>
@endsection
