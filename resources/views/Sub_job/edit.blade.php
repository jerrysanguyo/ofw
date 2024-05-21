@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Sub job update</span>
                <a href="{{ route('admin.subjob.index') }}" class="text-decoration-none">
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
                    <form action="{{ route('admin.subjob.update', ['subjob' => $subjob->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="name" class="form-label">subjob name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $subjob->name }}">
                        <label for="job" class="form-label">Job:</label>
                        <select name="job_id" id="job" class="form-select">
                            <option value="{{ $subjob->job_id }}">{{ $subjob->job->name }}</option>
                            @foreach($listOfJob as $job)
                                <option value="{{ $job->id }}">{{ $job->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Update" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
