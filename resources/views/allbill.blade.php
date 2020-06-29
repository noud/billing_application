@extends('layouts.base')
@section('content')
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery1.9.1.min.js')}}"></script>
<script src="{{ asset('js/datatable.min.js')}}"></script>
<style>
    .top{
        margin-bottom: 10px;
    }
</style>
<div class="card top">
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
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped text-center table-sm" id="bill_table">
            <thead>
              <tr>
                <th scope="col">S.No</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Area</th>
                <th scope="col">Bill Date</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $i =0;?>
                @foreach ($bill as $item)
                <?php $i++?>
              <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$item->Customer_name}}</td>
              <td>{{$item->Area}}</td>
              <td>{{$item->Date}}</td>
              <td>{{$item->Amount}}</td>
              <td>
                  <a href="{{ url('/edit/bill',$item->Invoice_ID) }}">
                  <button type="button" data-id="{{$item->Invoice_ID}}" class="btn btn-warning btn-sm"><box-icon name='printer' ></box-icon></button>
                </a>
                  <button type="button" data-id="{{$item->Invoice_ID}}" class="btn btn-danger btn-sm"><box-icon name='trash' ></box-icon></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
  <script>
       $(document).ready( function () {
    $('#bill_table').DataTable();
} );
  </script>
@endsection
