<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <form action="{{ url('/reportPage') }}" >
                <div class="row">
                    <div class="col-4 p-1">
                        <label class="form-label">From Date</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate">
                    </div>
                    <div class="col-4 p-1">
                        <label class="form-label">To Date</label>
                        <input type="date" class="form-control" id="toDate" name="toDate">
                    </div>
                    <div class="col-4 p-1">
                        <label class="form-label">Type of Income /Expense </label>
                        <select name="type" id="type" class="form-control">
                            <option value="">--select--</option>
                            @forelse ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->type }} - {{ $categorie->name }}</option>
                            @empty
                                <option value="Income">No Category Found!</option>
                            @endforelse
                            
                        </select>
                    </div>
                    
                    <div class="col-12 p-1 mt-2">
                        <div class="align-items-center col float-center" align="center">
                            <button type="submit" class="btn m-0 btn-sm bg-gradient-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h6>Income / Expense Calculation</h6>
                </div>
                <div class="align-items-center col">
                    <button onclick="printPage('print');" class="float-end btn m-0 btn-sm bg-gradient-success">Print</button>
                </div>
            </div>
           
            <hr class="bg-secondary"/>
            <div id="print" class="table-responsive" width="100%">
                @if($status)
                <div class="align-items-center col">
                    <h6>{{ $status }}</h6>
                </div>
                @endif
                <table class="table  table-flush">
                    <thead>
                    <tr class="bg-light">
                        <th>Income</th>
                        <th>Expense</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table class="table  table-flush">
                                    <thead>
                                    <tr class="bg-light">
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalIncome = 0;
                                        @endphp
                                        @forelse ($incomes as $key=>$income )
                                            @php
                                                $totalIncome+=$income->amount;
                                            @endphp
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ date('d M, Y',strtotime($income->date)) }}</td>
                                                <td>{{ $income->category->name }}</td>
                                                <td align="right">{{ number_format($income->amount,2) }}</td>
                                            </tr>
                                                 
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <h3>No Income Found</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-dark" align="right" style="font-weight: bold; color:white;" >
                                            <td colspan="3" >Tolal</td>
                                            <td>{{ number_format($totalIncome,2)  }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </td>
                            <td>
                                <table class="table  table-flush">
                                    <thead>
                                    <tr class="bg-light">
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalExpense = 0;
                                        @endphp
                                        @forelse ($expenses as $key=>$expense )
                                            @php
                                                $totalExpense+=$expense->amount;
                                            @endphp
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ date('d M, Y',strtotime($expense->date)) }}</td>
                                                <td>{{ $expense->category->name }}</td>
                                                <td align="right">{{ number_format($expense->amount,2) }}</td>
                                            </tr>
                                                 
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <h3>No Expense Found</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-dark" align="right" style="font-weight: bold; color:white;" >
                                            <td colspan="3" >Tolal</td>
                                            <td>{{ number_format($totalExpense,2)  }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                    @php
                        $restMoney = 0;
                        $restMoney = $totalIncome-$totalExpense;
                    @endphp
                    <tfoot>
                        <tr class="bg-dark"  style="font-weight: bold; color:white;">
                            <td align="right">
                                Net Income
                            </td>
                            <td>
                                {{ number_format($restMoney,2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<script>
	function printPage(id)
	{
		
	   var html="<html>";
		   html+= document.getElementById(id).innerHTML;
		   html+="</html>";

	   var printWin = window.open();
	   printWin.document.write(html);
	   printWin.document.close();
	   printWin.focus();
	   printWin.print();
	   printWin.close();
	}
</script>
