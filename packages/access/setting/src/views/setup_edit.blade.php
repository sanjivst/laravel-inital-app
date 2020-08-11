@extends('theme::layouts.my_frame')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <h4 class="text-center">Edit :</h4>
                <hr>
            </div>
            <div class="box">
                <div class="box-body">
                    <form method="post" action="{{ url('admin/setup/'.$setting->id)}}" class="form-group" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input class="form-control form-control-sm" id="name" name="name" type="text"
                                   value="{{old('name',$setting->name)}}">
                                   @error('name')
                                        <span>{{$message}}</span>
                                   @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo: </label>
                            <img height="50px" src="{{asset('images/'.$setting->logo)}}" alt="">
                            <input type="file" name="logo" id="logo" accept="image/*" value="{{$setting->logo}}">
                            <img src="" width="50px" alt=""/>

                        </div>
                        <div class="form-group">
                            <label for="favicon">Favicon: </label>
                            <img src="{{asset('images/'.$setting->favicon)}}" height="50px" alt="">
                            <input type="file" name="favicon" id="favicon" accept="image/*" value="{{$setting->favicon}}">
                            <img src="" width="50px" alt=""/>
                        </div>
                        <div class="form-group">
                            <label for="">About Us: </label>
                            <textarea class="form-control" id="about_us" name="about_us" rows="10">{{old('about_us',$setting->about_us)}}</textarea>
                                @error('about_us')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Address: </label>
                            <input type="text" class="form-control form-control-sm" name="address" value="{{old('address',$setting->address)}}">
                                @error('address')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Phone No.: </label>
                            <input type="text" class="form-control form-control-sm" name="phone" value="{{old('phone',$setting->phone)}}">
                                @error('phone')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Cell No.: </label>
                            <input type="text" class="form-control form-control-sm" name="cell" value="{{old('cell',$setting->cell)}}">
                                @error('cell')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email: </label>
                            <input type="email" class="form-control form-control-sm" name="email" value="{{old('email',$setting->email)}}">
                                @error('email')
                                    <span>{{$message}}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Social Link: </label>
                            <textarea class="form-control" id="social_link" name="social_link" rows="10">{{old('social_link',$setting->social_link)}}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
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
        $("#favicon").change(function(){
            readURL(this);
        });

         $("#logo").change(function(){
            readURL(this);
        });

    </script>

@endsection
