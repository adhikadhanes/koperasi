@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.js"></script>

<br>
<div class="col-md-6">
            <div class="col-md-6 box">
                 <div class="col-md-12">
                    <center>
                    <br>
                    <h1>
                        Selamat Datang, <br> {{ Auth::user()->name }}                   
                        <span class="glyphicon glyphicon-user"></span>
                    </h1>
                    <hr>
                 </center>
            
                </div>
            </div>
            <div class="col-md-6 box">
            <center>
            <h2>
             <span class="glyphicon glyphicon-piggy-bank"></span>
                Anda memiliki {{ Auth::user()->poin }} poin
            </h2>
            <center>
            </div>



        </div>

        <div class="col-md-6">


            <div class="col-md-6 box">
                 <div class="col-md-12">
                    <center>
                    <h2>Top Spenders</h2>
                    <hr>
                        <table class="table table-responsive" id="users-table">
                            <thead>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Poin</th>
                            </thead>
                            <tbody>


                             {{-- */$x=0;/* --}}
                
                            @foreach($users as $user)
                                {{-- */$x++;/* --}}
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>{!! $user->name !!}</td>
                                    <td>{!! $user->poin !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </center>
                    </div>
                    </div>
        </div>

         <div class="col-md-6">
      <div class="box box-solid bg-teal-gradient">
            <div class="box-header with-border">
              <h3 class="box-title">Penjualan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <canvas id="myChart" ></canvas>
            </div>
            <!-- /.box-body -->
          </div>

          </div>

            <div class="clearfix"></div>

<script>

var xAxis = [];
          var yAxis1 = [];

            @foreach($penjualan as $rats)
              xAxis.push('{{$rats->created_at->format('H:i:s')}}');
              yAxis1.push('{{$rats->Jumlah}}');
                           
            @endforeach

var ctx = document.getElementById("myChart");


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: xAxis,
        datasets: [{

            fill: false,
            data: yAxis1,
            lineTension: 0.1,
                      borderColor: "rgba(45, 178, 213, 1)",
                      borderCapStyle: 'butt',
                      borderDash: [],
                      borderDashOffset: 0.0,
                      borderJoinStyle: 'miter',
                      pointBorderColor: "rgba(45, 178, 213, 1)",
                      pointBackgroundColor: "#fff",
                      pointBorderWidth: 1,
                      pointRadius: 5,
                      label:'Penjualan hari ini',
                      pointHitRadius: 10,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

Chart.defaults.global.responsive = true;
</script>
@endsection
