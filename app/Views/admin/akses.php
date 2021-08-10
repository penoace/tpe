<?= $this->extend('layouts/master'); ?>


<?= $this->section('head') ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte3') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<?= $this->endSection() ?>

<?= $this->section('foot') ?>
<script src="<?= base_url('assets/adminlte3') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }

    $('.form-check-input').on('click', function(){
        const roleid =  $(this).data('role');
        const userid =  $(this).data('id');
        
        
        $.ajax({
            type: "post",
            url: "<?= base_url('admin/changeaccess')  ?>",
            data: {
                roleid:roleid,
                userid:userid
            },
            success: function (response) {
                Swal.fire({
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1000
                                }).then(function(){
                                    document.location.href = "<?= base_url('admin/akses/'); ?>" +"/"+ userid;
                                })
               
                
            }
        });
        

    })


</script>
<?= $this->endSection() ?>
<!-- Begin Page Content -->
<?= $this->section('content'); ?>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="card-title">Daftar Permission User  : <?= $users->username ?> </h1>
                        </div>
                       
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width=5%>No</th>
                                <th>Permision</th>
                                <th width=20%px>Hak Akses</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($permisions as $permision) : ?>
                                <tr>
                                    <td><?= $n++; ?> </td>
                                    <td><?= $permision['name'] ?></td>
                                    <td> <div class="form-check">
                                            <input class="form-check-input" type="checkbox" <?= checkrole($users->id , $permision['id'] ) ?> data-role="<?= $permision['id'] ?>" data-id="<?= $users->id ?>" >
                                            
                                        </div>
                                    </td>
                                    
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width=5%>No</th>
                                <th>Permission</th>
                                <th>Hak Akses</th>
                                
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <a href="<?= base_url('admin'); ?>">&laquo; back</a>
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

    <!-- Modal -->
    <div class="viewmodal" style="display: none;"></div>
</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->
<?= $this->endSection(); ?>