@extends('layouts.base')

@section('content')
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>
<script src="{{ asset('js/datatable.min.js')}}"></script>
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
              <a class="nav-link" href="/area">Area</a>
            </li>
          </ul>
    </div>
</div>
<div class="stock-table">
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-end align-items-center">
            <div>
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target=".customer_add_modal">Add Customer</button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered text-center" id="customer_table">
            <thead>
              <tr>
                <th scope="col">S.no</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Area</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $i=0;?>
                @foreach ($customers as $item)
<?php $i++?>

              <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$item->name}}</td>
              <td>{{$item->contact}}</td>
              <td>{{$item->area}}</td>
                <td>
                    <button type="button" data-id="{{$item->ID}}"  data-toggle="modal" data-target=".edit_modal" class="btn btn-info btn-sm Edit_customer"><box-icon name='pencil'></box-icon></button>
                <button type="button" data-id="{{$item->ID}}" class="btn btn-danger btn-sm delete_customer"><box-icon name='trash' ></box-icon></button>
                </td>
              </tr>

               {{-- Edit PRoduct Modal --}}
               <div class="modal fade edit_modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form >
                            <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" id="Edit_customer_name" placeholder="Customer Name">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" id="Edit_customer_contact" placeholder="Mobile Number">
                                </div>
                              </div>
                              <br>
                              <div class="form-row">
                                  <div class="col-6">
                                    <input type="text" class="form-control" id="Edit_customer_area" placeholder="Area">
                                  </div>
                                  {{-- <div class="col">
                                    <input type="text" class="form-control" placeholder="Pending Amount">
                                  </div> --}}
                                </div>
                              <br>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="customer_update" >Update</button>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
              </div>
              @endforeach
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
                    <input type="text" class="form-control" id="Customer_name" placeholder="Customer Name">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" id="Customer_number" placeholder="Mobile Number">
                  </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-6">
                        <select name="" id="Customer_area" class="form-control">
                            <option value="">Select Area</option>
                            @foreach ($area as $item)
                        <option value="{{$item->area_name}}">{{$item->area_name}}</option>
                            @endforeach
                        </select>
                      {{-- <input type="text" class="form-control" id="Customer_area" placeholder="Area"> --}}
                    </div>
                    {{-- <div class="col">
                      <input type="text" class="form-control" placeholder="Pending Amount">
                    </div> --}}
                  </div>
                  <br>

              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="Add_customer">Add</button>
          </div>
      </div>
    </div>
  </div>

  <script>
$(document).ready( function () {
    $('#customer_table').DataTable();
} );


      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// Add customer
        $('#Add_customer').click(function()
       {
        var customer_name = $('#Customer_name').val();
        var contact = $('#Customer_number').val();
        var area = $('#Customer_area').val();

        $.ajax({
            method:"POST",
            url:"{{URL::to('/add/customer')}}",
            data:{'customer_name' : customer_name,'contact':contact,'area':area},
            success:function(res)
            {
                swal("Success!", "New Customer Added!", "success").then(function(){
                                        location.reload();
                    }
                    );
            },
            error:function(res)
            {

            }
        })

    });
// Edit CUstomer
    $('.Edit_customer').click(function()
{

var id = $(this).attr('data-id');

$.ajax({
method:"GET",
url:"{{URL::to('customer/edit')}}",
data:{'id':id},
success:function(res)
{
  console.log(res)
$('#Edit_customer_name').val(res[0].name);
$('#Edit_customer_contact').val(res[0].contact);
$('#Edit_customer_area').val(res[0].area);

$('#customer_update').attr('data-id',res[0].ID);
$('#editModal').modal('show');
},
error:function(res)
{

}
})

});

// Customer Update
$('#customer_update').click(function()
{
var id = $(this).attr('data-id');
var edited_name = $('#Edit_customer_name').val();
var edited_contact = $('#Edit_customer_contact').val();
var edited_area = $('#Edit_customer_area').val();
$.ajax({
method:"POST",
url:"{{URL::to('customer/update')}}",
data:{'id':id,'name':edited_name,'contact':edited_contact,'area':edited_area},
success:function(res)
{
    swal("Success!", "Updated Successfully!", "success").then(function(){
                                        location.reload();
                    }
                    );
},
error:function(res)
{

}
})
});

// Delete Customer
$('.delete_customer').click(function()
{

var id = $(this).attr('data-id');

var check = confirm('Are you Sure Want to Delete ? ');
if(check == true)
{
$.ajax({
method:"POST",
url:"{{URL::to('customer/delete')}}",
data:{'id':id},
success:function(res)
{
// alert(res);
alert('Deleted Succefully');
location.reload();

}
})
}
});
  </script>
@endsection
