@extends('layouts.base')
@section('content')
<script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>
<style>

</style>
<div class="card">
    <div class="card-body">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" href="/stocks">Stocks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/category">Category</a>
        </li>
      </ul>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-end align-items-center">
            <div>
              <button type="button" class="btn btn-primary"  data-toggle="modal" data-target=".category_add_modal">Add Category</button>
          </div>
      </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th scope="col">S.No</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0;?>
              @foreach ($category as $item)
                <?php $i++;?>
                <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$item->category_name}}</td>
                  <td>
                    <button type="button" data-id="{{$item->category_id}}"  data-toggle="modal" data-target=".edit_modal" class="btn btn-info btn-sm Edit_category"><box-icon name='pencil'></box-icon></button>
                    <button type="button" data-id="{{$item->category_id}}" class="btn btn-danger btn-sm delete_category"><box-icon name='trash' ></box-icon></button>
                  </td>
                </tr>
 
                {{-- Edit Category Modal --}}
                <div class="modal fade edit_modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form >
                              <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" id="Edit_Category_name" placeholder="Category Name" required>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" id="Category_update" >Update</button>
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
    <div class="modal fade category_add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="category_name">
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="category_add">Add</button>
            </div>
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
// Add Category
        $('#category_add').click(function()
       {
        var category_name = $('#category_name').val();

        $.ajax({
            method:"POST",
            url:"{{URL::to('/add/category')}}",
            data:{'category_name' : category_name},
            success:function(res)
            {
                swal("Success!", "New category Added!", "success").then(function(){
                                        location.reload();
                    }
                    );
            },
            error:function(res)
            {

            }
        })

    });

  // Edit Category

  $('.Edit_category').click(function() {
    var id = $(this).attr('data-id');
        console.log('id>>',id)
    $.ajax({
      method:"GET",
      url:"{{URL::to('category/edit')}}",
      data:{'id':id},
      success:function(res) {
        console.log(res)
        $('#Edit_Category_name').val(res[0].category_name);
        $('#Category_update').attr('data-id',res[0].category_id);
        $('#category_add_modal').modal('show');
      },
      error:function(res) {}
    })
  });

  // Update Category

  $('#Category_update').click(function() {
    var id = $(this).attr('data-id');
    var edited_name = $('#Edit_Category_name').val();
        console.log('id>>',id,edited_name)
    $.ajax({
      method:"POST",
      url:"{{URL::to('category/update')}}",
      data:{'id':id,'name':edited_name},
      success:function(res) {
          swal("Success!", "Updated Successfully!", "success").then(function(){
            location.reload();
          }
        );
      },
      error:function(res) {}
    })
  });

  // Delete Category

  $('.delete_category').click(function() {
    var id = $(this).attr('data-id');
    var check = confirm('Are you Sure Want to Delete ? ');
    if(check == true) {
      $.ajax({
        method:"POST",
        url:"{{URL::to('category/delete')}}",
        data:{'id':id},
        success:function(res) {
          // alert(res);
          alert('Deleted Succefully');
          location.reload();
        }
      })
    }
  });
</script>
@endsection
