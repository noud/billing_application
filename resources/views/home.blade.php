@extends('layouts.base')

@section('content')
<style>
    *{
        overflow-x: hidden;

    }
</style>

<script src="{{ asset('js/chart.js')}}"></script>


<div class="row d-print-none">
    <div class="col">
        <div class="card">
            <div class="card-header">
              Product Status
            </div>
            <div class="card-body">
                <canvas id="myChart" width="400px" height="215vh"></canvas>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
              Recent Activities
            </div>
            <div class="card-body">
                <canvas id="recent_activity" width="400px" height="215vh"></canvas>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
              Closing Stocks
                </div>
                <div>
                    <button class="btn btn-dark d-print-none" style="color: whitesmoke;" onclick="window.print()">Print</button>
                </div>
            </div>
            <div class="card-body" style="max-height: 41vh;">
            <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
                <tbody class=" overflow-auto">
                    <?php $i = 0;?>
                @foreach ($recent as $item)
                <?php $i++;?>
                  <tr>
                  <th scope="row">{{$i}}</th>
                  <td>{{$item->product_name}}</td>
                  <td>{{$item->price}}</td>
                  <td>{{$item->quantity}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
    </div>
    <div class="col-5 d-print-none">
        <div class="card">
            <div class="card-header">
                Tax & Price Comparison
            </div>
            <div class="card-body">
                <canvas id="tax_comparission" style="width: auto;height:200px;display:flex"></canvas>
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


$(document).ready(function(){
    $.ajax({
        url:"{{URL::to('/graph')}}",
        method:"GET",
        success:function(res){
            console.log(res);
            var product_name = [];
            var product_quantity = [];
            var ctx = document.getElementById('myChart').getContext('2d');
            for(var i in res){
                product_name.push(res[i].product_name);
                product_quantity.push(res[i].quantity);
            }

var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: product_name,
        datasets: [{
          backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
          data :product_quantity,
          borderWidth: 1
        }]
    },
     options: {
        events: ['click'],
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

});

        },
        error:function(res){

        }
    });

    // Actiivty Graph

    $.ajax({
        url:"{{URL::to('/activity_graph')}}",
        method:"GET",
        success:function(res){
            console.log(res);
            var Dates = [];
            var Amount = [];
            var activity = document.getElementById('recent_activity').getContext('2d');
            for(var i in res){
                Dates.push(res[i].Date);
                Amount.push(res[i].Amount);
            }

var activity_chart = new Chart(activity, {
    type: 'line',
    data: {
        labels: Dates,
        datasets: [{
          backgroundColor: [
                // 'rgba(255, 99, 132, 0.2)',
                // 'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                'rgba(145, 208, 250)'
            ],
            borderColor: [
               'rgba(0, 153, 255)',
            ],
          data :Amount,
          borderWidth: 1
        }]
    },
     options: {
        events: ['click'],
        scales: {
            yAxes: [{
                scaleLabel: {
                display: true,

                }
            }]
        }
    }

});

        },
        error:function(res){

        }
    });

    // Tax comparrison chart
    $.ajax({
        url:"{{URL::to('/tax_graph')}}",
        method:"GET",
        success:function(res){
            console.log(res);
            var taxes = [];
            var price = [];
            var tax = document.getElementById('tax_comparission').getContext('2d');
            for(var i in res){
                taxes.push(res[i].tax_amount);
                price.push(res[i].price);
            }

var activity_chart = new Chart(tax, {
    type: 'bar',
    data: {
        labels: price,
        datasets: [{
          backgroundColor: [
                'rgba(159, 143, 97,0.6)',
                'rgba(83, 207, 186, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(145, 208, 250,0.6)'
            ],
          data :price,
          borderWidth: 1
        },
        {
            type:'line',
            backgroundColor:[
                'rgba(255, 255, 255)',
            ],
            borderColor:[
                'rgba(208, 52, 23)',
            ],
            data:taxes,
        }
        ],

    },
     options: {
        events: ['click'],
        scales: {
            yAxes: [{
                scaleLabel: {
                display: true,

                }
            }]
        }
    }

});

        },
        error:function(res){

        }
    });


});

// function getrecent(){
//     var date = document.getElementById("recent_date").value;
//     $.ajax({
//         url:"{{URL::to('/home')}}",
//         method:"GET",
//         data : {'date':date},
//         success:function(res){

//         },
//         error:function(res){

//         }
//     });
// }

</script>
@endsection
