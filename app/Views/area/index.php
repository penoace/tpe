<?= $this->extend('layouts/master'); ?>

<?= $this->section('foot') ?>

<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }
</script>
<?= $this->endSection() ?>
<!-- Begin Page Content -->
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="card-title">Daftar Area</h1>
                        </div>
                        <div class="col-sm-2 text-right">
                            <a href="<?= base_url('area/input') ?>" class="btn btn-primary mt-2">Add</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width=5%>No</th>
                                <th>Area</th>
                                <th width=20%px>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($area as $are) : ?>
                                <tr>
                                    <td><?= $n++; ?> </td>
                                    <td><?= $are['area'] ?></td>
                                    <td>
                                        <a href="<?= base_url('area/edit/' . $are['id']); ?>" class="btn btn-info">Edit</a>
                                        <a href="#" data-href="<?= base_url('area/delete/' . $are['id']) ?>" onclick="confirmToDelete(this)" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width=5%>No</th>
                                <th>Area</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="h2">Are you sure?</h2>
                    <p>The data will be deleted and lost forever</p>
                </div>
                <div class="modal-footer">
                    <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->
<?= $this->endSection(); ?>