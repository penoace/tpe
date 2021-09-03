<?= $this->extend('layouts/master'); ?>
                <!-- Begin Page Content -->

<?= $this->section('head') ?>
    <!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.css">

<?= $this->endSection() ?>


<?= $this->section('foot') ?>
    <!-- DataTables -->
    <script src="<?= base_url('assets/adminlte3') ?>/plugins/moment/moment.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- page script -->
    <!-- date-range-picker -->
    <script src="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Include Date Range Picker -->

    <script>
    
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            console.log(start.format('MMMM D, YYYY'));
            console.log(end.format('MMMM D, YYYY'));
            $('#start').html(start.format('YYYY-MM-D'));
            $('#end').html(end.format('YYYY-MM-D'));
            datapeta(start.format('YYYY-MM-D') ,end.format('YYYY-MM-D') );
            
        }

        $('#daterange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        function cbrcfa(start, end) {
            $('#daterangercfa span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            console.log(start.format('MMMM D, YYYY'));
            console.log(end.format('MMMM D, YYYY'));
            $('#startrcfa').html(start.format('YYYY-MM-D'));
            $('#endrcfa').html(end.format('YYYY-MM-D'));
            datarcfa(start.format('YYYY-MM-D') ,end.format('YYYY-MM-D') );
            
        }

        $('#daterangercfa').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cbrcfa);

        console.log( cb(start, end) );

        function datapeta(start, end){
            $.ajax({
                url: "<?= base_url('report/ambildata') ?>",
                dataType: "json",
                data: {
                    startdate : start,
                    enddate : end
                },
                success: function (response) {
                    $('.viewdata').html(response.data)
                },
                error : function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
        }

         function datarcfa(start, end){
            $.ajax({
                url: "<?= base_url('report/ambildatarcfa') ?>",
                dataType: "json",
                data: {
                    startdate : start,
                    enddate : end
                },
                success: function (response) {
                    $('.viewdatarcfa').html(response.data)
                },
                error : function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
        }

        $(document).ready(function(){
            datapeta();
            datarcfa();

        });

        function cetak(){
            var start = document.getElementById('start').innerHTML;
            var end = document.getElementById('end').innerHTML;
            
            window.location.href = "<?php echo base_url('report/export/');?>"+"/" + start +"/" + end;
            
        }
        function cetakrcfa(){
            var start = document.getElementById('startrcfa').innerHTML;
            var end = document.getElementById('endrcfa').innerHTML;
            
            window.location.href = "<?php echo base_url('report/export/');?>"+"/" + start +"/" + end;
            
        }

    </script>
<?= $this->endSection() ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                     <div class="card-header">
                        Report Peta
                    </div>
                    <div class="card-body">   
                        <span>Pilih Tanggal</span>
                        <div id="daterange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 18rem; ">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                        <span  id='start' hidden>tes </span>
                        <span  id='end' hidden>tes </span>
                        <div class="card-body viewdata"></div>
                        <button class="btn btn-primary" type="button" onclick="cetak()">Cetak</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card" >
                     <div class="card-header">
                        Report RCFA
                    </div>
                    <div class="card-body">   
                        <span>Pilih Tanggal</span>
                        <div id="daterangercfa" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 18rem; ">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                        <span  id='startrcfa' hidden>tes </span>
                        <span  id='endrcfa' hidden>tes </span>
                        <div class="card-body viewdatarcfa"></div>
                        <button class="btn btn-primary" type="button" onclick="cetakrcfa()">Cetak</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
            