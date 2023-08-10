<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Expense</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" id="expenseUpdateDate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Type of Expense *</label>
                                <select name="type" id="expenseUpdateType" class="form-control">
                                    <option value="">--select--</option>
                                    @forelse ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @empty
                                        <option value="expense">No Category Found!</option>
                                    @endforelse
                                    
                                </select>
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Amount *</label>
                                <input type="text" class="form-control" id="expenseUpdateAmount">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Description </label>
                                <textarea type="text" class="form-control" id="expenseUpdateDescription"></textarea>
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>


   async function FillUpUpdateForm(id){
        document.getElementById('updateID').value=id;
        showLoader();
        let res=await axios.post("/expense-by-id",{id:id})
        hideLoader();
        document.getElementById('expenseUpdateDate').value=res.data['date'];
        document.getElementById('expenseUpdateType').value=res.data['categorie_id'];
        document.getElementById('expenseUpdateAmount').value=res.data['amount'];
        document.getElementById('expenseUpdateDescription').value=res.data['description']??'';
    }

    async function Update() {

        let expenseUpdateDate = document.getElementById('expenseUpdateDate').value;
        let expenseUpdateType = document.getElementById('expenseUpdateType').value;
        let expenseUpdateAmount = document.getElementById('expenseUpdateAmount').value;
        let expenseUpdateDescription = document.getElementById('expenseUpdateDescription').value;
        let updateID = document.getElementById('updateID').value;
        //alert(isNaN(parseFloat(expenseAmount)))
        if (expenseUpdateDate.length === 0) {
            errorToast("Date Required !")
        }else if (expenseUpdateType.length === 0) {
            errorToast("expense Type Required !")
        }else if (expenseUpdateAmount.length === 0 || isNaN(parseFloat(expenseUpdateAmount))) {
            errorToast("expense Amount Required !")
        }
        else{
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-expense",{id:updateID,date:expenseUpdateDate,amount:expenseUpdateAmount,description:expenseUpdateDescription,categorie_id:expenseUpdateType})
            hideLoader();

            if(res.status===200 && res.data===1){
                document.getElementById("update-form").reset();
                successToast("Request success !")
                await getList();
            }
            else{
                errorToast("Request fail !")
            }


        }



    }



</script>
