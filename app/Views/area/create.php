<?= $this->extend('layouts/master'); ?>
<!-- Begin Page Content -->
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input Area </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="area">Area</label>
                                <input type="text" class="form-control" id="area" name="area" placeholder="Enter Area">
                            </div>

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