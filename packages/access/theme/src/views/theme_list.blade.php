@extends('theme::layouts.my_frame')
@section('title','List')
@section('content')
    @php
        //$blade_dir = base_path('resources/views/themes/');
        $assets_dir = asset('theme_assets/');
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                @foreach($themes as $theme)

                    <div class="box-body">
                        <h3>Name : {{$theme}} </h3>
                        <img src="{{asset('theme_assets/'.$theme.'/thumbnail.png')}}" height="300" alt="">
                        <br>
                        <button class="btn {{($active_theme->name == $theme)? 'btn-primary':'btn-warning'}}" value="{{$theme}}">{{($active_theme->name == $theme)? 'Activated':'Activate'}}</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>

        $('.btn').click(function () {
            var button = this;
            $.ajax({
                type:'POST',
                url:'{{url('admin/')}}/theme/activate/'+this.value,
                data:'_token = <?php echo csrf_token() ?>',
                success:function(data) {
                    $('.btn').removeClass( "btn-primary" ).addClass( "btn-warning" )
                    $('.btn').html( "Activate" )
                    $(button).removeClass( "btn-warning" ).addClass( "btn-primary" );
                    $(button).html('Activated')
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });
        $('.themes').addClass('active')
        $('.theme_list').addClass('active')

    </script>
@endsection