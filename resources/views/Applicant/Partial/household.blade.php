<span class="fs-5">Beneficiaries:</span>
@foreach($household as $member)
<div class="row align-items-end">
    <div class="col-md-3">
        <label for="full_name_{{ $loop->index }}" class="form-label">Full name</label>
        <input type="text" name="full_name[]" id="full_name_{{ $loop->index }}" class="form-control" value="{{ $member->full_name }}">
        @error('full_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-1">
        <label for="relation_id_{{ $loop->index }}" class="form-label">Relationship</label>
        <select name="relation_id[]" class="form-select" id="relation_id_{{ $loop->index }}">
            @foreach($listOfRelation as $relation)
                <option value="{{ $relation->id }}" {{ $relation->id == $member->relation_id ? 'selected' : '' }}>{{ $relation->name }}</option>
            @endforeach
        </select>
        @error('relation_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-1">
        <label for="birthdate_{{ $loop->index }}" class="form-label">Birthdate</label>
        <input type="date" id="birthdate_{{ $loop->index }}" name="birthdate[]" class="form-control birthdate-input" value="{{ $member->birthdate }}">
        @error('birthdate')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-1">
        <label for="age_{{ $loop->index }}" class="form-label">Age</label>
        <input type="number" id="age_{{ $loop->index }}" name="age[]" class="form-control age-input" value="{{ $member->age }}">
    </div>
    <div class="col-md-2">
        <label for="work_{{ $loop->index }}" class="form-label">Work</label>
        <input type="text" id="work_{{ $loop->index }}" name="work[]" class="form-control" value="{{ $member->work }}">
        @error('work')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-2">
        <label for="monthly_income_{{ $loop->index }}" class="form-label">Monthly income</label>
        <input type="text" id="monthly_income_{{ $loop->index }}" name="monthly_income[]" class="form-control" value="{{ $member->monthly_income }}">
        @error('monthly_income')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-1">
        <label for="voters_{{ $loop->index }}" class="form-label">Taguig voters?</label>
        <select name="voters[]" id="voters_{{ $loop->index }}" class="form-select">
            <option value="yes" {{ $member->voters == 'yes' ? 'selected' : '' }}>Yes</option>
            <option value="no" {{ $member->voters == 'no' ? 'selected' : '' }}>No</option>
        </select>
        @error('voters')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-1 d-flex justify-content-md-start">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</div>
@endforeach