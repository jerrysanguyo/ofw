<span class="fs-5">Beneficiaries:</span>
@foreach($household as $index => $member)
<form action="{{ route('admin.applicant.houseUpdate', $member->id) }}">
    @csrf
    @method('PUT')
    <div class="row align-items-end mt-3">
        <div class="col-lg-3">
            <label for="full_name_{{ $index }}" class="form-label">Full name</label>
            <input type="text" name="full_name" id="full_name_{{ $index }}" class="form-control" value="{{ $member->full_name }}">
        </div>
        <div class="col-lg-3">
            <label for="relation_id_{{ $index }}" class="form-label">Relationship</label>
            <select name="relation_id" class="form-select" id="relation_id_{{ $index }}">
                @foreach($listOfRelation as $relation)
                    <option value="{{ $relation->id }}" {{ $relation->id == $member->relation_id ? 'selected' : '' }}>{{ $relation->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3">
            <label for="birthdate_{{ $index }}" class="form-label">Birthdate</label>
            <input type="date" id="birthdate_{{ $index }}" name="birthdate" class="form-control birthdate-input" value="{{ $member->birthdate }}">
        </div>
        <div class="col-lg-2">
            <label for="age_{{ $index }}" class="form-label">Age</label>
            <input type="number" id="age_{{ $index }}" name="age" class="form-control age-input" value="{{ $member->age }}">    </div>
        <div class="col-lg-3">
            <label for="work_{{ $index }}" class="form-label">Work</label>
            <input type="text" id="work_{{ $index }}" name="work" class="form-control" value="{{ $member->work }}">
        </div>
        <div class="col-lg-3">
            <label for="monthly_income_{{ $index }}" class="form-label">Monthly income</label>
            <input type="text" id="monthly_income_{{ $index }}" name="monthly_income" class="form-control" value="{{ $member->monthly_income }}">
        </div>
        <div class="col-lg-3">
            <label for="voters" class="form-label">Taguig voters?</label>
            <select name="voters" id="voters" class="form-select">
                <option value="yes" {{ $member->voters == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $member->voters == 'no' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-lg-3">
            <input type="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
</form>
<hr>
@endforeach
