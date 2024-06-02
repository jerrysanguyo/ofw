@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->role === 'admin')
            @include('HomePartial.admin')
        @elseif(Auth::user()->role === 'user') 
            @include('HomePartial.user')
        @else
            @include('HomePartial.superadmin')
        @endif
    </div>
</div>
@endsection
