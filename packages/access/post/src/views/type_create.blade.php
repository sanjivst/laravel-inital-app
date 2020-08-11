@extends('theme::layouts.my_frame')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Create Type:</h4>
                <hr>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form role="form" method="post" action="{{ url('admin/types')}}" class="form-group" enctype="multipart/form-data">
                    <div class="box-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name">
                            @error('name')
                            <span>{{$message}}</span>
                            @enderror
                            

                            
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"  type="submit" id="submit">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".types").addClass('active');
            $(".types_create").addClass('active');
        });
    </script>
@endsection
