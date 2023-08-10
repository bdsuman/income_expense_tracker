<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Income</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" id="incomeDate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Type of Income *</label>
                                <select name="type" id="incomeType" class="form-control">
                                    <option value="">--select--</option>
                                    @forelse ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @empty
                                        <option value="Income">No Category Found!</option>
                                    @endforelse
                                    
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Amount *</label>
                                <input type="text" class="form-control" id="incomeAmount">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Description </label>
                                <textarea type="text" class="form-control" id="incomeDescription"></textarea>
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

        let incomeDate = document.getElementById('incomeDate').value;
        let incomeType = document.getElementById('incomeType').value;
        let incomeAmount = document.getElementById('incomeAmount').value;
        let incomeDescription = document.getElementById('incomeDescription').value;
        //alert(isNaN(parseFloat(incomeAmount)))
        if (incomeDate.length === 0) {
            errorToast("Date Required !")
        }else if (incomeType.length === 0) {
            errorToast("Income Type Required !")
        }else if (incomeAmount.length === 0 || isNaN(parseFloat(incomeAmount))) {
            errorToast("Income Amount Required !")
        }
        else {

            document.getElementById('modal-close').click();

            showLoader();
            let res = await axios.post("/create-income",{date:incomeDate,amount:incomeAmount,description:incomeDescription,categorie_id:incomeType})
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
