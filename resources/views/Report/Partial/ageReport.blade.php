<form id="ageForm" action="{{ route('age.export') }}" method="GET">
    @csrf
    <span class="fs-4"><i class="fa-solid fa-handshake m-3"></i>Beneficiary count report</span>
    <div class="row align-items-end mt-4">
        <div class="col-md-4">
            <label for="ageBracket" class="form-label">Age bracket:</label>
            <select name="ageBracket" id="ageBracket" class="form-select">
                <option value="0-10">0-10 years old</option>
                <option value="11-20">11-20 years old</option>
                <option value="21-99">21-above years old</option>
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
        <button type="submit" id="excelBtn" class="btn btn-primary mt-4 mt-lg-0">Generate Excel</button>
    </div>
</form>