<div class="modal fade" id="modalediteval" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url(); ?>/fdt/updateeval/<?= $eval['id']; ?>" class="formfdt" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah FDT</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="progress">Jenis</label>
                            <select class="form-control" name="jenis" id="jenis">
                                <option value="3" <?= ($eval['jenis'] == 3) ? 'selected' : '' ?>>3 bulan</option>
                                <option value="6" <?= ($eval['jenis'] == 6) ? 'selected' : '' ?>>6 bulan</option>
                                <option value="12" <?= ($eval['jenis'] == 12) ? 'selected' : '' ?>>12 bulan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="desc" id="desc" rows="3"><?= $eval['desc'] ?></textarea>
                        
                            <div class="invalid-feedback errordeskripsi"></div>
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
    $(document).ready(function(){
        $('.formfdt').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend : function(){
                    $('.btnsimpan').attr('disable','disabled')
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete:function(){
                    $('.btnsimpan').removeAttr('disable')
                    $('.btnsimpan').html('simpan');
                },
                success: function (response) {
                    if(response.error){
                        if(response.error.deskripsi){
                            $('#deskripsi').addClass('is-invalid');
                            $('.errordeskripsi').html(response.error.deskripsi);
                        }else{
                            $('#deskripsi').removeClass('is-invalid');
                            $('.errordeskripsi').html('');
                        }
                        if(response.error.target){
                            $('#target').addClass('is-invalid');
                            $('.errortarget').html(response.error.target);
                        }else{
                            $('#target').removeClass('is-invalid');
                            $('.errortarget').html('');
                        }
                    }else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                            })
                        $('#modalediteval').modal('hide');
                        
                        datafdt();
                    }
                },
                error : function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
            });
        })
    })
    </script>