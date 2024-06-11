<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="card border shadow">
                    <div class="card-body">
                        <span class="fs-4"><i class="fa-solid fa-suitcase m-3" style="color: #74C0FC;"></i></i>Total Applicant</span>
                        <div class="row align-items-end mt-4">
                            <div class="col-md-4">
                                <label for="startDate" class="form-label">Start date:</label>
                                <input type="date" id="startDate" class="form-control"> 
                            </div>
                            <div class="col-md-4">
                                <label for="endDate" class="form-label">End date:</label>
                                <input type="date" id="endDate" class="form-control">
                            </div>
                            <div class="col-md-4 d-flex justify-content-md-start">
                                <button id="applicantCountBtn" class="btn btn-primary mt-4 mt-md-0">Generate</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center m-3"> 
                            <span id="applicantCount" class="fs-1"></span>
                        </div>
                        <div class="d-grid gap-2 text-center">
                            <a href="#">
                                <button class="btn btn-primary">View details</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border shadow">
                    <div class="card-body">
                        <span class="fs-4"><i class="fa-solid fa-globe m-3" style="color: #B197FC;"></i></i>OFW per Continent</span>
                        <div class="row">
                            <div class="col-md-12"></div>
                        </div>
                        <div class="row align-items-end mt-4">
                            <div class="col-md-8">
                                <label for="continent" class="form-label">Continent:</label>
                                <select name="continent" id="continent" class="form-select">
                                    @foreach($listOfContinent as $continent)
                                    <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 d-flex justify-content-md-start">
                                <button id="countroCountBtn" class="btn btn-primary mt-4 mt-md-0">Generate</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center m-3">
                            <span id="countroCount" class="fs-1"></span>
                        </div>
                        <div class="row text-center m-3">
                            <ul id="countryList" class="list-unstyled"></ul>
                        </div>
                        <div class="d-grid gap-2 text-center">
                            <a href="#">
                                <button class="btn btn-primary">View details</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card border shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-end flex-column mb-3">
                            <a href="{{ route('admin.applicant.index') }}">
                                <button class="btn btn-primary">View more records</button>
                            </a>
                        </div>
                        <table class="table table-striped" id="applicant-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact number</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listOfApplicant as $applicant)
                                <tr>
                                    <td>
                                        {{ 
                                            ($applicant->last_name ?? 'N/A') . ', ' .
                                            ($applicant->first_name ?? 'N/A') . ' ' . 
                                            ($applicant->middle_name ?? 'N/A')
                                        }}
                                    </td>
                                    <td>{{ $applicant->contact_number ?? 'N/A' }}</td>
                                    <td>{{ $applicant->email ?? 'N/A' }}</td>
                                    <td>{{ $applicant->userPrevious->country->name ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border shadow">
            <div class="card-body">
                <span class="fs-4"><i class="fa-solid fa-map m-3" style="color: #63E6BE;"></i>Geo graph</span>
                @include('HomePartial.graph.geo', ['chartDataJson' => $chartDataJson])
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-4">
        <div class="card shadow border">
            <div class="card-body">
                <span class="fs-4"><i class="fa-solid fa-house m-3" style="color: #FFD43B;"></i>Beneficiaries graph</span>
                <canvas id="beneficiaryChart" style="width:100%; height: 530px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow border">
            <div class="card-body">
                <span class="fs-4"><i class="fa-solid fa-cart-shopping m-3" style="color: #a040ba;"></i>Needs graph</span>
                <canvas id="needsChart" style="width:100%; height: 530px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow border">
            <div class="card-body">
                <span class="fs-4"><i class="fa-solid fa-briefcase m-3" style="color: #d57e1a;"></i>Job type graph</span>
                <canvas id="job_type_chart" style="width:100%; height: 530px"></canvas>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // datatable
    $(document).ready(function() {
        $('#applicant-table').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 5,
            "order": [[0, "desc"]],
        });
    });

    // counts
    document.getElementById('countroCountBtn').addEventListener('click', function() {
        var continentId = document.getElementById('continent').value;
        var countroCountSpan = document.getElementById('countroCount');
        var countryList = document.getElementById('countryList');

        countroCountSpan.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';

        fetch('/get-countries-by-continent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ continent: continentId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                countroCountSpan.textContent = 'Error: ' + data.error;
            } else {
                countroCountSpan.textContent = '';
                countryList.innerHTML = '';

                data.forEach(country => {
                    var listItem = document.createElement('li');
                    listItem.textContent = `${country.country_name}: ${country.count}`;
                    countryList.appendChild(listItem);
                });
            }
        })
        .catch(error => {
            countroCountSpan.textContent = 'An error occurred';
            console.error('Error fetching countries:', error);
        });
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

    // charts
    document.addEventListener('DOMContentLoaded', function () {
        function createChart(elementId, labels, data, chartType) {
            var ctx = document.getElementById(elementId).getContext('2d');

            var colors = window.chartConfig.chartColors.slice();
            var borderColors = window.chartConfig.chartBorderColors.slice();

            if (labels.length > colors.length) {
                var additionalColors = window.chartConfig.generateAdditionalColors(labels.length - colors.length);
                colors = colors.concat(additionalColors.additionalColors);
                borderColors = borderColors.concat(additionalColors.additionalBorderColors);
           }

           return new Chart(ctx, {
               type: chartType,
               data: {
                   labels: labels,
                   datasets: [{
                       label: '',
                       data: data,
                       backgroundColor: colors,
                       borderColor: borderColors,
                       borderWidth: 1
                   }]
               }
           });
       }

        var beneficiaryLabels = @json($distinctBeneficiary->pluck('age'));
        var beneficiaryData = @json($distinctBeneficiary->pluck('beneficiaryCount'));
        createChart('beneficiaryChart', beneficiaryLabels, beneficiaryData, 'pie');

       var needsLabels = @json($distinctNeeds->pluck('needs'));
       var needsData = @json($distinctNeeds->pluck('needsCount'));
       createChart('needsChart', needsLabels, needsData, 'doughnut');

       var jobTypesLabels = @json($distinctJobTypes->pluck('job_type'));
       var jobTypesData = @json($distinctJobTypes->pluck('count'));
       createChart('job_type_chart', jobTypesLabels, jobTypesData, 'bar');
    });
</script>
@endpush