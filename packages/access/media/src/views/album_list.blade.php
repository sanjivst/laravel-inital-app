@extends('theme::layouts.my_frame')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<h2 class="text-center">Album List</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<table id="tablecontent" class="table table-bordered">
					<thead>
					<tr>
						<th>SN</th>
						<th>Name</th>
						<th>Description</th>
						<th>Thumbnail</th>
						<th>Edit</th>
                        <th>Delete</th>

					</tr>
					</thead>
					<tbody>
					@foreach($albums as $key =>  $item)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$item->name}}</td>
							<td>{{$item->description}}</td>
							<td>
								<img src="{{asset('thumbnailuploads/'.$item->thumbnail)}}" alt="image" height="100">
							</td>
							  <td><a href="{{url('admin/albums/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                       <td>  <form method="post" action="{{url('admin/albums/'.$item->id)}}">
                            @csrf
                            @method('DELETE')
                           <button style="border-radius:50%" onclick="return confirm('Do you want to delete this?')" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                        </form> </a></td>
						</tr>

					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection