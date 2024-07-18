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
                    @include('Report/Partial/countryReport')
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border shadow">
                <div class="card-body"></div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item border shadow">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <span class="fs-5"><i class="fa-solid fa-filter mx-3" style="color: #B197FC;"></i> Filter</span> 
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('submitBtn').addEventListener('click', function() {
    const ageBracket = document.getElementById('ageBracket').value.split('-');
    const startAge = ageBracket[0];
    const endAge = ageBracket[1];

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

document.getElementById('countrySubmitBtn').addEventListener('click', function() {
    const countryId = document.getElementById('country').value;
    fetch(`/admin/country-count?country=${countryId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                document.getElementById('countryCount').textContent = `Error: ${data.error}`;
            } else {
                document.getElementById('countryCount').textContent = data.count;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('countryCount').textContent = 'Error fetching country count';
        });
});

document.getElementById('excelBtn').addEventListener('click', function() {
    document.getElementById('ageForm').submit();
});
</script>
@endsection
