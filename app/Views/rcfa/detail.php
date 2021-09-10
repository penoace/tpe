<?= $this->extend('layouts/master'); ?>
<!-- Begin Page Content -->

<?= $this->section('head') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/icheck-bootstrap/icheck-bootstrap.css">
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.css">


<?= $this->endSection() ?>

<?= $this->section('foot') ?>
<!-- Select2 -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/moment/moment.min.js"></script>

<!-- date-range-picker -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/adminlte3') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- page script -->

<script>
    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2();

        $('#target').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#implementasi').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#progress').change(function(e) {

            if (this.value == 'close') {
                $('#implemantasi').prop('disabled', false);
                $('#implemantasi').datepicker("option", "disabled", false);
                $('#implemantasi').datepicker().datepicker('enable');
            } else {
                $('#implemantasi').prop('disabled', true);
                $('#implemantasi').datepicker("option", "disabled", true);
                $('#implemantasi').datepicker().datepicker('disable');
            }
        });
        $('#s_rcfa').change(function(e) {
            if (e.target.checked) {
                $('#rcfa').prop('disabled', false);
            } else {
                $('#rcfa').prop('disabled', true);
            };

        });

    });

    function updateDiv() {
        $("#header").load(" #header > *")
    }


    function datafdt() {
        $.ajax({
            url: "<?= base_url('rcfa/ambilfdt') ?>",
            dataType: "json",
            data: {
                'id': '<?= $rcfa['id'] ?>'
            },
            success: function(response) {
                $('.viewdata').html(response.data)
            },
            error: function(xhr, ajaxOptions, throwError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }
    $(document).ready(function() {
        datafdt();

        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('rcfa/formtambah') ?>",
                data: {
                    'id': '<?= $rcfa['id'] ?>'
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal('show');
                    updateDiv()
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
        })
    });
</script>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card" id="header">
        <div class="card-header row">
            <div class="col-sm-10 mt-3">
                <strong>Nomor : <?= $rcfa['rcfa']; ?></strong>
            </div>
            <?php if (has_permission('rcfa')) { ?>
                <div class="col-sm-2 text-right">
                    <a href="<?= base_url('rcfa/edit2/') ?>/<?= $rcfa['id']; ?> " class="btn btn-primary mt-2">Edit</a>
                </div>
            <?php } ?>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-8 align-self-start"><label>Problem : </label><?= $rcfa['problem']; ?></div>
                        <div class="col-md-4 align-self-end text-end"><label>Area : </label><?= $rcfa['area']; ?></div>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-3 text-center"><label>Tanggal workshop : </label>
                            <?php $tanggal = strtotime($rcfa['workshop']);
                            echo ($rcfa['workshop'] == null) ? '' : date('d-M-Y', $tanggal); ?>
                        </div>
                        <div class="col-md-3 text-center"><label> Surat OA : </label><?= $rcfa['nota']; ?></div>
                        <div class="col-md-3 text-center"><label>Tanggal OA: </label>
                            <?php $tanggal = strtotime($rcfa['tgl_nota']);
                            echo ($rcfa['tgl_nota'] == null) ? '' : date('d-M-Y', $tanggal); ?>
                        </div>
                        <div class="col-md-3 text-center"><label> Status : </label><?= checkfdt($rcfa['id']); ?></div>
                    </div>
                </li>
                </li>
            </ul>
        </div>
    </div>
    <div class="card">
        <div class="card-header row">
            <div class="col-sm-9 mt-3">
                <strong>Daftar FDT</strong>
            </div>
            <div class="col-sm-3 text-right">
                <?php if (has_permission('rcfa')) { ?>
                    <button type="button" class="btn btn-primary tomboltambah" data-toggle="modal" data-target="#exampleModal">
                        Tambah
                    </button>
                <?php } ?>
            </div>
        </div>
        <div class="card-body viewdata">

        </div>
    </div>

    <!-- Modal -->
    <div class="viewmodal" style="display: none;"></div>
</div>

<!-- End of Main Content -->
<?= $this->endSection(); ?>