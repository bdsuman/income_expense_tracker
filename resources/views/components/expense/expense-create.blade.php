<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Expense</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" id="expenseDate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Type of Expense *</label>
                                <select name="type" id="expenseType" class="form-control">
                                    <option value="">--select--</option>
                                    @forelse ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @empty
                                        <option value="">No Category Found!</option>
                                    @endforelse
                                    
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Amount *</label>
                                <input type="text" class="form-control" id="expenseAmount">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Description </label>
                                <textarea type="text" class="form-control" id="expenseDescription"></textarea>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    async function Save() {

        let expenseDate = document.getElementById('expenseDate').value;
        let expenseType = document.getElementById('expenseType').value;
        let expenseAmount = document.getElementById('expenseAmount').value;
        let expenseDescription = document.getElementById('expenseDescription').value;
        //alert(isNaN(parseFloat(expenseAmount)))
        if (expenseDate.length === 0) {
            errorToast("Date Required !")
        }else if (expenseType.length === 0) {
            errorToast("Expense Type Required !")
        }else if (expenseAmount.length === 0 || isNaN(parseFloat(expenseAmount))) {
            errorToast("Expense Amount Required !")
        }
        else {

            document.getElementById('modal-close').click();

            showLoader();
            let res = await axios.post("/create-expense",{date:expenseDate,amount:expenseAmount,description:expenseDescription,categorie_id:expenseType})
            hideLoader();

            if(res.status===201){

                successToast('Request completed');

                document.getElementById("save-form").reset();

                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }

</script>
