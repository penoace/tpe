<?= $this->extend('layouts/master'); ?>
<!-- Begin Page Content -->
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Permission</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="" method="post">
                        <input type="hidden" name="id" value="<?= $permision['id'] ?>" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value=<?= $permision['name']; ?> class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" value="<?= $permision['description']; ?>" class="form-control" id="description" name="description" placeholder="Enter Deskripsi">
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