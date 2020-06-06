@extends('layouts.base')
@section('content')
<script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>
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
              <a class="nav-link active" href="#">Detergent Cakes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Washing Powder</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#">Disabled</a>
            </li>
          </ul>
    </div>
</div>
<div class="alert alert-success" style="display: none" role="alert" id="msg">
    A simple success alert—check it out!
  </div>
<div class="stock-table">
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="form-group">
                <input type="text" class="form-control" id="search" placeholder="Product Name">
              </div>
              <div>
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target=".product_add_modal">Add Product</button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th scope="col">S.no</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Tax</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $i = 0;$j="Available"; ?>

                @foreach ($products as $item)
                <?php $i++ ?>
              <tr>
              <td>{{$i}}</td>
              <td>{{$item->product_name}}</td>
              <td>{{$item->category}}</td>
              <td>{{$item->price}}</td>
              <td>{{$item->tax}}</td>
              <td>{{$item->quantity}}</td>
              @if ($item->status == $j)
              <td style="color: green">{{$item->status}}</td>
              @else
              <td style="color: orangered">{{$item->status}}</td>
              @endif
              <td>
                <button type="button" data-id="{{$item->ID}}"  data-toggle="modal" data-target=".edit_modal" class="btn btn-info btn-sm Edit_product"><box-icon name='pencil'></box-icon></button>
                <button type="button" data-id="{{$item->ID}}" class="btn btn-danger btn-sm delete_product"><box-icon name='trash' ></box-icon></button>
              </td>
              </tr>

              {{-- Edit PRoduct Modal --}}
              <div class="modal fade edit_modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form >
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" id="Edit_Product_name" placeholder="Product Name" required>
                              </div>
                              <div class="col">
                                <select class="form-control" id="Edit_Product_category" aria-placeholder="Category" required>
                                    <option value="">Select</option>
                                    <option value="Detergent Cake">Detergent Cake</option>
                                    <option value="Washing Powder">washing Powder</option>
                                  </select>
                              </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" id="Edit_Product_price" placeholder="Price" required>
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" id="Edit_Product_tax" placeholder="Tax" required>
                                </div>
                              </div>
                              <br>
                              <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" id="Edit_Product_quantity" placeholder="Quantity" required>
                                </div>
                                <div class="col">
                                    <select class="form-control" id="Edit_Product_status" aria-placeholder="Status" required>
                                        <option value="">Select</option>
                                        <option value="Available">Available</option>
                                        <option value="Out of Stock">Out of Stock</option>
                                      </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="Product_update" >Update</button>
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
{{--Add Product Modal --}}
<div class="modal fade product_add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form onsubmit="return validateForm()">
                <div class="form-row">
                  <div class="col">
                    <input type="text" class="form-control" id="Product_name" placeholder="Product Name" required>
                  </div>
                  <div class="col">
                    <select class="form-control" id="Product_category" aria-placeholder="Category" required>
                        <option value="">Select</option>
                        <option value="Detergent Cake">Detergent Cake</option>
                        <option value="Washing Powder">washing Powder</option>
                      </select>
                  </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                      <input type="text" class="form-control" id="Product_price" placeholder="Price" required>
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" id="Product_tax" placeholder="Tax" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-row">
                    <div class="col">
                      <input type="text" class="form-control" id="Product_quantity" placeholder="Quantity" required>
                    </div>
                    <div class="col">
                        <select class="form-control" id="Product_status" aria-placeholder="Status" required>
                            <option value="">Select</option>
                            <option value="Available">Available</option>
                            <option value="Out of Stock">Out of Stock</option>
                          </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="Product_add" >Add</button>
                  </div>
              </form>
          </div>

      </div>
    </div>
  </div>

  <script>


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// Add Product
        $('#Product_add').click(function()
       {
        var product_name = $('#Product_name').val();
        var category = $('#Product_category').val();
        var price = $('#Product_price').val();
        var tax = $('#Product_tax').val();
        var quantity = $('#Product_quantity').val();
        var status = $('#Product_status').val();
        $.ajax({
            method:"POST",
            url:"{{URL::to('/add/product')}}",
            data:{'product_name' : product_name,'category':category,'price':price,'tax':tax,'quantity':quantity,'status':status},
            success:function(res)
            {
                swal("Success!", "New Product Added!", "success").then(function(){
                                        location.reload();
                    }
                    );
            },
            error:function(res)
            {

            }
        })

    });

    // Edit Product

    $('.Edit_product').click(function()
{

var id = $(this).attr('data-id');

$.ajax({
method:"GET",
url:"{{URL::to('product/edit')}}",
data:{'id':id},
success:function(res)
{
  console.log(res)
$('#Edit_Product_name').val(res[0].product_name);
$('#Edit_Product_category').val(res[0].category);
$('#Edit_Product_price').val(res[0].price);
$('#Edit_Product_tax').val(res[0].tax);
$('#Edit_Product_quantity').val(res[0].quantity);
$('#Edit_Product_status').val(res[0].status);
$('#Product_update').attr('data-id',res[0].ID);
$('#editModal').modal('show');
},
error:function(res)
{

}
})

});

// Update Product


$('#Product_update').click(function()
{
var id = $(this).attr('data-id');
var edited_name = $('#Edit_Product_name').val();
var edited_category = $('#Edit_Product_category').val();
var edited_price = $('#Edit_Product_price').val();
var edited_tax = $('#Edit_Product_tax').val();
var edited_quantity = $('#Edit_Product_quantity').val();
var edited_status = $('#Edit_Product_status').val();
$.ajax({
method:"POST",
url:"{{URL::to('product/update')}}",
data:{'id':id,'name':edited_name,'category':edited_category,'price':edited_price,'tax':edited_tax,'quantity':edited_quantity,'status':edited_status},
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

// Delete Product

$('.delete_product').click(function()
{

var id = $(this).attr('data-id');

var check = confirm('Are you Sure Want to Delete ? ');
if(check == true)
{
$.ajax({
method:"POST",
url:"{{URL::to('product/delete')}}",
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

