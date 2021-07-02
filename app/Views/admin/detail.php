<?= $this->extend('templates/index'); ?>
<!-- Begin Page Content -->
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">admin</h1>
    <?php d($users); ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item"><?= $users->username ?></li>
                                <li class="list-group-item"><?= $users->email ?></li>
                                <li class="list-group-item">
                                    <span class="badge badge-<?= ($users->group == 'admin' ? 'danger' : 'success'); ?> "><?= $users->group ?></span>
                                </li>
                                <li class="list-group-item">
                                    <a href="<?= base_url('admin'); ?>">&laquo; back</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>