<table id="daftarrcfa" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width=5%>No</th>
                                <th>Problem</th>
                                <th>Area</th>
                                <th>Nomor RCFA</th>
                                <th>PIC</th>
                                <th>Tanggal Create</th>
                                <th>Tanggal Workshop</th>
                                <th>Status</th>
                                <th width=20%px>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php



$n = 1; ?>
                            <?php foreach ($rcfas as $rcfa) : ?>
                                <tr>
                                    <td><?= $n++; ?> </td>
                                    <td><?= $rcfa['problem'] ?></td>
                                    <td><?= $rcfa['area'] ?></td>
                                    <td><?= $rcfa['rcfa'] ?></td>
                                    <td><?= $rcfa['username'] ?></td>
                                    <td><?php $tanggal = strtotime($rcfa['created_at']);
                                echo ($rcfa['created_at'] == null) ? '' : date('d-M-Y', $tanggal); ?></td>
                                    <td><?php $tanggal = strtotime( $rcfa['workshop']);
                                echo ( $rcfa['workshop'] == null) ? '' : date('d-M-Y', $tanggal); ?></td>
                                    <td>
                                        <?= 
                                             checkfdt($rcfa['id']) ? 'Close' :'open';
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <a href="<?= base_url('rcfa/detail/' . $rcfa['id']); ?>" class="btn btn-primary">Detail</a>
                                        <?php if(has_permission('sub_admin') or (user()->id == $rcfa['id_pic']) ){   ?>
                                        <a href="<?= base_url('rcfa/edit/' . $rcfa['id']); ?>" class="btn btn-info">Edit</a>
                                        <?php } ?>
                                        <?php if(has_permission('sub_admin')){ ?>
                                        <a href="#" data-href="<?= base_url('rcfa/delete/' . $rcfa['id']) ?>" onclick="confirmToDelete(this)" class="btn btn-danger">Delete</a>
                                        <?php } ?>
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
                                <th>Tanggal Create</th>
                                <th>Tanggal Workshop</th>
                                <th>Status</th>
                                <th width=20%px>Action</th>
                            </tr>
                        </tfoot>
                    </table>
<script>
$(document).ready(function(){
        $('#daftarrcfa').DataTable();
    });
</script>