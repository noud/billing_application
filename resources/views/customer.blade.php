@extends('layouts.base')

@section('content')
<style>
    .form-group{
        margin-bottom: 0;
    }
    .stock-table{
        margin-top: 10px;
    }
    li a{
        color: black;
        font-weight:700;
    }
</style>
<div class="card">
    <div class="card-body">
        <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" href="#">Customers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Area</a>
            </li>
          </ul>
    </div>
</div>
<div class="stock-table">
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="form-group">
                <input type="text" class="form-control" id="search" placeholder="Product Name">
              </div>
              <div>
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target=".customer_add_modal">Add Customer</button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">S.no</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Area</th>
                <th scope="col">Pending Amount</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>

              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
                <td>@fat</td>

              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry the Bird</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>
                <td>@twitter</td>

              </tr>
            </tbody>
          </table>
    </div>
  </div>
</div>
{{-- Modal --}}
<div class="modal fade customer_add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
                <div class="form-row">
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Customer Name">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Mobile Number">
                  </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Area">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" placeholder="Pending Amount">
                    </div>
                  </div>
                  <br>

              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
      </div>
    </div>
  </div>
@endsection
