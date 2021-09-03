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
                            </tr>
                        </tfoot>
                    </table>
<script>
$(document).ready(function(){
        $('#daftarrcfa').DataTable();
    });
</script>