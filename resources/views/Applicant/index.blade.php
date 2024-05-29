@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">List of applicant</span>
                <a href="{{ route('admin.home') }}" class="text-decoration-none">
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

                    <table class="table table-striped" id="applicant-table">
                        <thead>
                            <tr>
                                <th>Applicant name</th>
                                <th>Mobile number</th>
                                <th>Date of birth</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfApplicant as $applicant)
                            <tr>
                                <td>{{ $applicant->last_name .', '. $applicant->first_name .' '. $applicant->middle_name }}</td>
                                <td>{{ $applicant->contact_number ?? 'N/A' }}</td>
                                <td>{{ $applicant->userInfo->birthdate ?? 'N/A'  }}</td>
                                <td>
                                    {{  
                                        $applicant->userAddress->house_number .' '.
                                        $applicant->userAddress->barangay->name .' '.
                                        $applicant->userAddress->street .' '.
                                        $applicant->userAddress->city->name 
                                        ?? 'N/A' 
                                    }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.applicant.edit', ['applicant' => $applicant->id]) }}">Update</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
    $(document).ready(function() {
        $('#applicant-table').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
        });
    });

    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this applicant?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
    </script>
@endpush
@endsection