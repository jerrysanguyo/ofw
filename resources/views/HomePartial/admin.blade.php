<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="card border shadow">
                    <div class="card-body">
                        <span class="fs-4"><i class="fa-solid fa-handshake m-3"></i>Total Applicant</span>
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
                            <span id="applicantCount" class="fs-1">{{ $totalCountApplicant }}</span>
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
                        <span class="fs-4"><i class="fa-solid fa-handshake m-3"></i>OFW per country</span>
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                        <div class="row align-items-end mt-4">
                            <div class="col-md-4">
                                <label for="continent" class="form-label">Continent:</label>
                                <select name="continent" id="continent" class="form-select">
                                    <option value="">Asia</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="country" class="form-label">Country:</label>
                                <select name="country" id="country" class="form-select">
                                    <option value="">Japan</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex justify-content-md-start">
                                <button id="generateButtonBorrowed" class="btn btn-primary mt-4 mt-md-0">Generate</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center m-3"> 
                            <span id="borrowCount" class="fs-1">300</span>
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact number</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Calunsod, Pedro</td>
                                    <td>09999999999</td>
                                    <td>Pedro@gmail.com</td>
                                    <td>Pakistan</td>
                                </tr>
                                <tr>
                                    <td>Doe, John</td>
                                    <td>09999999991</td>
                                    <td>Doe@gmail.com</td>
                                    <td>Canada</td>
                                </tr>
                                <tr>
                                    <td>Ipsum, Lorem</td>
                                    <td>09999999992</td>
                                    <td>Ipsum@gmail.com</td>
                                    <td>Korea</td>
                                </tr>
                                <tr>
                                    <td>Esto, Renato</td>
                                    <td>09999999993</td>
                                    <td>Esto@gmail.com</td>
                                    <td>Russia</td>
                                </tr>
                                <tr>
                                    <td>Dela, Oscar</td>
                                    <td>09999999994</td>
                                    <td>Dela@gmail.com</td>
                                    <td>Africa</td>
                                </tr>
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
                <div id="piechart" style="width: 100%; height: 630px;"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Name', 'Count'],
        ['Food',     11],
        ['Water',      2],
        ['Cash',  2],
        ['Clothes', 2],
        ['Grocery',    7]
    ]);

    var options = {
        title: 'OFW family Needs'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
    }
</script>