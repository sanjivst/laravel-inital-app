@extends('theme::layouts.my_frame')
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
                        <th>Slug</th>
                        <th>Template</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Header Asset</th>
                        <th>Body Content</th>
                        <th>Footer Asset</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
                        </thead>
                        <tbody>
                        

                        @if($page)
                            @foreach($page as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->slug}}</td>
                                    <td>{{$item->template}}</td>
                                    <td><img src="{{asset('thumbnail/'.$item->image)}}" alt="image" ></td>
                                    <td>{{$item->title}}</td>
                                    <td>{{(substr($item->header_asset,0,25))."..." }}</td>
                                    <td>{{(substr(strip_tags($item->body_content),0,50))."..." }}</td>
                                    <td>{{(substr($item->footer_asset,0,100))."..." }}</td>
                                    <td>{{($item->status)?"Active":"Inactive"}}</td>
                                   

                            <td><a href="{{url('admin/pages/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>

                             <td>   <form method="post" action="{{url('admin/pages/'.$item->id)}}">
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
            $('#news_list').DataTable( {
                "scrollX": true
            } );
        } );
        $('.pages').addClass('active');
        $('.pages_list').addClass('active');
    </script>
@endsection
