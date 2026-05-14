@extends('user.userapp')
@section('metadata')
    {{-- <title>Home | Travel Hub HTML5 Template |</title>--}}
   {{-- @if($parent)
    <title>{{$parent}}</title>
    @endif
    @if($metatags)
    {!! $metatags !!}
    @endif--}}

@endsection
<style>
    blink {
        color:red;
        -webkit-animation: blink 1s step-end infinite;
        animation: blink 1s step-end infinite
    }

    @-webkit-keyframes blink {
        67% { opacity: 0 }
    }

    @keyframes blink {
        67% { opacity: 0 }
    }
</style>
<style>
    .js div#preloader { position: fixed;
        left: 0;
        top: 0;
        z-index: 999;
        width: 100%;
        height: 100%;
        overflow: visible;
        background: #ffff url('{{ asset('storage/image/category/ajax-loader.gif') }}') no-repeat center center; }

</style>
@section('content')

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<center><div class="col-md-12" style="font-size: 28px;"><blink >NO PACKAGES ARE AVAILABLE NOW....!!!</blink></div></center>
<br>
<br>
<br>
<center><i class="fa fa-home"></i><a style="text-decoration: #ff1cab;font-size: 20px;" href="{{route('viewMainCategory')}}">Back To Home</a></i></center>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@stop
@section('javascript')
    <script>
        jQuery(document).ready(function($) {

// site preloader -- also uncomment the div in the header and the css style for #preloader
            $(window).load(function(){
                $('#preloader').fadeOut('slow',function(){$(this).remove();});
            });

        });
    </script>
@endsection