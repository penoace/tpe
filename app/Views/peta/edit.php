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
                $('#id_pic').prop('disabled', false);
            } else {
                $('#rcfa').prop('disabled', true);
                $('#id_pic').prop('disabled', true);
            };

        });

    })
</script>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input PETA </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="area">Problem</label>
                                <input type="text" class="form-control" name="problem" placeholder="Enter Problem" value="<?= $peta['problem']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="area">Area</label>
                                <select class="select2" name="id_area" style="width: 100%;">
                                    <?php foreach ($area as $area2) : ?>
                                        <option value="<?= $area2['id']; ?>" <?= ($area2['id'] == $peta['id_area']) ? 'selected' : '' ?>><?= $area2['area']; ?></option>

                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="area">Effect</label>
                                <input type="text" class="form-control" name="effect" placeholder="Enter Effect" value="<?= $peta['effect']; ?>">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="area">Pareto</label>
                                <div class="select2-purple">
                                    <?php $eff = json_decode($peta['pareto'], true);
                                    //d($eff); ?>
                                   
                                    <select class="select2" name="pareto[]" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <?php foreach ($paretos as $pareto) : ?>
                                            <option value="<?= $pareto['id']; ?>" <?= (in_array($pareto['id'], $eff)) ? 'selected' : '' ?>><?= $pareto['pereto']; ?></option>

                                        <?php endforeach ?>
                                    </select>

                                </div>
                            </div>
                            <?php if (has_permission('sub_admin')) { ?>
                                <div class="form-group clearfix">
                                    <label for="area">RCFA</label>
                                    <div class="icheck"><input type="checkbox" <?= ($peta['s_rcfa'] == 1) ? 'checked' : '' ?> name="s_rcfa" id="s_rcfa">
                                        <label for="checkboxDanger1">y/n</label>
                                    </div>
                                    <input type="text" class="form-control" id="rcfa" name="rcfa" <?= ($peta['s_rcfa'] == 1) ? '' : 'disabled' ?> value="<?= $peta['rcfa']; ?>" placeholder="Enter RCFA">
                                </div>
                            

                            <div class="form-group">
                                <label for="area">PIC</label>
                                <select class="select2" name="id_pic" id="id_pic" style="width: 100%;" <?= ($peta['s_rcfa'] == 1) ? '' : 'disabled' ?>>
                                    <option>Pilih PIC</option>
                                    <?php foreach ($users as $user) : ?>
                                        <option value="<?= $user->id; ?>" <?= ($user->id == $peta['id_pic']) ? 'selected' : '' ?>><?= $user->username; ?></option>

                                    <?php endforeach ?>
                                </select>
                            </div>
                            
                                <div class="form-group">
                                    <label for="area">Status</label>
                                    <select class="select2" name="status" data-placeholder="Select a Status" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option value="open" <?= ("open" == $peta['status']) ? 'selected' : '' ?>>Open</option>
                                        <option value="inprogress" <?= ("inprogress" == $peta['status']) ? 'selected' : '' ?>>Inprogress</option>
                                        <option value="close" <?= ("close" == $peta['status']) ? 'selected' : '' ?>>Close</option>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>