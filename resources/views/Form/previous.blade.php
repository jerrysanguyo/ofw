<form action="{{ route('admin.household.store') }}" method="POST">
    @csrf
    <div id="household-container" class="mt-3">
        <div class="row household-row">
            <div class="col-lg-3">
                <label for="full_name" class="form-label">Full name</label>
                <input type="text" name="full_name[]" class="form-control">
            </div>
            <div class="col-lg-1">
                <label for="relation_id" class="form-label">Relationship</label>
                <select name="relation_id[]" class="form-select">
                    @foreach($listOfRelation as $relation)
                        <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-1">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" name="birthdate[]" class="form-control birthdate-input">
            </div>
            <div class="col-lg-1">
                <label for="age" class="form-label">Age</label>
                <input type="number" name="age[]" class="form-control age-input" readonly>
            </div>
            <div class="col-lg-3">
                <label for="work" class="form-label">Work</label>
                <input type="text" name="work[]" class="form-control">
            </div>
            <div class="col-lg-2">
                <label for="monthly_income" class="form-label">Monthly income</label>
                <input type="text" name="monthly_income[]" class="form-control">
            </div>
            <div class="col-lg-1">
                <label for="voters" class="form-label">Taguig voters?</label>
                <select name="voters[]" class="form-select">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Buttons for add and remove row -->
    <div class="d-flex flex-row-reverse mt-3">
        <button type="button" id="add-row" class="btn btn-primary ms-2">Add Row</button>
        <button type="button" id="remove-row" class="btn btn-danger">Remove Last Row</button>
    </div>
    <div class="d-flex flex-row-reverse mt-3">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>
                    
<script>
document.addEventListener("DOMContentLoaded", function() {
    const householdContainer = document.getElementById('household-container');
    const addRowButton = document.getElementById('add-row');
    const removeRowButton = document.getElementById('remove-row');

    function calculateAge(birthdate) {
        const today = new Date();
        let age = today.getFullYear() - birthdate.getFullYear();
        const m = today.getMonth() - birthdate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
            age--;
        }
        return age;
    }

    function addEventListenersToRow(row) {
        const birthdateInput = row.querySelector('.birthdate-input');
        const ageInput = row.querySelector('.age-input');

        birthdateInput.addEventListener('change', function() {
            const birthdate = new Date(this.value);
            const age = calculateAge(birthdate);
            ageInput.value = age;
        });
    }

    addRowButton.addEventListener('click', function() {
        const newRow = document.querySelector('.household-row').cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        addEventListenersToRow(newRow);
        householdContainer.appendChild(newRow);
    });

    removeRowButton.addEventListener('click', function() {
        const rows = householdContainer.querySelectorAll('.household-row');
        if (rows.length > 1) {
            householdContainer.removeChild(rows[rows.length - 1]);
        }
    });

    // Add event listeners to the initial row
    document.querySelectorAll('.household-row').forEach(addEventListenersToRow);
});
</script>