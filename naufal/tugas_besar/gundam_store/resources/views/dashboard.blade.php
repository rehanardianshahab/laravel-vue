@extends('master.master')

@section('header', 'DASHBOARD')

@section('css')

@endsection

@section('content')
    <!-- top tiles -->
    <div class="row" >
        <div class="col-md-12 tile_count">
          <div class="col-md-3 col-sm-4  tile_stats_count">
            <p class="count_top"><i class="fa fa-user"></i> Total Users</p>
            <div class="count">{{ $total_users }}</div>
          </div>
          <div class="col-md-3 col-sm-4  tile_stats_count">
            <p class="count_top"><i class="fa fa-money"></i> Total Transaction</p>
            <div class="count">{{ $total_transactions }}</div>
          </div>
          <div class="col-md-3 col-sm-4  tile_stats_count">
            <p class="count_top"><i class="fa fa-cubes"></i> Total Product</p>
            <div class="count green">{{ $total_products }}</div>
          </div>
          <div class="col-md-3 col-sm-4  tile_stats_count">
            <p class="count_top"><i class="fa fa-building-o"></i> Total Manufacturer</p>
            <div class="count">{{ $total_manufacturers }}</div>
          </div>
        </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <h3>Top 5 MANUFACTURER</h3>
          <div class="card-box table-responsive">
              <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                  <thead>
                      <tr>
                      <th>No</th>
                      <th>Manufacturer</th>
                      <th>Total Product</th>
                      <th>Percentage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($topManufacture as $key => $topMan)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $topMan->manufacture_company }}</td>
                        <td>{{ $topMan->total_manufacture }}</td>
                        <td>{{ percentage($topMan->total_manufacture, $total_products) }} %</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  </div>
</div>
    <!-- /top tiles -->
@endsection

@section('js')
<script type="text/javascript">
  
</script>
@endsection