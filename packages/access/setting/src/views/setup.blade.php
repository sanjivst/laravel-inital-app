@extends('theme::layouts.my_frame')
@section('title','List')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4 class="text-center">Setting :</h4>
			<hr>
		</div>

		<div class="box">
			<div class="box-body">
				<table id="news_list" class="table border">
					<thead>
						<th>S.N.</th>
						<th>Name</th>
						<th>Logo</th>
						<th>Favicon</th>
						<th>About Us</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Cell</th>
						<th>Email</th>
						<th>Social Link</th>
						<th>Edit</th>
						<th>Delete</th>
					</thead>
					<tbody>

						@if($setting)
						@foreach($setting as $key=>$item)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$item->name}}</td>
							<td><img alt="image"  src="{{asset('images/'.$item->logo)}}" width="100%"></td>
							<td><img alt="image" src="{{asset('images/'.$item->favicon)}}"
									 width="100%"></td>
							<td>{!!(substr(strip_tags($item->about_us),0,50))."..." !!}</td>
							<td>{{$item->address}}</td>
							<td>{{$item->phone}}</td>
							<td>{{$item->cell}}</td>
							<td>{{$item->email}}</td>
							<td>{!!$item->social_link!!}</td>
							<td><a href="{{url('admin/setup/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
							<td>
								<form method="post" action="{{url('admin/setup/'.$item->id)}}">
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

		$(".setup").addClass('active');
		$(".setup_list").addClass('active');
	} );


</script>
@endsection
