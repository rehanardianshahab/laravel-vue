@extends('layouts.app3')

@section('css')
  {{-- bootsrap icons --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container" id="containerVue">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                
                <div class="card-header">
                    {{ __('Dashboard') }}

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>{{ $books }}</h3>
    
                    <p>Total Buku</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                    <h3>{{ $members }}</h3>
    
                    <p>Total Anggota</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>{{ $publishers }}</h3>
    
                    <p>Total Penerbit</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                    <h3>{{ $authors }}</h3>
    
                    <p>Total Penulis</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- DONUT CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Data User</h3>
                                
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        
                        <!-- BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                            <h3 class="card-title">Buku by Penulis</h3>
            
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                            </div>
                            <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
        
                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">
                        <!-- AREA CHART -->
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Peminjaman dan Pengembalian</h3>
            
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                            </div>
                            <div class="card-body">
                            <div class="chart">
                                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
        
                    <!-- BAR CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                        <h3 class="card-title">Buku by publishers</h3>
        
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                        </div>
                        <div class="card-body">
                        <div class="chart">
                            <canvas id="barPublishers" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
        
                    {{--<!-- STACKED BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>
        
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                        </div>
                        <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        </div>
                        <!-- /.card-body -->
                    </div> --}}
                    <!-- /.card -->
        
                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            
        </div>
    </div>
</div>
@endsection

@section('scriptLink')
{{-- axios --}}
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
{{-- vuejs --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
<!-- Remember to include jQuery :) -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> --}}
@endsection

@section('js')
<script>
    // compact data
    const label_donut = {!! json_encode($label_donut) !!};
    const data_donut = {!! json_encode($data_donut) !!};
    const data_area = {!! json_encode($data_area) !!};
    const data_bar =  {!! json_encode($data_bar) !!};
    const data_publisher =  {!! json_encode($data_publisher) !!};
    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */
  
      //--------------
      //- AREA CHART -
      //--------------
  
      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

      var areaChartData = {
        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: data_area,
      }
    //   var barChartCanvas = $('#barChart').get(0).getContext('2d')
    //   var barChartData = $.extend(true, {}, areaBarChartData)
  
    //   var areaChartData = {
    //     labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    //     datasets: [
    //       {
    //         label               : 'Digital Goods',
    //         backgroundColor     : 'rgba(60,141,188,0.9)',
    //         borderColor         : 'rgba(60,141,188,0.8)',
    //         pointRadius          : false,
    //         pointColor          : '#3b8bba',
    //         pointStrokeColor    : 'rgba(60,141,188,1)',
    //         pointHighlightFill  : '#fff',
    //         pointHighlightStroke: 'rgba(60,141,188,1)',
    //         data                : [28, 48, 40, 19, 86, 27, 90]
    //       },
    //       {
    //         label               : 'Electronics',
    //         backgroundColor     : 'rgba(210, 214, 222, 1)',
    //         borderColor         : 'rgba(210, 214, 222, 1)',
    //         pointRadius         : false,
    //         pointColor          : 'rgba(210, 214, 222, 1)',
    //         pointStrokeColor    : '#c1c7d1',
    //         pointHighlightFill  : '#fff',
    //         pointHighlightStroke: 'rgba(220,220,220,1)',
    //         data                : [65, 59, 80, 81, 56, 55, 40]
    //       },
    //     ]
    //   }
  
      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : false,
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        }
      }
  
      // This will get the first returned node in the jQuery collection.
      new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
      })
  
      //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var donutData        = {
        labels: label_donut,
        datasets: [
          {
            data: data_donut,
            backgroundColor : ['#00a65a', '#f56954', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
          }
        ]
      }
      var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })
  
      //-------------
      //- BAR CHART -
      //-------------
        const ctx = document.getElementById('barChart');
        new Chart(ctx, {
        type: 'bar',
        data: {
            labels:  data_bar['labels_bar'],
            datasets: [{
                label: '# Jumlah buku',
                data: data_bar['data'],
                borderWidth: 1,
                backgroundColor: data_bar['backgroundColor'],
            }]
            },
            options: {
            scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            }
        });

      //-------------
      //- BAR PUBLISHER -
      //-------------
      const pubs = document.getElementById('barPublishers');
        new Chart(pubs, {
            type: 'radar',
            data: {
                labels:  data_publisher['labels_publisher'],
                datasets: [{
                    axis: 'y',
                    label: 'Jumlah Buku',
                    data: data_publisher['data'],
                    fill: false,
                    backgroundColor: data_publisher['backgroundColor'],
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                }]
            },
            options: {
                elements: {
                    line: {
                        borderWidth: 3
                    }
                }
            },
        });
    })
  </script>
@endsection