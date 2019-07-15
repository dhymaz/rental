  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea',menubar:false});</script>
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Pengajuan</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-file fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Pengajuan</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col col-md-12">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Tambah Data</button>
          </div>
          <div class="card-body">
            <?php
            if($this->session->flashdata('notif') == TRUE){
              echo $this->session->flashdata('notif');
            }
            ?>
            <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Dibuat Oleh</th>
                    <th>Waktu</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                foreach ($data->result() as $key => $u) {
                ?>
                  <tr>
                    <td><?=++$no?></td>
                    <td><?=$u->judul_gambar?></td>
                    <td><?=$u->create_by?></td>
                    <td><?=$u->create_date?></td>
                    <td>
                      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModalEdit<?=$u->id_gambar?>">Detail</button>
                      <a href="<?=base_url('admin/delete/tbl_gambar/'.$u->id_gambar)?>" onclick="return confirm('Apakah Anda Yakin?')"><button class="btn btn-sm btn-danger">Hapus</button></a>
                    </td>
                  </tr>

                  <div class="modal fade" id="myModalEdit<?=$u->id_gambar?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Detail Gambar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?=form_open_multipart('admin/edit_gambar/'.$type.'/'.$u->id_gambar);?>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                          <div class="col-sm-10">
                            <input type="text"  class="form-control" name="judul"  id="staticEmail" value="<?=$u->judul_gambar?>">
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Jenis</label>
                          <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" name="jenis" id="staticEmail" value="<?=$type?>">
                          </div>
                        </div>            
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">deskripsi</label>
                          <div class="col-sm-10">
                              <textarea name="deskripsi" class="form-control" id="deskripsi"><?=$u->deskripsi?></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Upload File</label>
                          <div class="col-sm-10">
                            <?php
                              if($type == 'slide'){
                            ?>
                            <img src="<?=base_url('assets/'.$type.'/'.$u->gambar)?>" style="width:200px"><br>
                            <?php
                              }elseif($type == 'galeri'){
                            ?>
                            <img src="<?=base_url('assets/galeri/'.$u->judul_gambar)?>" style="width:200px"><br>
                            <?php }else{ ?>
                              <img src="<?=base_url('assets/'.$type.'/'.$u->gambar)?>" style="width:200px"><br>
                            <?php } ?>
                            <input type="file" readonly class="form-control" name="gambar">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>


                <?php } ?>
                </tbody>
              </table>

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Gambar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?=form_open_multipart('admin/add_gambar/'.$type);?>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                          <div class="col-sm-10">
                            <input type="text"  class="form-control" name="judul"  id="staticEmail">
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Jenis</label>
                          <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" name="jenis" id="staticEmail" value="<?=$type?>">
                          </div>
                        </div>            
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Berita</label>
                          <div class="col-sm-10">
                              <textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Upload File</label>
                          <div class="col-sm-10">
                            <input type="file" readonly class="form-control" name="gambar">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>



          </div>
        </div>
        </div>
      </div>

    </div>
    </main>
