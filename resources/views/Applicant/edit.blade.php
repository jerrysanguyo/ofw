@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-end mb-1">
        <a href="{{ route('admin.applicant.index') }}" class="text-decoration-none">
            <button class="btn btn-primary">
                Back to list
            </button>
        </a>
    </div>
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.applicant.update', $details->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-lg-12">
                <div class="card shadow border">
                    <div class="card-body overflow-auto">
                        @include('Applicant.Partial.personal')
                        @include('Applicant.Partial.previous')
                        <div class="col-lg-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="card shadow border">
                <div class="card-body overflow-auto" style="height:450px;">
                    @include('Applicant.Partial.household')
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow border">
                <div class="card-body overflow-auto" style="height:450px;">
                    @include('Applicant.Partial.needs')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection