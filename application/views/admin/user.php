
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> User</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-user fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">User</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col col-md-12">
        <div class="card">
          <div class="card-body">
           <?php
            if($jenis!='customer'){
           ?>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Tambah Data</button>
           <?php } ?>
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
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tlp</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                foreach ($user as $key => $u) {
                $id = isset($u->id_admin)?$u->id_admin:$u->id_user;
                ?>
                  <tr>
                    <td><?=++$no?></td>
                    <td><?=$u->nik?></td>
                    <td><?=$u->nama_lengkap?></td>
                    <td><?=$u->email?></td>
                    <td><?=$u->tlp?></td>
                    <td><?=$u->alamat?></td>
                    <td>
                      <?php
                      if($u->nama_lengkap!='Admin'){
                      ?>
                      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModalEdit<?=$id?>">Edit</button>
                      <a href="<?=base_url('admin/delete/tbl_admin/'.$id)?>" onclick="return confirm('Apakah Anda Yakin?')"><button class="btn btn-sm btn-danger">Hapus</button></a>
                      <?php } ?>
                    </td>
                  </tr>

                  <div class="modal fade" id="myModalEdit<?=$id?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?=form_open_multipart('admin/editUser/'.$id.'/'.$jenis);?>
                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nik"  name="nik" value="<?=$u->nik?>" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nama" name="nama" value="<?=$u->nama_lengkap?>" placeholder="John Doe">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?=$u->tempat_lahir?>" placeholder="jakarta">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                              <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?=$u->tanggal_lahir?>" placeholder="19/02/1994">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="email" name="email" value="<?=$u->email?>" placeholder="email@example.com">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Telp</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="tlp" name="tlp" value="<?=$u->tlp?>" placeholder="08125678956">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="jenkel">
                                  <option value="">--Pilih Jenis Kelamin--</option>
                                  <option value="L" <?php if($u->jenkel=='L'){echo 'selected';}?>>Laki-laki</option>
                                  <option value="P" <?php if($u->jenkel=='P'){echo 'selected';}?>>Perempuan</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                              <img src="<?=base_url($u->foto)?>" style='width:20%;margin-bottom: 10px;'> 
                              <input type="file" class="form-control" id="gambar" name="gambar">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                              <textarea  class="form-control" id="alamat" name="alamat" ><?=$u->alamat?></textarea>
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

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <?=form_open_multipart('admin/tambahUser/'.$jenis);?>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nik"  name="nik" >
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="John Doe">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="jakarta">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="19/02/1994">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Telp</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="tlp" name="tlp" placeholder="08125678956">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select class="form-control" name="jenkel">
                      <option value="">--Pilih Jenis Kelamin--</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="Password" class="form-control" id="username" name="password" placeholder="Password">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="gambar" name="gambar">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea type="Password" class="form-control" id="alamat" name="alamat" ></textarea>
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
