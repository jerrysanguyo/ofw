@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">Applicant details</span>
                <a href="{{ route('admin.applicant.index') }}" class="text-decoration-none">
                    <button class="btn btn-primary">
                        Back
                    </button>
                </a>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow border">
                        <div class="card-body" style="height:550px;">
                            <span class="fs-5">Personal information:</span>
                            <div class="row">
                                <label for="name" class="col-sm-4 col-form-label">Full name:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="name" 
                                    value="{{ 
                                        $details->last_name ?? 'N/A' .', '. 
                                        $details->first_name ?? 'N/A' .' '. 
                                        $details->middle_name ?? 'N/A' 
                                    }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="Email" class="col-sm-4 col-form-label">Email:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="Email" value="{{ $details->email ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="contact_number" class="col-sm-4 col-form-label">Contact number:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="contact_number" value="{{ $details->contact_number ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="address" class="col-sm-4 col-form-label">Address:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="address" 
                                    value="{{ 
                                        $details->userAddress->house_number .' '.
                                        $details->userAddress->barangay->name .' '.
                                        $details->userAddress->street .' '.
                                        $details->userAddress->city->name
                                    }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="residence" class="col-sm-4 col-form-label">Residence type:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="residence" value="{{ $details->userAddress->residence->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="residence" class="col-sm-4 col-form-label">Years of residence in taguig:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="residence" value="{{ $details->userAddress->residence_years ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="birthdate" class="col-sm-4 col-form-label">birthdate & age:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="birthdate" value="{{ $details->userInfo->birthdate ?? 'N/A' .' - '. $details->userInfo->age ?? 'N/A' .' years old'}}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="birthplace" class="col-sm-4 col-form-label">Birthplace:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="birthplace" value="{{ $details->userInfo->birthplace ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="religion" class="col-sm-4 col-form-label">Religion:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="religion" value="{{ $details->userInfo->religion->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="civil" class="col-sm-4 col-form-label">Civil:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="civil" value="{{ $details->userInfo->civil->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="educational_attainment" class="col-sm-4 col-form-label">Educational attainment:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="educational_attainment" value="{{ $details->userInfo->education->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="present_job" class="col-sm-4 col-form-label">Present job:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="present_job" value="{{ $details->userInfo->present_job ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="voters" class="col-sm-4 col-form-label">Voters in taguig?:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="voters" value="{{ $details->userInfo->voters ?? 'N/A' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow border">
                        <div class="card-body" style="height:550px;">
                            <span class="fs-5">Previous job:</span>
                            <div class="row">
                                <label for="job_type" class="col-sm-6 col-form-label">Job type:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="job_type" value="{{ $details->userPrevious->job_type ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="job" class="col-sm-6 col-form-label">Job:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="job" value="{{ $details->userPrevious->job->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="subJob" class="col-sm-6 col-form-label">Sub subJob:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="subJob" value="{{ $details->userPrevious->subJob->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="continent" class="col-sm-6 col-form-label">Continent:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="continent" value="{{ $details->userPrevious->continent->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="country" class="col-sm-6 col-form-label">Country:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="country" value="{{ $details->userPrevious->country->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="years_abroad" class="col-sm-6 col-form-label">Year/s in abroad:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="years_abroad" value="{{ $details->userPrevious->years_abbroad ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="contract" class="col-sm-6 col-form-label">Contract:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="contract" value="{{ $details->userPrevious->contract->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="last_departure" class="col-sm-6 col-form-label">Last departure:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="last_departure" value="{{ $details->userPrevious->last_departure ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="last_arrival" class="col-sm-6 col-form-label">Last arrival:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="last_arrival" value="{{ $details->userPrevious->last_arrival ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="owwa" class="col-sm-6 col-form-label">Owwa:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="owwa" value="{{ $details->userPrevious->owwa->name ?? 'N/A' }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="intent_return" class="col-sm-6 col-form-label">Intent to return?:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext" id="intent_return" value="{{ $details->userPrevious->intent_return ?? 'N/A' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow border">
                                <div class="card-body overflow-auto" style="height:275px">
                                    <span class="fs-5">Household:</span>
                                    @foreach ($details->userHousehold as $household)
                                    <div class="row">
                                        <label for="full_name" class="col-sm-4 col-form-label">Full name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="full_name" value="{{ $household->full_name ?? 'N/A' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="relation" class="col-sm-4 col-form-label">Relationship:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="relation" value="{{ $household->relationship->name ?? 'N/A' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="birthdate" class="col-sm-4 col-form-label">Birthdate and Age:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="birthdate" value="{{ $household->birthdate ?? 'N/A' .' - '. $household->age ?? 'N/A' .' years old'}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="work" class="col-sm-4 col-form-label">work:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="work" value="{{ $household->work ?? 'N/A' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="monthly_income" class="col-sm-4 col-form-label">Monthly income:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="monthly_income" value="{{ $household->monthly_income ?? 'N/A' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="voters" class="col-sm-4 col-form-label">Voter in taguig?:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="voters" value="{{ $household->voters ?? 'N/A' }}">
                                        </div>
                                    </div>
                                    <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="card shadow border">
                                <div class="card-body overflow-auto" style="height:255px">
                                    <span class="fs-5">Needs:</span>
                                    <ol class="list-group list-group-numbered">
                                        @foreach($details->userNeeds as $needs)
                                            <li class="list-group-item">
                                                <span class="fs-6">{{ $needs->needs ?? 'N/A' }}</span>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection