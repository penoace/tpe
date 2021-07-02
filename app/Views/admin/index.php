<?= $this->extend('templates/index'); ?>
                <!-- Begin Page Content -->
<?= $this->section('content'); ?>
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">admin</h1>
    <?php d($users); ?>
    <div class="row">
        <div class="col-lg-8">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($users as $user) : ?>
                <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $user->username; ?></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->group; ?></td>
                <td>
                    <a href="<?= base_url('admin/'.$user->id);?>" class="btn btn-info">detail</a>    
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>            



  </div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>
            