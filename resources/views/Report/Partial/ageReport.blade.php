<form id="ageForm">
    @csrf
    <span class="fs-4"><i class="fa-solid fa-handshake m-3"></i>Beneficiary count report</span>
    <div class="row align-items-end mt-4">
        <div class="col-md-4">
            <label for="startAge" class="form-label">Age from:</label>
            <select name="startAge" id="startAge" class="form-select">
                @php
                    for($i=1; $i<=100; $i++) {
                        echo '<option value="' . $i . '">' . $i . ' Years old</option>';
                    }
                @endphp
            </select>
        </div>
        <div class="col-md-4">
            <label for="endAge" class="form-label">To:</label>
            <select name="endAge" id="endAge" class="form-select">
                @php
                    for($i=1; $i<=100; $i++) {
                        echo '<option value="' . $i . '">' . $i . ' Years old</option>';
                    }
                @endphp
            </select>
        </div>
        <div class="col-md-4 d-flex justify-content-md-start">
            <button type="button" id="submitBtn" class="btn btn-primary mt-4 mt-md-0">Submit</button>
        </div>
    </div>
    <hr>
    <div class="row text-center m-3">
        <span id="AgeCount" class="fs-1"></span>
    </div>
    <div class="d-grid gap-2 text-center">
        <button type="button" id="excelBtn" class="btn btn-primary mt-4 mt-lg-0">Generate Excel</button>
    </div>
</form>