@extends('theme::layouts.my_frame')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<h2 class="text-center">Gallery List</h2>
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
						<th>Post</th>
						<th>Name</th>
						<th>Note</th>
						<th>Thumbnail</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach($galleries as $key =>  $item)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{($item->post)?$item->post->title:''}}</td>
							<td>{{$item->name}}</td>
							<td>{{$item->note}}</td>
							<td>
								<img src="{{asset('thumbnail/'.$item->thumbnail)}}" alt="image" >
							</td>

							  
                       

							<td>

								<a href="{{url('admin/galleries/'.$item->id)}}">Show/</a>
								<a href="{{url('admin/galleries/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a>/
								<a href="{{url('admin/gallery_media_modify/'.$item->id)}}">Modify/</a>

								 <form method="post" action="{{url('admin/galleries/'.$item->id)}}">
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
		$('.galleries').addClass('active');
		$('.galleries_list').addClass('active');
	</script>
@endsection
