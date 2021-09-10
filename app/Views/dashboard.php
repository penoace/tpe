<?= $this->extend('layouts/master') ?>

<?= $this->section('head') ?>
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/jqvmap/jqvmap.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/summernote/summernote-bs4.css">
<?= $this->endSection() ?>

<?= $this->section('foot') ?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/adminlte3') ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/adminlte3') ?>/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/adminlte3') ?>/js/demo.js"></script>
<?php
cekrcfa();
$listuser = "";
$jumlah = 1;
$openfdt = "";
$closefdt = "";
$listrcfa = "";
$jumlahrcfa = 1;
$openrcfa = "";
$closercfa = "";
foreach ($chart as $isi) :
    $listuser .=  "'$isi->username'" . ", ";
    $jumlah++;
    $openfdt .= cekopenfdt($isi->id) . ", ";
    $closefdt .= cekclosefdt($isi->id) . ", ";
endforeach;
foreach ($chart2 as $isi2) :
    echo $isi2->username;
    $listrcfa .=  "'$isi2->username'" . ", ";
    $jumlahrcfa++;
    $openrcfa .= cekopenrcfa($isi2->id) . ", ";
    $closercfa .= cekclosercfa($isi2->id) . ", ";
endforeach;


?>
<script>
    $(document).ready(function() {
        $('#daftardft').DataTable();
    });
    var ctx = document.getElementById('myChart').getContext('2d');
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    const DATA_COUNT = <?php echo $jumlah; ?>;
    const NUMBER_CFG = {
        count: DATA_COUNT,
        min: 0,
        max: 100
    };

    var stackedBarChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            xAxes: [{
                stacked: true
            }],
            yAxes: [{
                stacked: true
            }]
        },
        plugins: {
            legend: {
                display: true,
                labels: {
                    color: 'rgb(255, 99, 132)'
                }
            },
            title: {
                display: true,
                text: 'Custom Chart Title'
            }
        }
    }
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $listuser ?>],
            datasets: [{
                    label: 'Open',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [<?php echo $openfdt ?>]
                },
                {
                    label: 'Close',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [<?php echo $closefdt ?>]
                },
            ]
        },
        options: stackedBarChartOptions
    });
    var myChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [<?php echo $listrcfa ?>],
            datasets: [{
                    label: 'Open',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [<?php echo $openrcfa ?>]
                },
                {
                    label: 'Close',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [<?php echo $closercfa ?>]
                },
            ]
        },
        options: stackedBarChartOptions
    });
</script>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="row">
                <div class="col-6 border-right">
                    <div class="align-middle text-center ">
                        <h3><?= $jpetao ?></h3>
                        <p>Open </p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="align-middle text-center ">
                        <h3><?= $jpetac ?></h3>
                        <p>Close</p>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('peta') ?>" class="small-box-footer">Peta Improvement <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="row">
                <div class="col-6 border-right">
                    <div class="align-middle text-center ">
                        <h3><?= $jrcfao ?></h3>
                        <p>Open </p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="align-middle text-center ">
                        <h3><?= $jrcfac ?></h3>
                        <p>Close</p>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('rcfa') ?>" class="small-box-footer">RCFA <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="row">
                <div class="col-6 border-right">
                    <div class="align-middle text-center ">
                        <h3><?= $jfdto ?></h3>
                        <p>Open </p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="align-middle text-center ">
                        <h3><?= $jfdtc ?></h3>
                        <p>Close</p>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('rcfa') ?>" class="small-box-footer">FDT <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">
        <!-- chart fdt -->
        <div class="card px-0 mb-0">
            <div class="card-header" style="text-align: center;padding:0;">
                Grafik FDT
            </div>
            <div class="card-body" style="padding-bottom:0;padding-top:0;">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- table FDT -->
        <div class="card">
            <div class="card-body p-3">
                <table class="table table-sm text-xsmall">
                    <tr>
                        <th>Status</th>
                        <?php foreach($chart as $usr):?>
                            <th><?= $usr->username ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Open</td>
                        <?php foreach($chart as $usr):?>
                            <th><?= cekopenfdt($usr->id) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Close</td>
                        <?php foreach($chart as $usr):?>
                            <th><?= cekclosefdt($usr->id) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </div>
        </div>
        <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    To Do List FDT
                </h3>

                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <?php foreach ($fdtlist as $list) : ?>
                        <?php if ($list['validasi'] != 'close') { ?>
                            <li>
                                <!-- todo text -->
                                <span class="text"><?= $list['deskripsi'] ?></span>
                                <!-- Emphasis label -->

                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <a href="<?= base_url('rcfa/detail/') . '/' . $list['id_rcfa'] ?>"><i class="fas fa-edit"></i></a>
                                    <i class="fas fa-trash-o"></i>
                                </div>
                            </li>
                    <?php }
                    endforeach ?>
                </ul>
            </div>
            <!-- /.card-body -->

        </div>
        

        <!-- /.card -->
    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-6 connectedSortable">
        
        <div class="card px-0 mb-0">
            <div class="card-header" style="text-align: center;padding:0;">
                Grafik RCFA
            </div>
            <div class="card-body" style="padding-bottom:0;padding-top:0;">
                <canvas id="myChart2" width="400" height="200"></canvas>
            </div>
        </div>
        <!-- table RCFA -->
        <div class="card">
            <div class="card-body p-3">
                <table class="table table-sm text-xsmall">
                    <tr>
                        <th>Status</th>
                        <?php foreach($chart2 as $usr):?>
                            <th><?= $usr->username ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Open</td>
                        <?php foreach($chart2 as $usr):?>
                            <th><?= cekopenrcfa($usr->id) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Close</td>
                        <?php foreach($chart2 as $usr):?>
                            <th><?= cekclosercfa($usr->id) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    To Do List RCFA
                </h3>

                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <?php foreach ($rcfalist as $listr) : ?>
                        <?php if ($listr['status'] != 'close') { ?>
                            <li>


                                <!-- todo text -->
                                <span class="text"><?= $listr['problem'] ?></span>
                                <!-- Emphasis label -->

                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <a href="<?= base_url('rcfa/detail/') . '/' . $listr['id'] ?>"><i class="fas fa-edit"></i></a>
                                    <i class="fas fa-trash-o"></i>
                                </div>
                            </li>

                    <?php }
                    endforeach ?>

                </ul>
            </div>
            <!-- /.card-body -->

        </div>


    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->
<?= $this->endSection() ?>