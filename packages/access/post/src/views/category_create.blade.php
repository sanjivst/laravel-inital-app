@extends('theme::layouts.my_frame')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <h4 class="text-center">Category Create:</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <form role="form" method="post" action="{{ url('admin/categories')}}" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" >Name: </label>
                            <input class="form-control form-control-sm" id="name" name="name" type="text" onkeyup="manage(this)">
                            @error('name')
                                <span>{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button class="btn btn-success" type="submit" id="submit">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".categories").addClass('active');
            $(".categories_create").addClass('active');
        });
    </script>

    <!-- <script type="text/javascript">
        function manage(name)
        {
            var bt = document.getElementById('submit')
            if
                (name.val != '')
            {
                bt.disabled=false;
            }
            else 
                bt.disabled=true;
        }
        
    </script> -->
@endsection
