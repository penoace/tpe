<?= $this->extend('layouts/master'); ?>
<!-- Begin Page Content -->

<?= $this->section('head') ?>

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

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte3') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


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
                <a href="<?= base_url('rcfa/edit/') ?>/<?= $rcfa['id']; ?> " class="btn btn-primary mt-2">Edit</a>
            </div>
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
                        <div class="col-md-4 text-center"><label>Tanggal workshop : </label><?php $tanggal = strtotime($rcfa['workshop']);
                                                                                            echo ($rcfa['workshop'] == null) ? '' : date('d-M-Y', $tanggal); ?></div>
                        <div class="col-md-4 text-center"><label> Surat OA : </label><?= $rcfa['nota']; ?></div>
                        <div class="col-md-4 text-center"><label> Status : </label><?= $rcfa['status']; ?></div>
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
                <a href="<?= base_url('fdt/input/') ?>/<?= $rcfa['id']; ?> " class="btn btn-primary mt-2">Tambah FDT</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah
                </button>
            </div>
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
                    <?php foreach ($fdt as $fdtt) : ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><?= $fdtt['deskripsi']; ?></td>
                            <td><?php $tanggal = strtotime($fdtt['target']);
                                echo ($fdtt['target'] == null) ? '' : date('d-M-Y', $tanggal); ?></td>
                            <td><?= $fdtt['no_wo']; ?></td>
                            <td><?= $fdtt['username']; ?></td>
                            <td><?= $fdtt['progress']; ?></td>
                            <td><?php $tanggal = strtotime($fdtt['implementasi']);
                                echo ($fdtt['implementasi'] == '0000-00-00 00:00:00') ? '' : date('d-M-Y', $tanggal); ?></td>
                            <td><?= $fdtt['keterangan']; ?></td>
                            <td>@mdo</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/fdt/input/<?= $rcfa['id']; ?>" $ method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah FDT</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="deskripsi" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="target">Target</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="target" id="target" data-target="#target" />
                                <div class="input-group-append" data-target="#target" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_wo">No WO</label>
                            <input type="text" name="no_wo" id="no_wo" class="form-control" placeholder="no_wo" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="area">PIC</label>
                            <select class="select2" name="id_pic" style="width: 100%;">
                                <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user->id; ?>"><?= $user->username; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="progress">Progress</label>
                            <select class="form-control" name="progress" id="progress">
                                <option value="open">Open</option>
                                <option value="inprogress">Inprrogress</option>
                                <option value="close">Close</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="implementasi">Implementasi</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="implementasi" id="implementasi" data-target="#implementasi" />
                                <div class="input-group-append" data-target="#implementasi" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End of Main Content -->
<?= $this->endSection(); ?>