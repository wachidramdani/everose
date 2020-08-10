

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Dashboard</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item active">Home</li>

            </ol>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <div class="content">

      <div class="container-fluid">

        <div class="row">



            <div class="col-lg-3 col-6">

                <!-- small box -->

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3><?=$num_new_order;?></h3>



                        <p>Orderan Baru</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-shopping-bag"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-6">

                <!-- small box -->

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3><?=$num_profit;?></h3>



                        <p>Pendapatan</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-dollar-sign"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-6">

                <!-- small box -->

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3><?=$num_visitor;?></h3>



                        <p>Pengunjung</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-users"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-6">

                <!-- small box -->

                <div class="small-box bg-danger">

                    <div class="inner">

                        <h3><?=$num_comment;?></h3>



                        <p>Ulasan</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-comments"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">



            <div class="col-md-8 col-sm-12">

                <div class="card">

                    <div class="card-header">

                        <div class="card-title">Laporan Penjualan</div>

                    </div>

                    <div class="card-body">

                        <div style="position:relative;height: 300px;">

                            <canvas id="myChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>



            <div class="col-md-4 col-sm-12">

                <div class="card">

                    <div class="card-header">

                        <div class="card-title">Laporan Pengunjung</div>

                    </div>

                    <div class="card-body">

                        <ul class="list-group">

                            <li class="list-group-item">

                                Bulan ini

                                <span class="float-right"><?=$num_visitor_month;?></span>

                            </li>

                            <li class="list-group-item">

                                Tahun ini

                                <span class="float-right"><?=$num_visitor_year;?></span>

                            </li>

                            <li class="list-group-item">

                                Total

                                <span class="float-right"><?=$num_visitor_total;?></span>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>



        </div>

      </div>

    </div>

</div>

<script src="<?=base_url("assets/adminlte/plugins/chart.js/Chart.min.js");?>"></script>

<script>

var ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {

    type: 'line',

    data: {

        labels: [<?=$month;?>],

        datasets: [{

            label: '<?=$title_chart;?>',

            data: [<?=$chart;?>],

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

            borderWidth: 1

        }]

    },

    responsive: false,

    options: {

        maintainAspectRatio: false,

        scales: {

            yAxes: [{

                ticks: {

                    beginAtZero: true

                }

            }]

        }

    }

});

</script>