
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Mobil</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-user fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Mobil</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col col-md-12">
        <div class="card">
          <div class="card-body">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalAdd"><i class="fa fa-plus"></i>Tambah Data</button>
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
                    <th>Nama Mobil</th>
                    <th>Jenis</th>
                    <th>Tahun Keluar</th>
                    <th>Gambar</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                foreach ($mobil as $key => $u) {
                ?>
                  <tr>
                    <td><?=++$no?></td>
                    <td><?=$u->nama_mobil?></td>
                    <td><?=$u->jenis?></td>
                    <td><?=$u->tahun_keluar?></td>
                    <td><img src="../<?=$u->gambar?>" style="width:100px"></td>
                    <td>
                      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModalEdit<?=$u->id_mobil?>">Edit</button>
                      <a href="<?=base_url('admin/delete/tbl_mobil/'.$u->id_mobil)?>" onclick="return confirm('Apakah Anda Yakin?')"><button class="btn btn-sm btn-danger">Hapus</button></a>
                    </td>
                  </tr>

                  <div class="modal fade" id="myModalEdit<?=$u->id_mobil?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <?=form_open_multipart('admin/edit_mobil/'.$u->id_mobil);?>
                          <!-- <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nik"  name="nik" value="<?=$u->id_mobil?>" >
                            </div>
                          </div> -->
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nama" name="nama" value="<?=$u->nama_mobil?>" placeholder="John Doe">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jenis</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="jenis">
                                <option value="AT" <?=($u->jenis=='AT')?'selected':''?>>AT</option>
                                <option value="MT" <?=($u->jenis=='MT')?'selected':''?>>MT</option>
                              </select>
                              <!-- <input type="text" class="form-control" id="tempat_lahir" name="jenis" value="<?=$u->jenis?>" placeholder="jakarta"> -->
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="tgl_lahir" name="tahun" value="<?=$u->tahun_keluar?>" placeholder="19/02/1994">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="tlp" name="harga" value="<?=$u->harga?>" placeholder="08125678956">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                              <img src="<?=base_url($u->gambar)?>" style='width:20%;margin-bottom: 10px;'> 
                              <input type="file" class="form-control" id="gambar" name="gambar">
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
          </div>
        </div>
        </div>
      </div>


      <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?=form_open_multipart('admin/add_mobil/');?>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nama" name="nama"  placeholder="John Doe">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jenis</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="jenis">
                                <option value="AT" >AT</option>
                                <option value="MT" >MT</option>
                              </select>
                              <!-- <input type="text" class="form-control" id="tempat_lahir" name="jenis" value="<?=$u->jenis?>" placeholder="jakarta"> -->
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="tgl_lahir" name="tahun"  placeholder="2019">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="tlp" name="harga"  placeholder="ex:500000">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" id="gambar" name="gambar">
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

    </main>
