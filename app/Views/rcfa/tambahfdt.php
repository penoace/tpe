<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/fdt/simpanfdt/<?= $rcfa['id']; ?>" class="formfdt" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah FDT</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control " placeholder="deskripsi" aria-describedby="helpId">
                        <div class="invalid-feedback errordeskripsi"></div>
                    </div>
                    <div class="form-group">
                        <label for="target">Target</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="target" id="target" data-target="#target" />
                            <div class="input-group-append" data-target="#target" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <div class="invalid-feedback errortarget"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_wo">No WO / IK / etc</label>
                        <input type="text" name="no_wo" id="no_wo" class="form-control" placeholder="no_wo" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="area">PIC</label>
                        <select class="form-control select2" name="id_pic" style="width: 100%;">
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id; ?>"><?= $user->username; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="progress">Progress</label>
                        <select class="form-control" name="progress" id="progress">
                            <option value="inprogress">Inprogress</option>
                            <option value="finished">Finished</option>
                            <option value="irrelevant">Irrelevant</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="implementasi">Implementasi</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="implementasi" id="implementasi" data-target="#implementasi" />
                            <div class="input-group-append" data-target="#implementasi" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                    </div>
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
    $(document).ready(function() {
        $('.formfdt').submit(function(e) {
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
                    $('.btnsimpan').html('simpan');
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
                        $('#modaltambah').modal('hide');
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