@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">need update</span>
                <a href="{{ route('admin.need.index') }}" class="text-decoration-none">
                    <button class="btn btn-primary">
                        Back
                    </button>
                </a>
            </div>
            <div class="card shadow border">
                <div class="card-body">
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
                    <form action="{{ route('admin.need.update', ['need' => $need->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12">
                            <label for="name" class="form-label">Need name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $need->name }}">
                        </div>
                        <div class="col-lg-12">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <input type="text" name="remarks" id="remarks" class="form-control" value="{{ $need->remarks ?? 'N/A' }}">
                        </div>
                        <input type="submit" value="Update" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
