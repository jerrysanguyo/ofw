@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">List of Contract</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                        Add contract
                </button>
                @include('contract.create')
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

                    <table class="table table-striped" id="contract-table">
                        <thead>
                            <tr>
                                <th>contract name</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfContract as $contract)
                            <tr>
                                <td>{{ $contract->name }}</td>
                                <td>{{ $contract->createdBy->first_name ?? 'N/A'  }} - {{ $contract->created_at }}</td>
                                <td>{{ $contract->updatedBy->first_name ?? 'N/A' }} - {{ $contract->updated_at }}</td>
                                <td>{{ $contract->remarks ?? 'N/A' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.contract.edit', ['contract' => $contract->id]) }}">Update</a></li>
                                            <li>
                                                <form id="delete-form-{{ $contract->id }}" action="{{ route('admin.contract.destroy', ['contract' => $contract->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirmDelete({{ $contract->id }})">Delete contract</button>
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
        $('#contract-table').DataTable({
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