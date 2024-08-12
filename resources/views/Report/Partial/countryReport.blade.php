<form id="countryForm" action="{{ route('admin.country.export') }}" method="GET">
    @csrf
    <span class="fs-4"><i class="fa-solid fa-handshake m-3"></i>Country count report</span>
    <div class="row align-items-end mt-4">
        <div class="col-md-10">
            <label for="country" class="form-label">Country:</label>
            <select name="country" id="country" class="form-select">
                @foreach($listOfCountry as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex justify-content-md-start">
            <button type="button" id="countrySubmitBtn" class="btn btn-primary mt-4 mt-md-0">Submit</button>
        </div>
    </div>
    <hr>
    <div class="row text-center m-3">
        <span id="countryCount" class="fs-1"></span>
    </div>
    <div class="d-grid gap-2 text-center">
        <button type="submit" id="countryExcelBtn" class="btn btn-primary mt-4 mt-lg-0">Generate Excel</button>
    </div>
</form>