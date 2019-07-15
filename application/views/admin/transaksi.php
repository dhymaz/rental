
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><i class="fa fa-money"></i> Transaksi</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-user fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
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
            <div class="form-group">
              <label>Bulan</label>
              <select class="form-control" name="bulan" style="width: 200px" id="bulan">
                <option value="0" <?=($bulan==0)?'selected':''?>>Tampilkan Semua</option>
                <option value="1" <?=($bulan==1)?'selected':''?>>Jan</option>
                <option value="2" <?=($bulan==2)?'selected':''?>>Feb</option>
                <option value="3" <?=($bulan==3)?'selected':''?>>Mar</option>
                <option value="4" <?=($bulan==4)?'selected':''?>>Apr</option>
                <option value="5" <?=($bulan==5)?'selected':''?>>Mei</option>
                <option value="6" <?=($bulan==6)?'selected':''?>>Jun</option>
                <option value="7" <?=($bulan==7)?'selected':''?>>Jul</option>
                <option value="8" <?=($bulan==8)?'selected':''?>>Agust</option>
                <option value="9" <?=($bulan==9)?'selected':''?>>Sept</option>
                <option value="10" <?=($bulan==10)?'selected':''?>>Okt</option>
                <option value="11" <?=($bulan==11)?'selected':''?>>Nov</option>
                <option value="12" <?=($bulan==12)?'selected':''?>>Des</option>
              </select>
            </div>
            <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No INV</th>
                    <th>ID Booking</th>
                    <th>Resi</th>
                    <th>Tagihan</th>
                    <th>Waktu Upload</th>
                    <th>Waktu Approve</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                if(!isset($link)){
                foreach ($booking as $key => $u) {
                // var_dump($booking);
                ?>
                  <tr>
                    <td><?=++$no?></td>
                    <td><?=$u->no_invoice?></td>
                    <td><?=$u->id_jadwal?></td>
                    <?php
                    $resigambar = explode('/', $u->resi);
                    if(isset($resigambar[4])){
                    ?>
                    <td><a href="<?=base_url($u->resi)?>" target="_blank"><?=$resigambar[4]?></a></td>
                    <?php }elseif($u->waktu_approve==null && $u->res==null){ ?>
                    <td><font color="red">Resi Belum diupload</font></td>
                    <?php }else{?>
                    <td><font color="green">Bayar Cash</font></td>
                    <?php } ?>
                    <td><?=$u->tagihan?></td>
                    <td><?=$u->waktu_upload?></td>
                    <td><?=$u->waktu_approve?></td>
                    <td>
                      <?php
                      if(isset($u->resi) && $u->waktu_approve==null){
                      ?>
                      <a href="<?=base_url('admin/approveResi/'.$u->id_transaksi)?>" onclick="return confirm('Apakahkah anda Yakin akan Approve ini?')"><button class="btn btn-sm btn-success">Approve</button></a>
                      <?php
                      }elseif($u->waktu_approve==null){
                      ?>
                      <a href="<?=base_url('admin/selesaiBook/'.$u->id_jadwal)?>" onclick="return confirm('Apakahkah anda Yakin akan menyelesaikan pinjaman ini?')"><button class="btn btn-sm btn-danger">Selesai</button></a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php 
                  }
                }else{ 
                ?>
                <tr>
                    <td><?=++$no?></td>
                    <td><?=$booking->no_invoice?></td>
                    <td><?=$booking->id_jadwal?></td>
                    <?php
                    $resigambar = explode('/', $booking->resi);
                    if(isset($resigambar[4])){
                    ?>
                    <td><a href="<?=base_url($booking->resi)?>" target="_blank"><?=$resigambar[4]?></a></td>
                    <?php }else{ ?>
                    <td><font color="red">Resi Belum diupload</font></td>
                    <?php } ?>
                    <td><?=$booking->tagihan?></td>
                    <td><?=$booking->waktu_upload?></td>
                    <td><?=$booking->waktu_approve?></td>
                    <td>
                        <?php
                        if(isset($booking->resi)){
                      ?>
                      <a href="<?=base_url('admin/approveResi/'.$booking->id_transaksi)?>" onclick="return confirm('Apakahkah anda Yakin akan Approve ini?')"><button class="btn btn-sm btn-success">Approve</button></a>
                      <?php
                      }else{
                      ?>
                      <a href="<?=base_url('admin/selesaiBook/'.$booking->id_jadwal)?>" onclick="return confirm('Apakahkah anda Yakin akan menyelesaikan pinjaman ini?')"><button class="btn btn-sm btn-danger">Selesai</button></a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
          </div>
        </div>
        </div>
      </div>


    </main>
