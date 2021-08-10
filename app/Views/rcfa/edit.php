<?= $this->extend('layouts/master') ?>

<?= $this->section('head') ?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.css">

<?= $this->endSection() ?>

<?= $this->section('foot') ?>


<!-- InputMask -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/moment/moment.min.js"></script>

<!-- date-range-picker -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Page script -->
<script>
    $(function() {

        //Datemask dd/mm/yyyy

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#tgl_notas').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        //Date range picker



    })
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Input PETA </h3>
    </div>
    <form role="form" action="" method="post">
        <input type="hidden" name="id_peta" value="<?= $rcfa['id_peta'] ?>" />
        <div class="card-body">
            <div class="form-group">
                <label class="col-sm-2 col-form-label col-form-label-sm" for="area">Problem :</label><?= $rcfa['problem']; ?>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-form-label col-form-label-sm" for="area">Area :</label><?= $rcfa['area']; ?>

            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label col-form-label-sm">Tanggal Workshop</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" value="<?= $rcfa['workshop']; ?>" name="workshop" id="workshop" data-target="#reservationdate" />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>Nota Dinas</label>
                <input type="text" class="form-control" id="nota" name="nota" value="<?= $rcfa['nota']; ?>" placeholder="Enter Nota Dinas">
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label col-form-label-sm">Tanggal Nota Dinas</label>
                <div class="input-group date" id="tgl_notas" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" value="<?= $rcfa['tgl_nota']; ?>" name="tgl_nota" id="tgl_nota" data-target="#tgl_notas" />
                    <div class="input-group-append" data-target="#tgl_notas" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="area">Status</label>
                <select class="select2" name="status" data-placeholder="Select a Status" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    <option value="open" <?= ("open" == $rcfa['status']) ? 'selected' : '' ?>>Open</option>
                    <option value="inprogress" <?= ("inprogress" == $rcfa['status']) ? 'selected' : '' ?>>Inprogress</option>
                    <option value="close" <?= ("close" == $rcfa['status']) ? 'selected' : '' ?>>Close</option>
                </select>
            </div>
            
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>