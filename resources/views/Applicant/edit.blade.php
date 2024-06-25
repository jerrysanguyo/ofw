@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow border">
                    <div class="card-body">
                        @include('Applicant.Partial.personal')
                        <hr>
                        @include('Applicant.Partial.previous')
                        <hr>
                        @include('Applicant.Partial.household')
                        <hr>
                        @include('Applicant.Partial.needs')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection