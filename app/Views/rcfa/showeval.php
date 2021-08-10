<div class="modal fade" id="showeval" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Evaluasi</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php if(has_permission('rcfa')){ ?>
      <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="tambaheval('<?= $id ?>')"><i class="nav-icon fas fa-bars" > Tambah </i></button>
      <?php } ?>
      <div class="table-responsive">
      <table id="daftardft" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis(bulan)</th>
                        <th scope="col">Evaluasi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach( $eval as $evaluasi) : ?>
                    <tr>
                      <td>#</td>
                      <td><?= $evaluasi['jenis'] ?></td>
                      <td><?= $evaluasi['desc'] ?></td>
                      <td>
                      <?php if(has_permission('rcfa')){ ?>
                      <button class="btn btn-primary" type="button" onclick="editeval('<?= $evaluasi['id'];?>')"><i class="nav-icon fas fa-bars" ></i></button>
                      <button class="btn btn-danger" type="button" onclick="hapus('<?= $evaluasi['id'];?>')"><i class="nav-icon fas fa-trash" ></i></button>
                      <?php } ?>
                       </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
                            
      </div>
    </div>
  </div>
</div>
<script>
function tambaheval(id) {
    $.ajax({
        type: "post",
        url: "<?= base_url('fdt/formtambaheval');?>",
        data: {
            id : id
        },
        dataType: "json",
       beforeSend : function(){ 
        $('.modal').modal('hide');
        $('.modal-backdrop').remove()
       },
        success: function (response) {
            if(response.sukses){
                
                $('.viewmodal').html(response.sukses).show();
               
                $('#modaltambaheval').modal('show');
            }
        },
        error : function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
        }
    });
  }

  function editeval(id) {
    $.ajax({
        type: "post",
        url: "<?= base_url('fdt/formediteval');?>",
        data: {
            id : id
        },
        dataType: "json",
       beforeSend : function(){ 
        $('.modal').modal('hide');
        $('.modal-backdrop').remove()
       },
        success: function (response) {
            if(response.sukses){
                
                $('.viewmodal').html(response.sukses).show();
               
                $('#modalediteval').modal('show');
            }
        },
        error : function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
        }
    });
  }
  function hapus(id){
    Swal.fire({
    title: 'Hapus?',
    text: "Yakin akan hapus data ini?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    cancelButtonText:'Tidak'
    }).then((result) => {
        if(result.value){
            $.ajax({
            type: "post",
            url: "<?= base_url('fdt/hapuseval');?>",
            data: {
                id : id
            },
            dataType: "json",
            success: function (response) {
                if(response.sukses){
                    Swal.fire(
                    'Deleted!',
                    'Data berhasil dihapus.',
                    'success'
                    );
                    $('.modal').modal('hide');
                    $('.modal-backdrop').remove()
                datafdt();
                }
            },
            error : function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }

    })
  }
</script>