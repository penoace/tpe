<table id="daftarpeta" class="table table-bordered table-hover">
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
                                        <a href="#" onclick="detail('<?= $peta['id']; ?>','<?= $peta['username']; ?>','<?= $peta['problem']; ?>','<?= $peta['area']; ?>','<?= $peta['status']; ?>','<?= $peta['rcfa']; ?>' )" data-pareto="<?= $peta['pareto']; ?>" data-rcfa="<?= $peta['rcfa']; ?>" data-status="<?= $peta['status']; ?>" data-area="<?= $peta['area']; ?>" data-pic="<?= $peta['username']; ?>" data-id="<?= $peta['id']; ?>" data-problem="<?= $peta['problem']; ?>" class="btn btn-primary btn-detail">Detail</a>
                                        <?php if(has_permission('rcfa') ){ ?>
                                        <a href="<?= base_url('peta/edit/' . $peta['id']); ?>" class="btn btn-info">Edit</a>
                                         <?php }; ?>
                                         <?php if(has_permission('sub_admin') ){ ?>
                                        <a href="#" data-href="<?= base_url('peta/delete/' . $peta['id']) ?>" onclick="confirmToDelete(this)" class="btn btn-danger">Delete</a>
                                        <?php }; ?>
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
<script>
$(document).ready(function(){
        $('#daftarpeta').DataTable();
    });
</script>