@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
            <span class="fs-3">List of Barangay</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                        Add barangay
                </button>
                @include('Barangay.create')
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

                    <table class="table table-striped" id="barangay-table">
                        <thead>
                            <tr>
                                <th>Barangay name</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfBarangay as $barangay)
                            <tr>
                                <td>{{ $barangay->name }}</td>
                                <td>{{ $barangay->createdBy->first_name ?? 'N/A'  }} - {{ $barangay->created_at }}</td>
                                <td>{{ $barangay->updatedBy->first_name ?? 'N/A' }} - {{ $barangay->updated_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.barangay.edit', ['barangay' => $barangay->id]) }}">Update</a></li>
                                            <li>
                                                <form id="delete-form-{{ $barangay->id }}" action="{{ route('admin.barangay.destroy', ['barangay' => $barangay->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirmDelete({{ $barangay->id }})">Delete Barangay</button>
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
        $('#barangay-table').DataTable({
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