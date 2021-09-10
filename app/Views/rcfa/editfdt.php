<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/fdt/updatefdt/<?= $fdt['id']; ?>" class="formfdt" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit FDT</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" <?php echo (has_permission('rcfa')) ? '' : 'disabled'; ?> class="form-control " value="<?= $fdt['deskripsi']; ?>" placeholder="deskripsi" aria-describedby="helpId">
                        <div class="invalid-feedback errordeskripsi"></div>
                    </div>
                    <div class="form-group">
                        <label for="target">Target</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control datepicker-input" <?php echo (has_permission('rcfa')) ? '' : 'disabled'; ?> name="target" id="target" value="<?= $fdt['target']; ?>" data-target="#target" />
                            <div class="input-group-append" data-target="#target" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <div class="invalid-feedback errortarget"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_wo">No WO / IK / etc</label>
                        <input type="text" name="no_wo" id="no_wo" class="form-control" value="<?= $fdt['no_wo']; ?>" placeholder="no_wo" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="area">PIC</label>
                        <select class="form-control select2" name="id_pic" id="id_pic" style="width: 100%;" <?php echo (has_permission('rcfa')) ? '' : 'disabled'; ?>>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id; ?>" <?= ($user->id == $fdt['id_pic']) ? 'selected' : '' ?>><?= $user->username; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="progress">Progress</label>
                        <select class="form-control" name="progress" id="progress">
                            <option value="inprogress" <?= ($fdt['progress'] == 'inprogress') ? 'selected' : '' ?>>Inprogress</option>
                            <option value="finished" <?= ($fdt['progress'] == 'finished') ? 'selected' : '' ?>>Finished</option>
                            <option value="irrelevant" <?= ($fdt['progress'] == 'irrelevant') ? 'selected' : '' ?>>Irrelevant</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="implementasi">Implementasi</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control datepicker-input" name="implementasi" id="implementasi" value="<?= $fdt['implementasi']; ?>" data-target="#implementasi" />
                            <div class="input-group-append" data-target="#implementasi" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" value="" rows="3"><?= $fdt['keterangan']; ?></textarea>
                    </div>
                    <?php if (has_permission('rcfa') and $fdt['progress'] != 'inprogress' or has_permission('sub_admin')) { ?>
                        <div class="form-group">
                            <label for="validasi">Validasi</label>
                            <select class="form-control" name="validasi" id="validasi">
                                <option></option>
                                <option value="revisi" <?= ($fdt['validasi'] == 'revisi') ? 'selected' : '' ?>>Revisi</option>
                                <option value="close" <?= ($fdt['validasi'] == 'close') ? 'selected' : '' ?>>Close</option>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnsimpan">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#target').datetimepicker({
        format: 'YYYY-MM-DD',
    });
    $('#implementasi').datetimepicker({
        format: 'YYYY-MM-DD',
    });
    $(document).ready(function() {
        $('.formfdt').submit(function(e) {
            $('#deskripsi').prop('disabled', false);
            $('#target').prop('disabled', false);
            $('#id_pic').prop('disabled', false);
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled')
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');

                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable')
                    $('.btnsimpan').html('Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.deskripsi) {
                            $('#deskripsi').addClass('is-invalid');
                            $('.errordeskripsi').html(response.error.deskripsi);
                        } else {
                            $('#deskripsi').removeClass('is-invalid');
                            $('.errordeskripsi').html('');
                        }
                        if (response.error.target) {
                            $('#target').addClass('is-invalid');
                            $('.errortarget').html(response.error.target);
                        } else {
                            $('#target').removeClass('is-invalid');
                            $('.errortarget').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })
                        $('#modaledit').modal('hide');
                        datafdt();
                        updateDiv()
                    }
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
        })
    })
</script>