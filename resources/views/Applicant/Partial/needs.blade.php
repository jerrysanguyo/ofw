<span class="fs-5">Needs of beneficiaries:</span>
@foreach($listOfNeeds as $need)
    <div class="row mb-3 align-items-end">
        <div class="col-md-11">
            <label for="needs" class="form-label">Need:</label>
            <input type="text" name="needs" id="needs" class="form-control" value="{{ $need->needs }}">
        </div>
        <div class="col-md-1 d-flex justify-content-md-start">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
@endforeach