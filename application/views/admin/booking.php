
    <main class="app-content">
     <div class="app-title">
        <div>
          <h1><i class="fa fa-car"></i> Peminjaman</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-user fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Peminjaman</a></li>
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
                    <th>Id Booking</th>
                    <th>Atas Nama</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Mobil</th>
                    <th>Supir</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                foreach ($booking as $key => $u) {
                ?>
                  <tr>
                    <td><?=++$no?></td>
                    <td><?=$u->id_jadwal?></td>
                    <td><?=$u->nama_lengkap?></td>
                    <td><?=$u->tanggal?></td>
                    <td><?=date('Y-m-d', strtotime('+'.$u->lama_hari.' days', strtotime($u->tanggal)))?></td>
                    <td><img src="../<?=$u->gambar?>" style="width:100px"></td>
                    <td><?=$u->supir?></td>
                    <td><?=$u->status_jadwal?></td>
                    <td>
                      <a href="<?=base_url('admin/transaksiBook/'.$u->id_jadwal)?>">
                          <button class="btn btn-sm btn-info">Lihat Transaksi</button>
                      </a>
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
