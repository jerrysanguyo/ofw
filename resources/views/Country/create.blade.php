<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.country.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createLabel">Country Insertion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="name" class="form-label">Country:</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <label for="continent_id" class="form-label">Continent:</label>
                    <select name="continent_id" id="continent_id" class="form-select">
                        @foreach($listOfContinent as $continent)
                            <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
