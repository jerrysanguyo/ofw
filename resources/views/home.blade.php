@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @if(Auth::user()->role === 'admin')
            @include('HomePartial.admin')
        @elseif(Auth::user()->role === 'user') 
            @include('HomePartial.user')
        @else
            @include('HomePartial.superadmin')
        @endif
    </div>
</div>

<script>
    document.getElementById('countroCountBtn').addEventListener('click', function() {
        const countryId = document.getElementById('country').value;
        if (countryId) {
            fetch('{{ route("admin.home.getOFWCount") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ country: countryId })
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('Network response was not ok');
                }
                return res.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    document.getElementById('countroCount').textContent = data.count;
                }
            })
            .catch(err => console.error('Error:', err));
        }
    });

    function fetchData(buttonId, route, startDateId, endDateId, countClass) {
        const button = document.getElementById(buttonId);
        button.onclick = () => {
            fetch(route, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    startDate: document.getElementById(startDateId).value || null,
                    endDate: document.getElementById(endDateId).value || null
                })
            })
            .then(res => res.json())
            .then(data => document.querySelector(countClass).textContent = `${data.count}`)
            .catch(err => console.error('Error:', err));
        };
    }
    
    fetchData('applicantCountBtn', '{{ route("admin.home.applicantCount") }}', 'startDate', 'endDate', '#applicantCount');
</script>
@endsection