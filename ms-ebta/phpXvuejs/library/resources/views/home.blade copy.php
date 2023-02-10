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
                    <h3>@{{ books }}</h3>
    
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
                    <h3>@{{ members }}</h3>
    
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
                    <h3>@{{ publishers }}</h3>
    
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
                    <h3>@{{ authors }}</h3>
    
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
                                <h3 class="card-title">Donut Chart</h3>
                                
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
                        
                        <!-- AREA CHART -->
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Area Chart</h3>
            
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
            
                    <!-- PIE CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                        <h3 class="card-title">Pie Chart</h3>
        
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
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
        
                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>
        
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
                            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
        
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>
        
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
        
                    <!-- STACKED BAR CHART -->
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
                    </div>
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
    <script type="text/javascript">
        let actionUrl = '{{ url('books') }}';
        // let apiUrl = '{{ url('api/books') }}';
        let books = '';
        let publishers = '';
        let authors = '';
        let catalog = '';
        let transaction = '';
        let members = '';

        var app = new Vue({
            el: '#containerVue',
            data: {
                books: '',
                publishers: '',
                authors: '',
                catalogs: '',
                members: '',
                transaction: '',
            },
            mounted: function () {
                console.log();
                this.get_books();
            },
            methods: {
                get_books() {
                    const _this = this;
                    // data books
                    $.ajax({
                        url: "{{ url('api/books') }}",
                        method: 'GET',
                        success: function (data) {
                            _this.books = JSON.parse(data).length;
                            console.log(_this.books);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                    // data publishers
                    axios.get('{{ url('api/publishers') }}')
                    .then(function (response) {
                        this.publishers = response.data.data.length;
                        console.log(this.publishers);
                    }.bind(this)) //You need to put .bind(this) to keep the scoped variable
                    // data author
                    axios.get('{{ url('api/authors') }}')
                    .then(function (response) {
                        this.authors = response.data.data.length;
                        console.log(this.authors);
                    }.bind(this)) //You need to put .bind(this) to keep the scoped variable
                    // data catalog
                    axios.get('{{ url('api/catalogs') }}')
                    .then(function (response) {
                        this.catalogs = response.data.data.length;
                        console.log(this.catalogs);
                    }.bind(this)) //You need to put .bind(this) to keep the scoped variable
                    // data member
                    axios.get('{{ url('api/members') }}')
                    .then(function (response) {
                        this.members = response.data.recordsTotal;
                        console.log(this.members);
                    }.bind(this)) //You need to put .bind(this) to keep the scoped variable
                    
                },
                pricing(price) {
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
            }
        })
        // grafik
        // create_graph(members, authors, publishers){
        $(function () {
            console.log(this.$data);
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
              datasets: [
                {
                  label               : 'Digital Goods',
                  backgroundColor     : 'rgba(60,141,188,0.9)',
                  borderColor         : 'rgba(60,141,188,0.8)',
                  pointRadius          : false,
                  pointColor          : '#3b8bba',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : [28, 48, 40, 19, 86, 27, 90]
                },
                {
                  label               : 'Electronics',
                  backgroundColor     : 'rgba(210, 214, 222, 1)',
                  borderColor         : 'rgba(210, 214, 222, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : [65, 59, 80, 81, 56, 55, 40]
                },
              ]
            }
        
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
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false
        
            var lineChart = new Chart(lineChartCanvas, {
              type: 'line',
              data: lineChartData,
              options: lineChartOptions
            })
        
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
              labels: [
                  'Pembaca',
                  'Penulis',
                  'Penerbit',
              ],
              datasets: [
                {
                  data: [30, 40, 50],
                  backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
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
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData        = donutData;
            var pieOptions     = {
              maintainAspectRatio : false,
              responsive : true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
              type: 'pie',
              data: pieData,
              options: pieOptions
            })
        
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0
        
            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }
        
            new Chart(barChartCanvas, {
              type: 'bar',
              data: barChartData,
              options: barChartOptions
            })
        
            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = $.extend(true, {}, barChartData)
        
            var stackedBarChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              scales: {
                xAxes: [{
                  stacked: true,
                }],
                yAxes: [{
                  stacked: true
                }]
              }
            }
        
            new Chart(stackedBarChartCanvas, {
              type: 'bar',
              data: stackedBarChartData,
              options: stackedBarChartOptions
            })
        })
    </script>
@endsection