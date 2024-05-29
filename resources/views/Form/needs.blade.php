@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.personal.create') }}">PERSONAL NA INPORMASIYON</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.previous.create') }}">IMPORMASIYON NOONG HULING NAG TRABAHO SA ABROAD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.household.create') }}">MGA KASAMA SA BAHAY</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.needs.create') }}">MGA KAILANGAN NG PAMILYA</a>
            </li>
        </ul>
        <div class="col-md-12 mt-3">
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
                    @if(!$user_need)
                    <form action="{{ route('admin.needs.store') }}" method="post">
                        @csrf
                        <div id="needs-container">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="needs" class="form-label">Need:</label>
                                    <input type="text" name="needs[]" id="needs" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Buttons for add and remove row -->
                        <div class="d-flex flex-row-reverse mt-3">
                            <button type="button" id="add-row" class="btn btn-success ms-2">Add Row</button>
                            <button type="button" id="remove-row" class="btn btn-danger">Remove Last Row</button>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3">
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </div>
                    </form>
                    @else
                        @foreach($listOfNeeds as $need)
                            <form action="{{ route('admin.needs.update', $need->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3 align-items-end">
                                    <div class="col-md-11">
                                        <label for="needs" class="form-label">Need:</label>
                                        <input type="text" name="needs" id="needs" class="form-control" value="{{ $need->needs }}">
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-md-start">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-row').addEventListener('click', function () {
            var container = document.getElementById('needs-container');
            var newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-3');
            newRow.innerHTML = `
                <div class="col-md-12">
                    <label for="needs" class="form-label">Need:</label>
                    <input type="text" name="needs[]" id="needs" class="form-control">
                </div>
            `;
            container.appendChild(newRow);
        });

        document.getElementById('remove-row').addEventListener('click', function () {
            var container = document.getElementById('needs-container');
            if (container.children.length > 1) {
                container.removeChild(container.lastElementChild);
            }
        });
    });
</script>
@endsection