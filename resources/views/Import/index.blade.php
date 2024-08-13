@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <span class="fs-3">Archived data</span>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                Add need
        </button>
        @include('import.create')
    </div>
    <div class="card shadow border">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped" id="archive-table">
                <thead>
                    <tr>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Cpntact Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listOfArchiveUser as $user)
                    <tr>
                        <td>{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.import.edit', ['import' => $user->id]) }}">Update</a></li>
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
@push('scripts')
    <script>
    $(document).ready(function() {
        $('#archive-table').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
        });
    });
    </script>
@endpush
@endsection
