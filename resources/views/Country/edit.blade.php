@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Country update</span>
                <a href="{{ route('admin.country.index') }}" class="text-decoration-none">
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
                    <form action="{{ route('admin.country.update', ['country' => $country->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12">
                            <label for="name" class="form-label">Country name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $country->name }}">
                        </div>
                        <div class="col-lg-12">
                            <label for="continent_id" class="form-label">Continent:</label>
                            <select name="continent_id" id="continent_id" class="form-select">
                                <option value="{{ $country->continent_id }}">{{ $country->continent->name }}</option>
                                @foreach($listOfContinent as $continent)
                                    <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <input type="text" name="remarks" id="remarks" class="form-control" value="{{ $country->remarks ?? 'N/A' }}">
                        </div>
                        <input type="submit" value="Update" class="btn btn-primary mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
