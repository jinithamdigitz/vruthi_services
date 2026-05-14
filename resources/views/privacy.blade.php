@extends('layouts.main')

@section('content')

<section class="policy-page">
<div class="container py-5">
    <div class="col-lg-10 mx-auto privacy-box">
        
        <div class="policy-header">
            <h1>{{ $contentcreated->title }}</h1>
        </div>

        <div class="policy-content">
            {!! $contentcreated->body !!}
        </div>

    </div>
    </div>
</section>

@endsection