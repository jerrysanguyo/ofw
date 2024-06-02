@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <ul class="nav nav-pills nav-fill">
            @php
                $baseRoute = Auth::user()->role === 'admin' ? 'admin' : 'user';
            @endphp
            <li class="nav-item">
                <a class="nav-link" href="{{ route($baseRoute . '.personal.create') }}">PERSONAL NA INPORMASIYON</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route($baseRoute . '.previous.create') }}">IMPORMASIYON NOONG HULING NAG TRABAHO SA ABROAD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route($baseRoute . '.household.create') }}">MGA KASAMA SA BAHAY</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route($baseRoute . '.needs.create') }}">MGA KAILANGAN NG PAMILYA</a>
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
                        $baseRoute = Auth::user()->role === 'admin' ? 'admin' : 'user';
                        $formAction = isset($previousJob) ? route("$baseRoute.previous.update", $previousJob->id) : route("$baseRoute.previous.store");
                        $formMethod = isset($previousJob) ? 'PUT' : 'POST';
                    @endphp

                    <form action="{{ $formAction }}" method="post">
                        @csrf
                        @if(isset($previousJob))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <label for="job_type" class="form-label">Job type:</label>
                                <select name="job_type" id="job_type" class="form-select">
                                    <option value="landbase" {{ isset($previousJob) && $previousJob->job_type == 'landbase' ? 'selected' : '' }}>Landbased</option>
                                    <option value="seabase" {{ isset($previousJob) && $previousJob->job_type == 'seabase' ? 'selected' : '' }}>Seabased</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="job_id" class="form-label">Job type:</label>
                                <select name="job_id" id="job_id" class="form-select">
                                    <option value="">choose..</option>
                                    @foreach($listOfJob as $job)
                                        <option value="{{ $job->id }}" {{ isset($previousJob) && $previousJob->job_id == $job->id ? 'selected' : '' }}>{{ $job->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="sub_job_id" class="form-label">Sub Job type:</label>
                                <select name="sub_job_id" id="sub_job_id" class="form-select">
                                    <!-- Sub-job options will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="continent_id" class="form-label">Continent:</label>
                                <select name="continent_id" id="continent_id" class="form-select">
                                    <option value="">choose..</option>
                                    @foreach($listOfContinent as $continent)
                                        <option value="{{ $continent->id }}" {{ isset($previousJob) && $previousJob->continent_id == $continent->id ? 'selected' : '' }}>{{ $continent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="country_id" class="form-label">Country:</label>
                                <select name="country_id" id="country_id" class="form-select">
                                    <!-- Country options will be populated via JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="years_abbroad" class="form-label">Years in abroad:</label>
                                <input type="number" name="years_abbroad" id="years_abbroad" class="form-control" value="{{ isset($previousJob) ? $previousJob->years_abbroad : '' }}">
                            </div>
                            <div class="col-md-2">
                                <label for="contract_id" class="form-label">Status of last Contract:</label>
                                <select name="contract_id" id="contract_id" class="form-select">
                                    @foreach($listOfContract as $contract)
                                        <option value="{{ $contract->id }}" {{ isset($previousJob) && $previousJob->contract_id == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="last_departure" class="form-label">Date of last departure:</label>
                                <input type="date" name="last_departure" id="last_departure" class="form-control" value="{{ isset($previousJob) ? $previousJob->last_departure : '' }}">
                            </div>
                            <div class="col-md-2">
                                <label for="last_arrival" class="form-label">Date of last arrival:</label>
                                <input type="date" name="last_arrival" id="last_arrival" class="form-control" value="{{ isset($previousJob) ? $previousJob->last_arrival : '' }}">
                            </div>
                            <div class="col-md-2">
                                <label for="owwa_id" class="form-label">Owwa membership:</label>
                                <select name="owwa_id" id="owwa_id" class="form-select">
                                    @foreach($listOfOwwa as $owwa)
                                        <option value="{{ $owwa->id }}" {{ isset($previousJob) && $previousJob->owwa_id == $owwa->id ? 'selected' : '' }}>{{ $owwa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="intent_return" class="form-label">Intent to return abroad?:</label>
                                <select name="intent_return" id="intent_return" class="form-select">
                                    <option value="yes" {{ isset($previousJob) && $previousJob->intent_return == 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ isset($previousJob) && $previousJob->intent_return == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mt-3">
                            <button type="submit" class="btn btn-primary">{{ isset($previousJob) ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jobSelect = document.getElementById('job_id');
        const subJobSelect = document.getElementById('sub_job_id');

        function fetchSubJobs(jobId, selectedSubJobId = null) {
            fetch(`/get-sub-jobs/${jobId}`)
                .then(response => response.json())
                .then(data => {
                    subJobSelect.innerHTML = '';
                    data.forEach(subJob => {
                        const option = document.createElement('option');
                        option.value = subJob.id;
                        option.textContent = subJob.name;
                        if (selectedSubJobId && subJob.id == selectedSubJobId) {
                            option.selected = true;
                        }
                        subJobSelect.appendChild(option);
                    });
                });
        }

        jobSelect.addEventListener('change', function () {
            fetchSubJobs(this.value);
        });

        @if(isset($previousJob) && $previousJob->job_id)
            fetchSubJobs({{ $previousJob->job_id }}, {{ $previousJob->sub_job_id }});
        @endif
    });
    document.addEventListener('DOMContentLoaded', function () {
        const continentSelect = document.getElementById('continent_id');
        const countrySelect = document.getElementById('country_id');

        function fetchCountries(continentId, selectedCountryId = null) {
            fetch(`/get-countries/${continentId}`)
                .then(response => response.json())
                .then(data => {
                    countrySelect.innerHTML = '';
                    data.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.id;
                        option.textContent = country.name;
                        if (selectedCountryId && country.id == selectedCountryId) {
                            option.selected = true;
                        }
                        countrySelect.appendChild(option);
                    });
                });
        }

        continentSelect.addEventListener('change', function () {
            fetchCountries(this.value);
        });

        @if(isset($previousJob) && $previousJob->continent_id)
            fetchCountries({{ $previousJob->continent_id }}, {{ $previousJob->country_id }});
        @endif
    });
</script>
@endsection