@extends('layouts.base')
@section('content')
<script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>
<style>

</style>
<div class="card">
    <div class="card-body">
        <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" href="/customer">Customers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Area</a>
            </li>
          </ul>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-end align-items-center">
            <div>
              <button type="button" class="btn btn-primary"  data-toggle="modal" data-target=".area_add_modal">Add Area</button>
          </div>
      </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th scope="col">S.No</th>
                <th scope="col">Area Name</th>
                <th scope="col">Number of Shops</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $i=0;?>
                @foreach ($area as $item)
                <?php $i++;?>
              <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$item->area_name}}</td>
                <td>Otto</td>
                <td>
                    <button type="button" data-id="{{$item->area_id}}"  data-toggle="modal" data-target=".edit_modal" class="btn btn-info btn-sm Edit_area"><box-icon name='pencil'></box-icon></button>
                <button type="button" data-id="{{$item->area_id}}" class="btn btn-danger btn-sm delete_area"><box-icon name='trash' ></box-icon></button>
                </td>
              </tr>
 
                {{-- Edit Area Modal --}}
                <div class="modal fade edit_modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Area</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form >
                              <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" id="Edit_Area_name" placeholder="Area Name" required>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" id="Area_update" >Update</button>
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
    <div class="modal fade area_add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Add New Area</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Area Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="area_name">
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="area_add">Add</button>
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
// Add Product
        $('#area_add').click(function()
       {
        var area_name = $('#area_name').val();

        $.ajax({
            method:"POST",
            url:"{{URL::to('/add/area')}}",
            data:{'area_name' : area_name},
            success:function(res)
            {
                swal("Success!", "New area Added!", "success").then(function(){
                                        location.reload();
                    }
                    );
            },
            error:function(res)
            {

            }
        })

    });

  // Edit Area

  $('.Edit_area').click(function() {
    var id = $(this).attr('data-id');
    $.ajax({
      method:"GET",
      url:"{{URL::to('area/edit')}}",
      data:{'id':id},
      success:function(res) {
        console.log(res)
        $('#Edit_Area_name').val(res[0].area_name);
        $('#Area_update').attr('data-id',res[0].area_id);
        $('#editModal').modal('show');
      },
      error:function(res) {}
    })
  });

  // Update Area

  $('#Area_update').click(function() {
    var id = $(this).attr('data-id');
    var edited_name = $('#Edit_Area_name').val();
        console.log('id>>',id,edited_name)
    $.ajax({
      method:"POST",
      url:"{{URL::to('area/update')}}",
      data:{'id':id,'name':edited_name},
      success:function(res) {
          swal("Success!", "Updated Successfully!", "success").then(function(){
            location.reload();
          }
        );
      },
      error:function(res){}
    })
  });

  // Delete Area

  $('.delete_area').click(function() {
    var id = $(this).attr('data-id');
    var check = confirm('Are you Sure Want to Delete ? ');
    if(check == true) {
      $.ajax({
        method:"POST",
        url:"{{URL::to('area/delete')}}",
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
