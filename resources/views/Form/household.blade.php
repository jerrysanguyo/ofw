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
                <a class="nav-link active" href="{{ route('admin.household.create') }}">MGA KASAMA SA BAHAY</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">MGA KAILANGAN NG PAMILYA</a>
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

                    @if($listOfComposition->isEmpty())
                    <form action="{{ route('admin.household.store') }}" method="POST">
                        @csrf
                        <div id="household-container">
                            <div class="row household-row">
                                <div class="col-lg-3">
                                    <label for="full_name" class="form-label">Full name</label>
                                    <input type="text" name="full_name[]" class="form-control">
                                </div>
                                <div class="col-lg-1">
                                    <label for="relation_id" class="form-label">Relationship</label>
                                    <select name="relation_id[]" class="form-select">
                                        @foreach($listOfRelation as $relation)
                                            <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <label for="birthdate" class="form-label">Birthdate</label>
                                    <input type="date" name="birthdate[]" class="form-control birthdate-input">
                                </div>
                                <div class="col-lg-1">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" name="age[]" class="form-control age-input" readonly>
                                </div>
                                <div class="col-lg-3">
                                    <label for="work" class="form-label">Work</label>
                                    <input type="text" name="work[]" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                    <label for="monthly_income" class="form-label">Monthly income</label>
                                    <input type="text" name="monthly_income[]" class="form-control">
                                </div>
                                <div class="col-lg-1">
                                    <label for="voters" class="form-label">Taguig voters?</label>
                                    <select name="voters[]" class="form-select">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons for add and remove row -->
                        <div class="d-flex flex-row-reverse mt-3">
                            <button type="button" id="add-row" class="btn btn-success ms-2">Add Row</button>
                            <button type="button" id="remove-row" class="btn btn-danger">Remove Last Row</button>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @else
                        @foreach($listOfComposition as $household)
                            <!-- Display existing household compositions -->
                            <form action="{{ route('admin.household.update', $household->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row household-row">
                                    <div class="col-lg-3">
                                        <label for="full_name" class="form-label">Full name</label>
                                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $household->full_name }}">
                                        @error('full_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="relation_id" class="form-label">Relationship</label>
                                        <select name="relation_id" class="form-select" id="relation_id">
                                            @foreach($listOfRelation as $relation)
                                                <option value="{{ $relation->id }}" {{ $relation->id == $household->relation_id ? 'selected' : '' }}>{{ $relation->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('relation_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input type="date" id="birthdate" name="birthdate" class="form-control birthdate-input" value="{{ $household->birthdate }}">
                                        @error('birthdate')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" id="age" name="age" class="form-control age-input" value="{{ $household->age }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="work" class="form-label">Work</label>
                                        <input type="text" id="work" name="work" class="form-control" value="{{ $household->work }}">
                                        @error('work')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="monthly_income" class="form-label">Monthly income</label>
                                        <input type="text" id="monthly_income" name="monthly_income" class="form-control" value="{{ $household->monthly_income }}">
                                        @error('monthly_income')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="voters" class="form-label">Taguig voters?</label>
                                        <select name="voters" id="voters" class="form-select">
                                            <option value="yes" {{ $household->voters == 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $household->voters == 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('voters')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex flex-row-reverse p-3">
                                        <input type="submit" value="Update" class="btn btn-primary">
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
document.addEventListener("DOMContentLoaded", function() {
    const householdContainer = document.getElementById('household-container');
    const addRowButton = document.getElementById('add-row');
    const removeRowButton = document.getElementById('remove-row');

    function calculateAge(birthdate) {
        const today = new Date();
        let age = today.getFullYear() - birthdate.getFullYear();
        const m = today.getMonth() - birthdate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
            age--;
        }
        return age;
    }

    function addEventListenersToRow(row) {
        const birthdateInput = row.querySelector('.birthdate-input');
        const ageInput = row.querySelector('.age-input');

        birthdateInput.addEventListener('change', function() {
            const birthdate = new Date(this.value);
            const age = calculateAge(birthdate);
            ageInput.value = age;
        });
    }

    addRowButton.addEventListener('click', function() {
        const newRow = document.querySelector('.household-row').cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        addEventListenersToRow(newRow);
        householdContainer.appendChild(newRow);
    });

    removeRowButton.addEventListener('click', function() {
        const rows = householdContainer.querySelectorAll('.household-row');
        if (rows.length > 1) {
            householdContainer.removeChild(rows[rows.length - 1]);
        }
    });

    document.querySelectorAll('.household-row').forEach(addEventListenersToRow);
});
</script>
@endsection