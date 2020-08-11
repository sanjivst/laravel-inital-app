@extends('layouts.my_frame')
@section('title','List')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table id="data_list" class="table table-bordered">
                        <thead>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </thead>
                        <tbody>

                            @foreach($scopes as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>

                                    <td><a href="{{url('admin/scopes/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>

                                    <td>   <form method="post" action="{{url('admin/scopes/'.$item->id)}}">
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
    </div>

    <script>
        $(function () {
            $(".users").addClass('active');
            $(".scope_list").addClass('active');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#data_list').DataTable( {
                "scrollX": true
            } );
        } );
    </script>
@endsection
