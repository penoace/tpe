<?= $this->extend('layouts/master'); ?>

<?= $this->section('foot') ?>

<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }

    $('.btn-rcfa').on('click', function() {


        const id = $(this).data('id');
        const pic = $(this).data('pic');
        const problem = $(this).data('problem');
        $('.pic').val(pic);
        $('.id_peta').val(id);
        $('.peta_problem').val(problem);
        $("#rcfa").modal('show');
    });
    $('.btn-detail').on('click', function() {


        const id = $(this).data('id');
        const pic = $(this).data('pic');
        const problem = $(this).data('problem');
        const area = $(this).data('area');
        const status = $(this).data('status');
        const rcfa = $(this).data('rcfa');

        $.ajax({
            url: "<?php echo base_url('peta/pareto/'); ?>" + "/" + id,
            type: 'post',
            dataType: 'text',
            data: {
                id: id
            },
            success: function(data) {
                $('#dpareto').empty();
                $('#dpareto').append(data);
            }
        });
        $('#dproblem').text(problem);
        $('#darea').text(area);
        $('#dpic').text(pic);
        $('#dstatus').text(status);
        $('#drcfa').text(rcfa);
        $("#detail").modal('show');
    });
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
                            <a href="<?= base_url('peta/input') ?>" class="btn btn-primary mt-2">Add</a>
                        </div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width=5%>No</th>
                                <th>Problem</th>
                                <th>Area</th>
                                <th>RCFA</th>
                                <th>PIC</th>
                                <th width=20%px>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            <?php foreach ($petas as $peta) : ?>
                                <tr>
                                    <td><?= $n++; ?> </td>
                                    <td><?= $peta['problem'] ?></td>
                                    <td><?= $peta['area'] ?></td>
                                    <td><?= $peta['s_rcfa'] ?></td>
                                    <td><?= $peta['username'] ?></td>
                                    <td>
                                        <a href="#" data-pareto="<?= $peta['pareto']; ?>" data-rcfa="<?= $peta['rcfa']; ?>" data-status="<?= $peta['status']; ?>" data-area="<?= $peta['area']; ?>" data-pic="<?= $peta['username']; ?>" data-id="<?= $peta['id']; ?>" data-problem="<?= $peta['problem']; ?>" class="btn btn-primary btn-detail">Detail</a>
                                        <a href="<?= base_url('peta/edit/' . $peta['id']); ?>" class="btn btn-info">Edit</a>
                                        <a href="#" data-href="<?= base_url('peta/delete/' . $peta['id']) ?>" onclick="confirmToDelete(this)" class="btn btn-danger">Delete</a>
                                        <?php if (($peta['s_rcfa'] == 1) and !(in_array($peta['id'], array_column($rcfa, 'id_peta')))) : ?>
                                            <a href="#" data-href="<?= base_url('peta/delete/' . $peta['id']) ?>" data-pic="<?= $peta['username']; ?>" data-id="<?= $peta['id']; ?>" data-problem="<?= $peta['problem']; ?>" class="btn btn-primary btn-rcfa">add Rcfa</a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th width=5%>No</th>
                                <th>Problem</th>
                                <th>Area</th>
                                <th>RCFA</th>
                                <th>PIC</th>
                                <th width=20%px>Action</th>
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
    <!--Modal tambah RCFA -->
    <form action="/peta/addrcfa" method="post">
        <div class="modal fade" id="rcfa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Problem</label>
                            <input type="text" class="form-control peta_problem" name="peta_problem" placeholder="Product Name">
                        </div>

                        <div class="form-group">
                            <label>PIC</label>
                            <input type="text" class="form-control pic" name="pic" placeholder="Product Price">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_peta" class="id_peta">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end Modal tambah RCFA -->

    <!--Modal Detail -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Problem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-header">
                            <span id="dproblem"></span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item row">

                                Area : <span id="darea"></span> ||
                                PIC : <span id="dpic"></span>

                            </li>
                            <li class="list-group-item">Pareto :
                                <ul class="list-group list-group-numbered ml-4">
                                    <span id="dpareto"></span>
                                </ul>
                            </li>
                            <li class="list-group-item">ID RCFA : <span id="drcfa"></span></li>
                            <li class="list-group-item">Status : <span id="dstatus"></span></li>
                        </ul>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_peta" class="id_peta">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->
<?= $this->endSection(); ?>