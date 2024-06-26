@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
            <div class="col-lg-6">
                <div class="card shadow border" style="height:450px;">
                    <div class="card-body">
                        <form action="{{ route('admin.applicant.update', $details->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('Applicant.Partial.personal')
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow border">
                    <div class="card-body" style="height:450px;">
                        @include('Applicant.Partial.previous')
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="card shadow border">
                    <div class="card-body" style="height:450px;">
                        <!-- @include('Applicant.Partial.household') -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow border">
                    <div class="card-body" style="height:450px;">
                        <!-- @include('Applicant.Partial.needs') -->
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection