<table id="daftarpeta" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width=5%>No</th>
                                <th>Problem</th>
                                <th>Area</th>
                                <th>Nomor RCFA</th>
                                <th>PIC</th>
                                <th>Tanggal Create</th>
                                
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php



$n = 1; ?>
                            <?php foreach ($petas as $peta) : ?>
                                <tr>
                                    <td><?= $n++; ?> </td>
                                    <td><?= $peta['problem'] ?></td>
                                    <td><?= $peta['area'] ?></td>
                                    <td><?= $peta['rcfa'] ?></td>
                                    <td><?= $peta['username'] ?></td>
                                    <td><?php $tanggal = strtotime($peta['created_at']);
                                echo ($peta['created_at'] == null) ? '' : date('d-M-Y', $tanggal); ?></td>
                                    
                                    <td>
                                        <?= 
                                             $peta['status'] ? 'Close' :'open';
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
                                
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
<script>
$(document).ready(function(){
        $('#daftarpeta').DataTable();
    });
</script>