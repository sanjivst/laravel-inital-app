@extends('theme::layouts.my_frame')
@section('content')

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">

					<form method="post" action="{{url('admin/subscribers/'.$subscriber->id)}}">
						@csrf
						@method('PUT')

						<div class="box-body">

							<div class="form-group">
								<label for="name" >Name:</label>
								<input class="form-control form-control-sm" id="name" name="name" type="text"
									   value="{{$subscriber->name}}">
							</div>

							<div class="form-group">
								<label for="email">Email id:</label>
								<input class="form-control form-control-sm" name="email" id="email" type="email"
									   value="{{$subscriber->email}}">
							</div>


							<div class="form-group">
								<label for="number">Phone:</label>
								<input class="form-control form-control-sm" id="number" name="number" type="integer"
									   value="{{$subscriber->email}}">
							</div>


							<div class="form-group">
								<label for="status">Status:</label>
								<select class="form-control" type="text" name="status" id="status">
									<option value="1"@if ($subscriber->status=="1"){{"selected"}} @endif>Active</option>
									<option value="0"@if ($subscriber->status=="0"){{"selected"}} @endif>Inactive</option>
								</select>

							</div>

							<div class="box-footer">
								<button type="submit" class="btn btn-success">Update</button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		$('.subscribers').addClass('active');
		$('.subscribers_list').addClass('active');
	</script>

@endsection
