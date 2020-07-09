@extends('layouts.base')
@section('content')
<script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>
<div class="card">
    <div class="card-header">
      @if($company['company_name'])
        Update Company
      @else
        Create New Company
      @endif
    </div>
    <div class="card-body">
<form  id="company_form">
    <div class="form-row">
              <div class="form-group col-md-6">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control" id="company_name" value="{{ $company['company_name'] }}">
              </div>
              <div class="col">
                <label>GSTIN Number</label>
                <input type="text" name="tin" class="form-control" id="tin" value="{{ $company['tin'] }}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" value="{{ $company['address'] }}">
            </div>
            <div class="row form-group">
                <div class="col">
                    <label>Mobile Number 1</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $company['phone'] }}">
                </div>
                <div class="col">
                    <label>Mobile Number 2</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $company['mobile'] }}">
                </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ $company['city'] }}">
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" name="state" id="state" value="{{ $company['state'] }}">
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">PIN code</label>
                <input type="text" class="form-control" name="pin" id="pin" value="{{ $company['pin'] }}">
              </div>
            </div>
            <button type="button" class="btn btn-primary" id="add_company" >Update</button>
        </form>

    </div>
  </div>

  <script>
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Add Company
$('#add_company').click(function()
       {
        // var company_name = $('#company_name').val();
        //    var company = $('#company_form').serialize();
        //    console.log(company);
        $.ajax({
            method:"GET",
            url:"{{URL::to('/add/company')}}",
            data:$('#company_form').serialize(),
            contentType: "application/jsons",
            success:function(res)
            {
                swal("Success!", "New Company Added!", "success").then(function(){
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
