@extends('theme::layouts.my_frame')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Category List: </h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <table class="table table-primary table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td><a href="{{url('admin/categories/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                             <td>
                                <form method="post" action="{{url('admin/categories/'.$item->id)}}">
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
        $(function () {
            $(".categories").addClass('active');
            $(".categories_list").addClass('active');
        });
    </script>
@endsection
