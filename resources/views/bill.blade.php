@extends('layouts.base')

@section('content')
 {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> --}}
<script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>

<style>
    .col label{
        margin-bottom: 0 !important;
    }
    .top{
        margin-bottom: 10px;
    }
    h4{
        margin-bottom: 15px;
    }

</style>
<div class="card top">
    <div class="card-body">
        <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" href="#">New Bill</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/allbill">View Bill</a>
            </li>
          </ul>
    </div>
</div>
<div class="card">
    <form id="invoice_form">
    <div class="card-header">
      <h4>Customer Deatails</h4>
      <div class="row">
        <div class="col-6 d-flex">
            <div class="col-1">
                <label for="" class="col-form-label">Area</label>
              </div>
              <div class="col">
                  <select name="area" id="Customer_area" class="form-control">
                      <option value="">Select Area</option>
                      @foreach ($area as $item)
                  <option value="{{$item->Area_name}}">{{$item->Area_name}}</option>
                      @endforeach
                  </select>
                  {{-- <input type="text" name="area" class="form-control" id="Customer_area" placeholder="Area"> --}}
              </div>
          </div>

          <div class="col-6 d-flex justify-content-between">
              <div class="col d-flex align-items-center justify-content-between">
                <label for="" style="width: 10vh;">Date</label>
                  <input type="date" class="form-control" name="date" id="date">
              </div>
              <div class="col d-flex justify-content-center">
                  <label for="" style="width: 23vh;">Invoice Number</label>
                  <input type="text" class="form-control" name="invoice_number">
              </div>
          </div>
      </div>
      <br>
      <div class="row">
        <div class="col-6 d-flex">
            <div class="col-1">
                <label for="" class="col-form-label">Name</label>
              </div>
              <div class="col">
                  <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Customer Name">
              </div>
          </div>
          <div class="col-6 d-flex justify-content-between">
            <div class="col d-flex align-items-center justify-content-between">
              <label for="" style="width: 10vh;">State</label>
                <input type="text" class="form-control" name="data" id="">
            </div>
            <div class="col d-flex justify-content-center">
                <label for="" style="width: 10vh;">District</label>
                <input type="text" class="form-control" name="invoice_number">
            </div>
        </div>

      </div>
      <br>
      <div class="row">
        <div class="col-6 d-flex">
            <div class="col-1">
                <label for="" class="col-form-label">Contact</label>
              </div>
              <div class="col">
                  <input type="text" name="contact" class="form-control" placeholder="Contact">
              </div>
          </div>
        <div class="col-6 d-flex">
          <div class="col-1">
              <label for="" class="col-form-label">Type</label>
            </div>
            <div class="col">
                <input type="text" class="form-control" value="Cash" placeholder="Contact">
            </div>
        </div>
    </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered text-center" id="bill_table">
            <thead>
              <tr>
                <th scope="col">S.no</th>
                <th scope="col" style="width: 20%">Product Name</th>
                <th scope="col">Available</th>
                <th scope="col">Rate</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit</th>
                <th scope="col">Tax(%)</th>
                <th scope="col">Tax Amount</th>
                <th scope="col">Amount</th>
                <th scope="col"><button type="button" class="btn btn-primary btn-sm" id="add"><box-icon name='plus' ></box-icon></button></th>
              </tr>
            </thead>
            <tbody class="detail" id="invoice_item">
              <tr class="tr_input">
                <td class="align-middle"><b>1</b></td>
                <td style="width: 20%"><select name="product[]" id="select_product" class="form-control select_product">
                    <option value="">Select Product</option>
                    @foreach ($products as $item)
                <option  value="{{$item->product_name}}">{{$item->product_name}}</option>
                    @endforeach
                    </select></td>
                <td><input type="text" name="available_qty[]" class="form-control avail" value="" readonly></td>
                <td><input type="text" name="price[]" class="form-control Price" value="" readonly></td>
                <td><input type="number" name="qty[]" class="form-control qty" value="" onclick="updatetax()"></td>
                <td><input type="text" name="unit[]" class="form-control unit" value=""></td>
                <td><input type="text" name="tax[]" class="form-control tax" value="" readonly></td>
                <td><input type="text" name="tax_amount[]" class="form-control tax_amount" value="" readonly></td>
                <td><input type="text" name="item_total[]" class="form-control rate" value="" readonly></td>
                <td><button type="button" class="btn btn-warning btn-sm" onclick="deleteRow(this)"><box-icon name='trash-alt'></box-icon></button></td>
                <input type="hidden" name="tax_hamount[]" class="tax_hamount" value="">
              </tr>
            </tbody>
          </table>
          <div class="form-group row">
            <div class="col-9 d-flex justify-content-end">
          <label for="sub_total" class="form-label">Tax</label>
          </div>
          <div class="col-3">
            <input type="text" readonly name="tax_total" value="" class="form-control tax_total" id="tax_total"/>
          </div>
          <div></div>
        </div>
          <div class="form-group row">
              <div class="col-9 d-flex justify-content-end">
            <label for="sub_total" class="form-label">Total</label>
            </div>
            <div class="col-3">
              <input type="text" readonly name="sub_total" value="" class="form-control grand_total" id="grand_total"/>
            </div>
            <div></div>
          </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-success" id="order">Order</button>
    </div>
</form>
  </div>

  <script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// fetch product details according to their name
      $('#invoice_item').delegate(".select_product","change",function(){
           var product_id = $(this).val();
           var tr =$(this).parent().parent();
           $.ajax({
                url:"{{ URL::to('product/find') }}",
                method:"POST",
                data:{product_id:product_id},
                success:function(res){
                    tr.find('.avail').val(res[0].quantity);
                    tr.find('.Price').val(res[0].price);
                    tr.find('.qty').val(0);
                    tr.find('.tax').val(res[0].tax);
                    tr.find('.unit').val(res[0].unit);
                    tr.find('.tax_amount').val(res[0].tax_amount);
                    tr.find('.tax_hamount').val(res[0].tax_amount);
                    // tr.find('.rate').val( tr.find('.qty').val() * tr.find('.price').val() );
                }
           });
      });

//AMount and tax Calculations

    calculateTotal();

    $('#invoice_item').delegate(".qty","change",function() {
        updateTotals(this);
        calculateTotal();
    });

  function updateTotals(elem) {
        var tr = $(elem).closest('tr'),
            quantity = $('[name="qty[]"]', tr).val(),
          price = $('[name="price[]"]', tr).val(),
          tax = $('[name="tax_hamount[]"]', tr).val(),
          subtotal = parseInt(quantity) * parseFloat(price);
          tax_amount = parseInt(quantity)* parseFloat(tax);
      $('.rate', tr).val(parseFloat(subtotal).toFixed(2));
      $('.tax_amount', tr).val(parseFloat(tax_amount).toFixed(2));

  }

  function calculateTotal(){

      var grandTotal = 0.0;
      var grandtax = 0.0;
      var totalQuantity = 0;
      $('.rate').each(function(){
          grandTotal += parseFloat($(this).val()) ;
      });
      $('.tax_amount').each(function(){
          grandtax += parseFloat($(this).val()) ;
      });

      $('.grand_total').val(parseFloat(grandTotal ).toFixed(2) );
      $('.tax_total').val(parseFloat(grandtax ).toFixed(2) );
  }

// Delete row
function deleteRow(btn){
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    calculateTotal();
  }

  //add row
  function addnewrow() {

        // Get last id
    var n=($('.detail tr').length-1)+2;
    var tr='<tr class="tr_input">'+
    '<th scope="row" class="num">'+n+'</th>'+
      '<td style="width: 20%"><select name="product[]" id="select_product" class="form-control select_product"><option value="">Select</option>@foreach ($products as $item)<option data-id="{{$item->ID}}" value="{{$item->product_name}}">{{$item->product_name}}</option>@endforeach</select></td>'+
      '<td><input type="text" name="available_qty[]" class="form-control avail" readonly></td>'+
      ' <td><input type="text" name="price[]" class="form-control Price" readonly></td>'+
      '<td><input type="number" name="qty[]" class="form-control qty"></td>'+
      '<td><input type="text" name="unit[]" class="form-control unit"></td>'+
      ' <td><input type="text" name="tax[]" class="form-control tax" readonly></td>'+
      ' <td><input type="text" name="tax_amount[]" class="form-control tax_amount" readonly></td>'+
      '<td><input type="text"  name="item_total[]" class="form-control rate" readonly></td>'+
      '<td><button type="button" class="btn btn-warning btn-sm" onclick="deleteRow(this)"><box-icon name="trash-alt"></box-icon></button></td>'+
      '<input type="hidden" name="tax_hamount[]" class="tax_hamount" value="">'+
    '</tr>';
    $('.detail').append(tr);
  }
  $(function()
  {

    $('#add').click(function()
    {
      addnewrow();
    });

  });


  // Order
  $('#order').click(function(event)
       {
var invoice_details = $('#invoice_form').serialize();
console.log(invoice_details);
        $.ajax({
            method:"GET",
            url:"{{URL::to('/add/invoice')}}",
            data:$('#invoice_form').serialize(),
            contentType: "application/jsons",
            processData: false,
            success:function(res)
            {
                swal("Success!", "New Bill Added!", "success").then(function(){
                                        location.reload();
                    }
                    );
            },
            error:function(res)
            {

            }
        })

    });

  </script>
@endsection
