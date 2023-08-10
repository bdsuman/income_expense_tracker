<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" id="incomeUpdateDate">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Type of Income *</label>
                                <select name="type" id="incomeUpdateType" class="form-control">
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
                                <input type="text" class="form-control" id="incomeUpdateAmount">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Description </label>
                                <textarea type="text" class="form-control" id="incomeUpdateDescription"></textarea>
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
        let res=await axios.post("/income-by-id",{id:id})
        hideLoader();
        document.getElementById('incomeUpdateDate').value=res.data['date'];
        document.getElementById('incomeUpdateType').value=res.data['categorie_id'];
        document.getElementById('incomeUpdateAmount').value=res.data['amount'];
        document.getElementById('incomeUpdateDescription').value=res.data['description']??'';
    }

    async function Update() {

        let incomeUpdateDate = document.getElementById('incomeUpdateDate').value;
        let incomeUpdateType = document.getElementById('incomeUpdateType').value;
        let incomeUpdateAmount = document.getElementById('incomeUpdateAmount').value;
        let incomeUpdateDescription = document.getElementById('incomeUpdateDescription').value;
        let updateID = document.getElementById('updateID').value;
        //alert(isNaN(parseFloat(incomeAmount)))
        if (incomeUpdateDate.length === 0) {
            errorToast("Date Required !")
        }else if (incomeUpdateType.length === 0) {
            errorToast("Income Type Required !")
        }else if (incomeUpdateAmount.length === 0 || isNaN(parseFloat(incomeUpdateAmount))) {
            errorToast("Income Amount Required !")
        }
        else{
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post("/update-income",{id:updateID,date:incomeUpdateDate,amount:incomeUpdateAmount,description:incomeUpdateDescription,categorie_id:incomeUpdateType})
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
