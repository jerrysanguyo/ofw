<span class="fs-5">Personal information:</span>
    <div class="row mt-3">
        <div class="col-lg-4">
            <label for="first_name" class="form-label">First name:</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $details->first_name }}">
        </div>
        <div class="col-lg-4">
            <label for="middle_name" class="form-label">Middle name:</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $details->middle_name }}">
        </div>
        <div class="col-lg-4">
            <label for="last_name" class="form-label">Last name:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $details->last_name }}">
        </div>
        <div class="row">
            <div class="col-md-1">
                <label for="house_number" class="form-label">House number:</label>
                <input type="text" name="house_number" id="house_number" class="form-control" value="{{ $details->userAddress->house_number ?? '' }}">
            </div>
            <div class="col-md-3">
                <label for="barangay_id" class="form-label">Barangay:</label>
                <select name="barangay_id" id="barangay_id" class="form-select">
                    @foreach($listOfBarangay as $barangay)
                        <option value="{{ $barangay->id }}" {{ (isset($userAddress) && $userAddress->barangay_id == $barangay->id) ? 'selected' : '' }}>{{ $barangay->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="street" class="form-label">Street:</label>
                <input type="text" name="street" id="street" class="form-control" value="{{ $details->userAddress->street ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="city_id" class="form-label">City:</label>
                <select name="city_id" id="city_id" class="form-select">
                    @foreach($listOfCity as $city)
                        <option value="{{ $city->id }}" {{ (isset($userAddress) && $userAddress->city_id == $city->id) ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="residence_years" class="form-label">Years of residence in taguig:</label>
                <input type="number" name="residence_years" id="residence_years" class="form-control" value="{{ $details->userAddress->residence_years ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="residence_id" class="form-label">Residence type:</label>
                <select name="residence_id" id="residence_id" class="form-select">
                    @foreach($listOfResidence as $residence)
                        <option value="{{ $residence->id }}" {{ (isset($userAddress) && $userAddress->residence_id == $residence->id) ? 'selected' : '' }}>{{ $residence->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="birthdate" class="form-label">Birthdate:</label>
                <input type="date" name="birthdate" id="birthdate" class="form-control birthdate-input" value="{{ $details->userInfo->birthdate ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="age" class="form-label">Age:</label>
                <input type="text" name="age" id="age" class="form-control age-input" readonly value="{{ $details->userInfo->age ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="gender_id" class="form-label">Gender:</label>
                <select name="gender_id" id="gender_id" class="form-select">
                    @foreach($listOfGender as $gender)
                        <option value="{{ $gender->id }}" {{ (isset($userInfo) && $userInfo->gender_id == $gender->id) ? 'selected' : '' }}>{{ $gender->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="birthplace" class="form-label">Place of birth:</label>
                <input type="text" name="birthplace" id="birthplace" class="form-control" value="{{ $details->userInfo->birthplace ?? '' }}">
            </div>
            <div class="col-md-2">
                <label for="valid_id" class="form-label">Valid Id:</label>
                <select name="valid_id" id="valid_id" class="form-select">
                    @foreach($listOfId as $validId)
                        <option value="{{ $validId->id }}" {{ (isset($userInfo) && $userInfo->valid_id == $validId->id) ? 'selected' : '' }}>{{ $validId->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="voters" class="form-label">Taguig voter?</label>
                <select name="voters" id="voters" class="form-select">
                    <option value="Yes" {{ (isset($userInfo) && $userInfo->voters == 'Yes') ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ (isset($userInfo) && $userInfo->voters == 'No') ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="education_id" class="form-label">Educational attainment:</label>
                <select name="education_id" id="education_id" class="form-select">
                    @foreach($listOfEducation as $education)
                    <option value="{{ $education->id }}" {{ (isset($userInfo) && $userInfo->education_id == $education->id) ? 'selected' : '' }}>{{ $education->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="religion_id" class="form-label">Religion:</label>
                <select name="religion_id" id="religion_id" class="form-select">
                    @foreach($listOfReligion as $religion)
                    <option value="{{ $religion->id }}" {{ (isset($userInfo) && $userInfo->religion_id == $religion->id) ? 'selected' : '' }}>{{ $religion->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="civil_id" class="form-label">Civil Status:</label>
                <select name="civil_id" id="civil_id" class="form-select">
                    @foreach($listOfCivil as $civil)
                    <option value="{{ $civil->id }}" {{ (isset($userInfo) && $userInfo->civil_id == $civil->id) ? 'selected' : '' }}>{{ $civil->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="present_job" class="form-label">Present job:</label>
                <input type="text" name="present_job" id="present_job" class="form-control" value="{{ $details->userInfo->present_job ?? '' }}">
            </div>
        </div>
    </div>