@extends('layouts.base')

@section('content')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
              <a class="nav-link" href="#">View Bill</a>
            </li>
          </ul>
    </div>
</div>
<div class="card">
    <div class="card-header">
      <h4>Customer Deatails</h4>
      <div class="row">
          <div class="col-6 d-flex">
            <div class="col-1">
                <label for="" class="col-form-label">Name</label>
              </div>
              <div class="col">
                  <input type="text" class="form-control" placeholder="Customer Name">
              </div>
          </div>
          <div class="col-6 d-flex justify-content-between">
              <div class="col d-flex align-items-center justify-content-between">
                <label for="" style="width: 10vh;">Date</label>
                  <input type="date" class="form-control" name="data" id="">
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
                <label for="" class="col-form-label">Area</label>
              </div>
              <div class="col">
                  <input type="text" class="form-control" placeholder="Area">
              </div>
          </div>
          <div class="col-6 d-flex">
            <div class="col-1">
                <label for="" class="col-form-label">Contact</label>
              </div>
              <div class="col">
                  <input type="text" class="form-control" placeholder="Contact">
              </div>
          </div>
      </div>
      <br>
      <div class="row">
        <div class="col-6 d-flex justify-content-between">
            <div class="col d-flex align-items-center justify-content-between">
              <label for="" style="width: 10vh;">Date</label>
                <input type="date" class="form-control" name="data" id="">
            </div>
            <div class="col d-flex justify-content-center">
                <label for="" style="width: 23vh;">Invoice Number</label>
                <input type="text" class="form-control" name="invoice_number">
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
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Tax</th>
                <th scope="col">Rate</th>
                <th scope="col"><button type="button" class="btn btn-primary btn-sm" id="add"><box-icon name='plus' ></box-icon></button></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><input type="text" class="form-control"></td>
                <td><input type="text" class="form-control"></td>
                <td><input type="text" class="form-control"></td>
                <td><input type="text" class="form-control"></td>
                <td><input type="text" class="form-control"></td>
                <td><button type="button" class="btn btn-warning btn-sm" onclick="deleteRow(this)"><box-icon name='trash-alt'></box-icon></button></td>
              </tr>

            </tbody>
          </table>
    </div>
  </div>

  <script>
$("#add").click(function () {
     $("#bill_table").each(function () {
         var tds = '<tr>';
         jQuery.each($('tr:last td', this), function () {
             tds += '<td>' + $(this).html() + '</td>';
         });
         tds += '</tr>';
         if ($('tbody', this).length > 0) {
             $('tbody', this).append(tds);
         } else {
             $(this).append(tds);
         }
     });
});

function deleteRow(btn){
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
  }
  </script>
@endsection
