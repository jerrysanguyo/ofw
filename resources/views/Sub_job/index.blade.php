@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">List of Sub job</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                        Add Sub job
                </button>
                @include('sub_job.create')
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

                    <table class="table table-striped" id="subjob-table">
                        <thead>
                            <tr>
                                <th>Sub job name</th>
                                <th>Job Type</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfSubJob as $subjob)
                            <tr>
                                <td>{{ $subjob->name }}</td>
                                <td>{{ $subjob->job->name }}</td>
                                <td>{{ $subjob->createdBy->first_name ?? 'N/A'  }} - {{ $subjob->created_at }}</td>
                                <td>{{ $subjob->updatedBy->first_name ?? 'N/A' }} - {{ $subjob->updated_at }}</td>
                                <td>{{ $subjob->remarks ?? 'N/A' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.subjob.edit', ['subjob' => $subjob->id]) }}">Update</a></li>
                                            <li>
                                                <form id="delete-form-{{ $subjob->id }}" action="{{ route('admin.subjob.destroy', ['subjob' => $subjob->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirmDelete({{ $subjob->id }})">Delete subjob</button>
                                                </form>
                                            </li>
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
        $('#subjob-table').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
        });
    });

    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this Barangay?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
    </script>
@endpush
@endsection