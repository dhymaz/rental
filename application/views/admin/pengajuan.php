
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
            <!-- <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Tambah Data</button> -->
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
                    <th>Type</th>
                    <th>Status</th>
                    <th>Tgl Pengajuan</th>
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
                    <td><?=$u->nik?></td>
                    <td><?=$u->nama_lengkap?></td>
                    <td><?=$u->jenis_pengajuan?></td>
                    <td><?=$u->status?></td>
                    <td><?=$u->tgl_create?></td>
                    <td>
                      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#myModalEdit<?=$u->id_pengajuan?>">Detail</button>
                      <?php
                      if($u->status=='menunggu' ){
                      ?>
                      <a href="<?=base_url('admin/reject_pengajuan/'.$u->id_pengajuan)?>" onclick="return confirm('Apakah Anda Yakin?')"><button class="btn btn-sm btn-danger">Tolak Pengajuan</button></a>
                      <?php } ?>
                    </td>
                  </tr>

                  <div class="modal fade" id="myModalEdit<?=$u->id_pengajuan?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Detail Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?=form_open_multipart('admin/approve_pengajuan/'.$u->id_pengajuan);?>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">NIK</label>
                          <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" name="nik"  id="staticEmail" value="<?=$u->nik?>">
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Lengkap</label>
                          <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?=$u->nama_lengkap?>">
                          </div>
                        </div>            
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Pengajuan</label>
                          <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?=$u->jenis_pengajuan?>">
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Alasan</label>
                          <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?=$u->alasan?>">
                          </div>
                        </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Tgl Pengajuan</label>
                          <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?=$u->tgl_create?>">
                          </div>
                        </div>
                        <?php
                        if($u->status=='menunggu'){
                        ?>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Upload File</label>
                          <div class="col-sm-10">
                            <input type="file" readonly class="form-control" name="gambar">
                          </div>
                        </div>
                       <?php }else{ ?>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-10">
                              <font color="red"> <b><?=$u->status?></b></font>
                          </div>
                        </div>
                       <?php } ?>

                      </div>
                      <div class="modal-footer">
                        <?php
                        if($u->status=='menunggu'){
                        ?>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <?php } ?>
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

<!--       <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <?=form_open_multipart('admin/add_user/'.$type);?>
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
      </div> -->
    </div>
    </main>
