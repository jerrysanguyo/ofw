@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow border">
                <div class="card-body">
                    @include('Report/Partial/ageReport')
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border shadow">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border shadow">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('ageCountBtn').addEventListener('click', function() {
    const startAge = document.getElementById('startAge').value;
    const endAge = document.getElementById('endAge').value;

    fetch('{{ route("admin.home.ageCount") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            startAge: startAge,
            endAge: endAge
        })
    })
    .then(response => response.json())
    .then(data => {
        const ageCountElement = document.getElementById('AgeCount');
        ageCountElement.innerHTML = '';
        
        Object.keys(data.counts).forEach(age => {
            const count = data.counts[age];
            const countText = document.createElement('div');
            countText.textContent = `${age} - ${count}`;
            ageCountElement.appendChild(countText);
        });
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection