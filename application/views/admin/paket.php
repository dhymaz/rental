
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Paket</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-user fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Paket</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col col-md-12">
        <div class="card">
          <div class="card-body">
            <!-- <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModalAdd"><i class="fa fa-plus"></i>Tambah Data</button> -->
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
                    <th>Nama Paket</th>
                    <th>Lama Hari</th>
                    <th>mobil</th>
                    <th>Harga</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                foreach ($paket as $key => $u) {
                ?>
                  <tr>
                <?=form_open_multipart('admin/edit_paket/'.$u->id_mobil);?>  
                    <td><?=++$no?></td>
                    <td>
                      <input type="type" name="nama_paket" value="<?=$u->nama_paket?>" class="form-control">
                    </td>
                    <td>
                      <input type="number" name="jml_hari" value="<?=$u->jml_hari?>"  class="form-control">
                    </td>
                    <td>
                      <select name="id_mobil" class="form-control">
                        <option value="">--Pilih Mobil--</option>
                        <?php
                        foreach($mobil as $key => $m) {
                        ?>
                        <option value="<?=$m->id_mobil?>" <?=($m->id_mobil==$u->id_mobil)?'selected':'';?>><?=$m->nama_mobil?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td>
                      <input type="number" name="harga_paket" value="<?=$u->harga_paket?>" class="form-control">
                    </td>
                    <td>
                      <button  type="submit" class="btn btn-sm btn-info">Selesai Edit</button>
                      <a href="<?=base_url('admin/delete/tbl_paket/'.$u->id_paket)?>" onclick="return confirm('Apakah Anda Yakin?')"><button type="button" class="btn btn-sm btn-danger">Hapus</button></a>
                    </td>
                  </form>
                  </tr>
                <?php } ?>
                  <tr>
                    <?=form_open_multipart('admin/add_paket/');?>  
                    <td>  </td>
                    <td>
                      <input type="type" name="nama_paket"  class="form-control">
                    </td>
                    <td>
                      <input type="number" name="jml_hari"   class="form-control">
                    </td>
                    <td>
                      <select name="id_mobil" class="form-control">
                        <option value="">--Pilih Mobil--</option>
                        <?php
                        foreach($mobil as $key => $m) {
                        ?>
                        <option value="<?=$m->id_mobil?>"><?=$m->nama_mobil?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td>
                      <input type="number" name="harga_paket" class="form-control">
                    </td>
                    <td>
                      <button  type="submit" class="btn btn-sm btn-success">Tambah</button>
                    </td>
                  </form>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
        </div>
      </div>



    </main>
