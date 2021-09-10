<table id="daftardft" class="table table-hover table-responsive-sm">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Target</th>
            <th scope="col">WO/IK/etc</th>
            <th scope="col">PIC</th>
            <th scope="col">Status</th>
            <th scope="col">Implementasi</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $n = 1; ?>
        <?php foreach ($fdt as $fdtt) : ?>
            <tr>
                <th scope="row"><?= $n++; ?></th>
                <td><?= $fdtt['deskripsi']; ?></td>
                <td><?php $tanggal = strtotime($fdtt['target']);
                    echo ($fdtt['target'] == null) ? '' : date('d-M-Y', $tanggal); ?></td>
                <td><?= $fdtt['no_wo']; ?></td>
                <td><?= $fdtt['username']; ?></td>
                <td>
                    <?php
                    if ($fdtt['progress'] == 'finished' or $fdtt['progress'] == 'irrelevant') {
                        if (is_null($fdtt['validasi']) or $fdtt['validasi'] == '') {
                            echo "Tunggu Validasi(" . $fdtt['progress'] . ")";
                        } else {
                            echo $fdtt['validasi'] . "(" . $fdtt['progress'] . ")";
                        }
                    } else {
                        echo $fdtt['progress'];
                    }

                    ?>
                </td>
                <td><?php $tanggal = strtotime($fdtt['implementasi']);
                    echo ($fdtt['implementasi'] == '0000-00-00 00:00:00') ? '' : date('d-M-Y', $tanggal); ?></td>
                <td><?= $fdtt['keterangan']; ?></td>
                <td>
                    <?php
                    if (($fdtt['validasi'] != "close") or has_permission('sub_admin')) {
                        if (user()->id == $fdtt['id_pic'] or has_permission('sub_admin') or (has_permission('rcfa') and user()->id == $rcfa['picrcfa'])) { ?>
                            <button class="btn btn-primary" type="button" onclick="edit('<?= $fdtt['id']; ?>')"><i class="nav-icon fas fa-bars"></i></button>
                    <?php }
                    } ?>
                    <?php if (has_permission('rcfa')) { ?>
                        <button class="btn btn-danger" type="button" onclick="hapus('<?= $fdtt['id']; ?>')"><i class="nav-icon fas fa-trash"></i></button>
                    <?php } ?>
                    <button class="btn btn-info" type="button" onclick="evaluasi('<?= $fdtt['id']; ?>')"><i class="nav-icon fas fa-paperclip"></i></button>

                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#daftardft').DataTable();
    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('fdt/formedit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {

                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                    datafdt();
                    updateDiv();
                }
            },
            error: function(xhr, ajaxOptions, throwError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }

    function evaluasi(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('fdt/showeval'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {

                    $('.viewmodal').html(response.sukses).show();
                    $('#showeval').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, throwError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus?',
            text: "Yakin akan hapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('fdt/hapus'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            datafdt();
                            updateDiv();
                        }
                    },
                    error: function(xhr, ajaxOptions, throwError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                });
            }

        })
    }
</script>