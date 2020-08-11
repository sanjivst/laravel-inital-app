@extends('theme::layouts.my_frame')
@section('content')
	<div class="row">

		<div class="col-xs-12">
			<div class="box">

				<div class="box-body">

						<table id="tablecontent" class="table table-bordered">
							<thead>
							<tr>
								<th>SN</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Subject</th>
								<th>Message</th>
								<th>Seen</th>
								<th>Replied</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
							</thead>

							<tbody>
							@foreach($messages as $key =>  $item)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{$item->subscriber->name}}</td>
									<td>{{$item->subscriber->email}}</td>
									<td>{{$item->subscriber->phone}}</td>
									<td><a href="{{url('admin/messages/'.$item->id)}}"> {{$item->subject}}</a></td>
									<td><a href="{{url('admin/messages/'.$item->id)}}"> {{$item->contents}}</a></td>
									<td>{{($item->seen)?"Yes":"No"}}</td>
									<td>{{($item->replied)?"Yes":"No"}}</td>
									   <td><a href="{{url('admin/messages/'.$item->id.'/edit')}}" style="border-radius:50%" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                             <td>
                                <form method="post" action="{{url('admin/messages/'.$item->id)}}">
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
		$('.subscribers').addClass('active');
		$('.messages_list').addClass('active');
	</script>

@endsection