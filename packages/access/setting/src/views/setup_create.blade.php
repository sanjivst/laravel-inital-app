@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <h4 class="text-center">Setting :</h4>
                <hr>
            </div>

            <div class="box">
                <div class="box-body">
                    <form method="post" action="{{ url('admin/setup')}}" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" >Name: </label>
                            <input class="form-control form-control-sm" id="name" name="name" type="text" value="{{old('name')}}">
                                @error('name')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo: </label>
                            <input type="file" name="logo" id="logo" accept="image/*">
                            <img src="" width="50px" alt="" />
                        </div>
                        <div class="form-group">
                            <label for="favicon" >Favicon: </label>
                            <input type="file" name="favicon" id="favicon" accept="image/*">
                            <img src="" width="50px" alt=""/>
                        </div>
                        <div class="form-group">
                            <label for="about_us" >About Us: </label>
                            <textarea class="form-control" id="about_us" name="about_us" style="resize:none" required>{{old('about_us')}}</textarea>
                                @error('about_us')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="address" >Address: </label>
                            <input class="form-control form-control-sm" id="address" name="address" type="text" value="{{old('address')}}">
                                @error('address')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" >Phone No.: </label>
                            <input class="form-control form-control-sm" id="phone" name="phone" type="text" value="{{old('phone')}}">
                                @error('phone')
                                <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="cell" >Cell No.: </label>
                            <input class="form-control form-control-sm" id="cell" name="cell" type="text" value="{{old('cell')}}">
                                @error('cell')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" >Email: </label>
                            <input class="form-control form-control-sm" id="email" name="email" type="email" value="{{old('email')}}">
                                @error('email')
                                    <span>{{$message}}</span>
                                @enderror

                        </div>
                        <div class="form-group">
                            <label for="social_link" >Social Link: </label>
                            <textarea class="form-control" id="social_link" name="social_link" style="resize:none"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>
                            <button class="btn btn-danger"type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(input).next('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#logo").change(function(){
            readURL(this);
        });
        $("#favicon").change(function(){
            readURL(this);
        });

    </script>

@endsection
