<span class="fs-5">Needs of beneficiaries:</span>
@foreach($listOfNeeds as $need)
    <div class="row mt-3 align-items-end">
        <div class="col-lg-10">
            <label for="needs" class="form-label">Need:</label>
            <input type="text" name="needs" id="needs" class="form-control" value="{{ $need->needs }}">
        </div>
    </div>
@endforeach