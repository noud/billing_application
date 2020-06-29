@extends('layouts.base')
@section('content')

<script src="{{ url('js/jquery1.9.1.min.js')}}"></script>

<style>
    .bill{
        font-family: "Courier New", Courier, monospace;
    }
    .top{
        margin-bottom: 10px;
    }
    table.bill_table {
  font-family: "Courier New", Courier, monospace;
  background-color: #FFFFFF;
  border: 1px solid #1C6EA4;
  width: 100%;
  /* text-align: center; */
}
table.bill_table td, table.bill_table th {
  border: 1px solid #AAAAAA;
  padding: 8px 0px;
}
table.bill_table tbody td {
  font-size: 13px;
}
table.bill_table thead {
    border-bottom: 2px solid #444444;
}
table.bill_table thead th {
  font-size: 15px;
  font-weight: bold;
  color: #000000;
  border-left: 0px solid #D0E4F5;
}
table.bill_table thead th:first-child {
  border-left: none;
}

table.bill_table tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.bill_table tfoot td {
  font-size: 14px;
}
table.bill_table tfoot .links {
  text-align: right;
}
table.bill_table tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
.sub_total{
  float: right;
  margin-right: 50px;
    font-size: 20px;
}
.tax_total{
    font-size: 20px;
    margin-right: 60px;
}
.col-4 div{
  font-size: 18px;
  margin-top: 20px;
}
.col-4 span{
padding-right: 20px;
}
td{
    font-size: 18px;
}
table span{
    font-size: 18px;
    margin-left: 20px;
    margin-right: 20px;
}
.tex{
    display: flex;
    flex-direction: row-reverse;
    margin-right: 45px;
}
p{
    font-size: 20px;
}

</style>
<div class="card top d-print-none">
    <div class="card-body">
        <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" href="/bill">New Bill</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/allbill">View Bill</a>
            </li>
          </ul>
    </div>
</div>
<div class="bill">
<div class="container-fluid">
    @foreach ($company as $comp)
    <div class="d-flex flex-column align-items-center">
    <h3>{{$comp->company_name}}</h3>
    <p>{{$comp->address}},{{$comp->city}},{{$comp->state}},{{$comp->pin}}</p>
    </div>
    <div class="d-flex justify-content-between">
    <div class="d-flex flex-column">
        <span><b>Phone  :</b>  {{$comp->phone}}</span>
        <span><b>Mobile  :</b>  {{$comp->mobile}}</span>
    </div>
    <div>
    <span><b>GSTIN  :</b>{{$comp->tin}}</span>
    </div>
    </div>
    @endforeach
  @foreach ($invoice_details as $invo_detai)

    <div class="row justify-content-between">
      <div class="col-4">
        <div><span class="font-weight-bold">To  :</span>{{$invo_detai->Customer_name}}</div>
        <div><span class="font-weight-bold">Area  :</span>{{$invo_detai->Area}}</div>
        <div><span class="font-weight-bold">Mobile  :</span></div>
      </div>
      <div class="col-4">
        <div><span class="font-weight-bold">Invoice Number  :</span>{{$invo_detai->Invoice_ID}}</div>
        <div><span class="font-weight-bold">Date  :</span>{{$invo_detai->Date}}</div>
        <div><textarea name="" id="" cols="25" rows="2"></textarea></div>
      </div>
    </div>
  @endforeach
</div>
<table class="bill_table">
<thead>
<tr>
<th class="text-center"><span>S.No</span></th>
<th class="text-center"><span>Product Name</span></th>
<th class="text-center"><span>Rate</span></th>
<th class="text-center"><span>Quantity</span></th>
<th class="text-center"><span>Unit</span></th>
{{-- <th class="text-center"><span>Tax (%)</span></th> --}}
<th class="text-center"><span>Taxable Amount</span></th>
<th class="text-center"><span>Amount</span></th>
</tr>
</thead>
<tbody>
  <?php $i = 0;?>
  @foreach ($invoice_product_details as $item)
  <?php $i++?>
<tr>
<td class="text-center"><span>{{$i}}</span></td>
<td class="prod_name"><span>{{$item->Product_name}}</span></td>
<td class="text-center"><span>{{$item->price}}</span></td>
<td class="text-center"><span>{{$item->qty}}</span></td>
<td class="text-center"><span>{{$item->unit}}</span></td>
{{-- <td class="text-center"><span>{{$item->tax}}</span></td> --}}
<td class="text-center"><span>{{$item->tax_amount}}</span></td>
<td ><span class="tex">{{$item->item_total}}</span></td>
</tr>
@endforeach
</tbody>
</table>
</div>
@foreach ($invoice_details as $invo_detai)
<div class="row justify-content-end">
<div style="position: relative;padding-top: 11px;"><span style="font-size:20px;margin-top:15px">Tax :</span> <span class="sub_total">{{$invo_detai->Tax_amount}}</span></div>
<div style="position: relative;padding-top: 11px;"><span style="font-size:20px;margin-top:15px">Total :</span> <span class="tax_total">{{$invo_detai->Amount}}</span></div>
</div>
@endforeach

<button type="button" class="btn btn-success btn-lg btn-block d-print-none" onclick="window.print()">Print</button>

@endsection
