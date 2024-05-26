@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.personal.create') }}">PERSONAL NA INPORMASIYON</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">IMPORMASIYON NOONG HULING NAG TRABAHO SA ABROAD</a>
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

                    @php
                        $formAction = $household->isNotEmpty() ? route('admin.household.update') : route('admin.household.store');
                        $formMethod = $household->isNotEmpty() ? 'PUT' : 'POST';
                    @endphp

                    <form action="{{ $formAction }}" method="POST">
                        @csrf
                        @if($household->isNotEmpty())
                            @method('PUT')
                        @endif

                        <div id="household-container">
                            @forelse($household as $index => $householdItem)
                                <div class="row household-row">
                                    <input type="hidden" name="id[]" value="{{ $householdItem->id }}">
                                    <div class="col-lg-3">
                                        <label for="full_name" class="form-label">Full name</label>
                                        <input type="text" name="full_name[]" class="form-control" value="{{ $householdItem->full_name }}">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="relation_id" class="form-label">Relationship</label>
                                        <select name="relation_id[]" class="form-select">
                                            @foreach($listOfRelation as $relation)
                                                <option value="{{ $relation->id }}" {{ $householdItem->relation_id == $relation->id ? 'selected' : '' }}>{{ $relation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input type="date" name="birthdate[]" class="form-control birthdate-input" value="{{ $householdItem->birthdate }}">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" name="age[]" class="form-control age-input" readonly value="{{ $householdItem->age }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="work" class="form-label">Work</label>
                                        <input type="text" name="work[]" class="form-control" value="{{ $householdItem->work }}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="monthly_income" class="form-label">Monthly income</label>
                                        <input type="text" name="monthly_income[]" class="form-control" value="{{ $householdItem->monthly_income }}">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="voters" class="form-label">Taguig voters?</label>
                                        <select name="voters[]" class="form-select">
                                            <option value="yes" {{ $householdItem->voters == 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $householdItem->voters == 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            @empty
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
                            @endforelse
                        </div>
                        <!-- Buttons for add and remove row -->
                        <div class="d-flex flex-row-reverse mt-3">
                            <button type="button" id="add-row" class="btn btn-success ms-2">Add Row</button>
                            <button type="button" id="remove-row" class="btn btn-danger">Remove Last Row</button>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3">
                            <button type="submit" class="btn btn-primary">{{ $household->isNotEmpty() ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
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
