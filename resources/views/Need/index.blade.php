@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-1">
                <span class="fs-3">List of need</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                        Add need
                </button>
                @include('need.create')
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

                    <table class="table table-striped" id="need-table">
                        <thead>
                            <tr>
                                <th>Need name</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfNeed as $need)
                            <tr>
                                <td>{{ $need->name ?? 'N/A' }}</td>
                                <td>{{ $need->createdBy->first_name ?? 'N/A'  }} - {{ $need->created_at }}</td>
                                <td>{{ $need->updatedBy->first_name ?? 'N/A' }} - {{ $need->updated_at }}</td>
                                <td>{{ $need->remarks ?? 'N/A' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.need.edit', ['need' => $need->id]) }}">Update</a></li>
                                            <li>
                                                <form id="delete-form-{{ $need->id }}" action="{{ route('admin.need.destroy', ['need' => $need->id]) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirmDelete({{ $need->id }})">Delete need</button>
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
        $('#need-table').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
        });
    });

    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this Need?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
    </script>
@endpush
@endsection