<?= $this->extend('layouts/master'); ?>
<!-- Begin Page Content -->

<?= $this->section('head') ?>

<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/icheck-bootstrap/icheck-bootstrap.css">


<?= $this->endSection() ?>

<?= $this->section('foot') ?>
<!-- Select2 -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/select2/js/select2.full.min.js"></script>


<script>
    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2();




        $('#s_rcfa').change(function(e) {
            if (e.target.checked) {
                $('#rcfa').prop('disabled', false);
            } else {
                $('#rcfa').prop('disabled', true);
            };

        });

    })
</script>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header row">
            <div class="col-sm-10 mt-3">
            <strong>Nomor : <?= $rcfa['rcfa']; ?></strong>
            </div>
            <div class="col-sm-2 text-right">
                <a href="<?= base_url('rcfa/edit/') ?> <?= $rcfa['id'];?> " class="btn btn-primary mt-2">Edit</a>
            </div>
        </div> 
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-8 align-self-start"><label >Problem : </label><?= $rcfa['problem']; ?></div>
                        <div class="col-md-4 align-self-end text-end"><label >Area : </label><?= $rcfa['area']; ?></div>
                    </div></li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4 text-center"><label >Tanggal workshop : </label><?= $rcfa['workshop']; ?></div>
                        <div class="col-md-4 text-center"><label > Surat OA : </label><?= $rcfa['nota']; ?></div>
                        <div class="col-md-4 text-center"><label > Status : </label><?= $rcfa['status']; ?></div>
                    </div></li>
                </li>
             </ul>           
        </div>           
    </div> 
    <div class="card">
        <div class="card-header">
            Daftar FDT
        </div>
        <div class="card-body">
        <table class="table table-hover table-responsive-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Target</th>
                <th scope="col">WO</th>
                <th scope="col">PIC</th>
                <th scope="col">Status</th>
                <th scope="col">Implementasi</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
       
<!-- End of Main Content -->
<?= $this->endSection(); ?>