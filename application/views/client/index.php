<?php
$judul = "RC Rental Mobil";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?=$judul?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?=base_url('assets/')?>img/favicon.png" rel="icon">
  <link href="<?=base_url('assets/')?>img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?=base_url('assets/')?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/')?>css/custom.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?=base_url('assets/')?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/')?>lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/')?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/')?>lib/owlcarousel/assets//owl.carousel.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/')?>lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="<?=base_url('assets/')?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?=base_url('assets/')?>css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">
  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="#body" class="scrollto"><?=$judul?></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="<?=base_url('assets/')?>img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#body">Beranda</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <!-- <li><a href="#services">Layanan</a></li> -->
          <li><a href="#portfolio">Foto</a></li>
          <li><a href="#team">Pengemudi</a></li>
          <!-- <li><a href="#testimonials">Testimoni</a></li> -->
          <?php
          if(isset($this->session->nik)){
          ?>
          <li class="menu-has-children"><a href=""><?=ucwords($this->session->nama_lengkap)?></a>
            <ul>
              <li><a href="#" data-toggle="modal" data-target="#myprofil">Profil Saya</a></li>
              <li><a href="#" data-toggle="modal" data-target="#myModalDataSaya">History Saya</a></li>
              <li ><a href="<?=base_url('client/logout')?>" style="color: red">Keluar</a></li>
            </ul>
          </li>
          <?php }else{ ?>
            <li><button class="btn btn-md btn-primary" data-target="#myModalLogin" data-toggle="modal"><i class="fa fa-user"> </i>Login</button></li>
          <?php } ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
<div class="modal fade" id="myModalDataSaya" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Data Saya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="table-responsive">  
                          <table class="table table-hover">
                            <thead>
                              <th>No</th>
                              <th>No Inv</th>
                              <th>Jml Hari</th>
                              <th>Tanggal Mulai</th>
                              <th>Tanggal Selesai</th>
                              <th>Mobil</th>
                              <th>Harga Mobil</th>
                              <th>Tagihan</th>
                              <th>Resi</th>
                            </thead>
                            <tbody>
                            <?php
                            $no=0;
                            foreach ($transaksi as $key => $t) {
                            ?>
                              <tr>
                                <td><?=++$no?></td>
                                <td><?=$t->no_invoice?></td>
                                <td><?=$t->lama_hari?></td>
                                <td><?=$t->tanggal?></td>
                                <td><?=date('Y-m-d', strtotime('+'.$t->lama_hari.' days', strtotime($t->tanggal)))?></td>
                                <td><?=$t->nama_mobil?></td>
                                <td><?=$t->harga?></td>
                                <td><?=$t->tagihan?></td>
                                <?php
                                if($t->resi==null){
                                ?>
                                <td>
                                <form action="<?=base_url('client/uploadResi/'.$t->id_transaksi)?>" enctype="multipart/form-data" method="POST">
                                  <input type="file" name="gambar" class="form-control">
                                  <button type="submit">Simpan</button>
                                </form>
                                </td>
                                <?php }else{ ?>
                                  <td><a href="<?=base_url($t->resi)?>" target="_blank">Lihat Resi</a></td>
                                <?php } ?>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>

          <div class="modal fade" id="myprofil" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Data Saya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?=form_open_multipart('client/editUser/'.$this->session->id_user.'/customer');?>
                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nik"  name="nik" value="<?=$this->session->nik?>" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nama" name="nama" value="<?=$this->session->nama_lengkap?>" placeholder="John Doe">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="email" name="email" value="<?=$this->session->email?>" placeholder="email@example.com">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Telp</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" id="tlp" name="tlp" value="<?=$this->session->tlp?>" placeholder="08125678956">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="jenkel">
                                  <option value="">--Pilih Jenis Kelamin--</option>
                                  <option value="L" <?php if($this->session->jenkel=='L'){echo 'selected';}?>>Laki-laki</option>
                                  <option value="P" <?php if($this->session->jenkel=='P'){echo 'selected';}?>>Perempuan</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                              <img src="<?=base_url($this->session->foto)?>" style='width:20%;margin-bottom: 10px;'> 
                              <input type="file" class="form-control" id="gambar" name="gambar">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                              <textarea  class="form-control" id="alamat" name="alamat" ><?=$this->session->alamat?></textarea>
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




    <!-- The Modal -->
  <div class="modal fade" id="myModalLogin">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <form action="<?=base_url('client/login')?>" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
          <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#myModalReg" style="font-size: 14px">Belum Punya Akun? Daftar Sekarang</a>
          </div>  
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" >Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModalReg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <!-- <form action="<?=base_url('client/addBooking')?>" enctype="multipart/form-data" method="POST"> -->
        <?=form_open_multipart('client/addBooking');?>
        <div class="modal-header">
          <h4 class="modal-title">Daftar</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row">
          <div class="form-group col-md-6">
            <label for="exampleInputEmail1">NIK<font color="red">*</font></label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="nik" aria-describedby="emailHelp" placeholder="Masukan NIK" required>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputPassword1">Nama Lengkap</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="nama" placeholder="Masukan Nama Lengkap" required>
          </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-6">
            <label for="exampleInputtemplah">Tempat Lahir</label>
            <input type="text" class="form-control" id="exampleInputtemplah" name="templahir" placeholder="Masukan Tempat Lahir" required>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputtanglah">Tanggal Lahir</label>
            <input type="date" class="form-control" id="exampleInputtanglah" name="tgllahir" placeholder="Masukan Tgl Lahir" required>
          </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-6">
            <label for="exampleInputtlp">Telp</label>
            <input type="text" class="form-control" id="exampleInputtlp" name="tlp" placeholder="Masukan Tlp Yang Bisa Dihubungi" required>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputmail">E-Mail</label>
            <input type="text" class="form-control" id="exampleInputmail" name="email" placeholder="Masukan Email Anda" required>
          </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-6">
            <label for="exampleInputPass">Password</label>
            <input type="password" class="form-control" id="exampleInputPass" name="password" placeholder="Masukan Email Anda" required>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputfoto">Foto</label>
            <input type="file" class="form-control" id="exampleInputfoto" name="gambar" placeholder="Masukan Email Anda" required>
          </div>
          </div>
          <div class="form-group">
            <label for="exampleInputalamat">Alamat</label>
            <textarea class="form-control" id="exampleInputalamat" name="alamat" placeholder="Masukan Alamat Anda" required></textarea>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </div>
    </form>
  </div>
  

<div align="center"> 
    <?php
      if($this->session->flashdata('notif')==true){
        echo $this->session->flashdata('notif');
      }
    ?>
</div>

  <section id="intro">

    <div class="intro-content">
      <h2>Sewa <span>Mobil</span><br>Paling Berkualitas di Tangsel!</h2>
      <div>
        <a href="#" data-toggle="modal" data-target="#myModal" class="btn-get-started scrollto">Pilih Paket</a>
        <a href="#" data-toggle="modal" data-target="#myModalharian" class="btn-get-started scrollto">Harian</a>
      </div>
    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('<?=base_url('assets/')?>img/intro-carousel/1.jpg');"></div>
      <div class="item" style="background-image: url('<?=base_url('assets/')?>img/intro-carousel/2.jpg');"></div>
      <div class="item" style="background-image: url('<?=base_url('assets/')?>img/intro-carousel/3.jpg');"></div>
      <div class="item" style="background-image: url('<?=base_url('assets/')?>img/intro-carousel/4.jpg');"></div>
      <div class="item" style="background-image: url('<?=base_url('assets/')?>img/intro-carousel/5.jpg');"></div>
    </div>

  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="https://image.freepik.com/free-vector/woman-character-driving_7562-145.jpg" style="width: 75%" alt="">
          </div>

          <div class="col-lg-6 content">
            <h2>Sekilas Tentang Kami</h2>
            <h3>Kami adalah tempat penyewaan mobil terbaik di Tangerang Selatan. Dengan mobil berkualitas dn terawat  .</h3>

            <!-- <ul>
              <li><i class="ion-android-checkmark-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="ion-android-checkmark-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="ion-android-checkmark-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
            </ul> -->

          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <!-- <section id="services">
      <div class="container">
        <div class="section-header">
          <h2>Pelayanan</h2>
          <p>Ada beberapa pelayanan yang akan kami berikan jika anda menggunakan jasa pelatihan mengemudi mobil <b>Tulus Jaya</b></p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="box wow fadeInLeft">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">Perkembangan Pesat</a></h4>
              <p class="description">Tulus Jaya memiliki Pelatih mengemudi yang handi dan berlisensi mengajar. Maka anda akan kami jamin akan bisa dalmm waktu yang cukup singkat.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight">
              <div class="icon"><i class="fa fa-car"></i></div>
              <h4 class="title"><a href="">Mobil yang prima</a></h4>
              <p class="description">Mobil yang digunakan pelatihan adalah mobil yang memiliki usia muda, dam memiliki kondisi yang prima, agar memudahkan anda dalam proses belajar.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-money"></i></div>
              <h4 class="title"><a href="">Harga yang terjangkau</a></h4>
              <p class="description">Tidak perlu khawatir dengan harga, karena harga yang kami tawarkan terjangkau serta berkualitas pelayanannya.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-certificate"></i></div>
              <h4 class="title"><a href="">Pengemudi yang bersertifikat</a></h4>
              <p class="description">Tidak perlu panik, pengemudi kami semuanya telah memiliki sertifikat mengemudi dan memenuhi standart sebagai driver.</p>
            </div>
          </div>

        </div>

      </div>
    </section> -->

    <!--==========================
      Our Portfolio Section
    ============================-->
    <section id="portfolio" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Mobil</h2>
          <p>Beberapa Mobil yang kami sediakan</p>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row no-gutters">

        <?php
        foreach ($mobil as $key => $m) {
        ?>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="<?=base_url().$m->gambar?>" class="portfolio-popup">
                <img src="<?=base_url().$m->gambar?>" alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp"><?=$m->nama_mobil?></h2></div>
                </div>
              </a>
            </div>
          </div>
        <?php } ?>

        </div>

      </div>
    </section><!-- #portfolio -->


     <section id="team" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Pengemudi</h2>
        </div>
        <div class="row">
          
          <?php
          foreach ($pengajar as $keys => $p) {
          ?>
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="<?=base_url().$p->foto?>" alt=""></div>
              <div class="details">
                <h4><?=$p->nama_lengkap?></h4>
                <span>Pengemudi</span>
                
              </div>
            </div>
          </div>
          <?php } ?>

          

      </div>
    </section><!-- #team -->


    <!--==========================
      Testimonials Section
    ============================-->
   <!--  <section id="testimonials" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Testimonial</h2>
          <p>Berikut testimoni dari para pelanggan kami</p>
        </div>
        <div class="owl-carousel testimonials-carousel">

            <div class="testimonial-item">
              <p>
                <img src="<?=base_url('assets/')?>img/quote-sign-left.png" class="quote-sign-left" alt="">
                Mobil Berkualitas.
                <img src="<?=base_url('assets/')?>img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="<?=base_url('assets/')?>img/testimonial-1.jpg" class="testimonial-img" alt="">
              <h3>Bambang</h3>
              <h4>Karyawan Swasta</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="<?=base_url('assets/')?>img/quote-sign-left.png" class="quote-sign-left" alt="">
                Driver Mengemudinya sangat lancar.
                <img src="<?=base_url('assets/')?>img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="<?=base_url('assets/')?>img/testimonial-2.jpg" class="testimonial-img" alt="">
              <h3>Sarah</h3>
              <h4>Designer</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="<?=base_url('assets/')?>img/quote-sign-left.png" class="quote-sign-left" alt="">
                Good Car!.
                <img src="<?=base_url('assets/')?>img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="<?=base_url('assets/')?>img/testimonial-3.jpg" class="testimonial-img" alt="">
              <h3>Wahyudi</h3>
              <h4>Petani Bawang</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="<?=base_url('assets/')?>img/quote-sign-left.png" class="quote-sign-left" alt="">
                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                <img src="<?=base_url('assets/')?>img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="<?=base_url('assets/')?>img/testimonial-4.jpg" class="testimonial-img" alt="">
              <h3>Matt Brandon</h3>
              <h4>Freelancer</h4>
            </div>

            <div class="testimonial-item">
              <p>
                <img src="<?=base_url('assets/')?>img/quote-sign-left.png" class="quote-sign-left" alt="">
                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                <img src="<?=base_url('assets/')?>img/quote-sign-right.png" class="quote-sign-right" alt="">
              </p>
              <img src="<?=base_url('assets/')?>img/testimonial-5.jpg" class="testimonial-img" alt="">
              <h3>John Larson</h3>
              <h4>Entrepreneur</h4>
            </div>

        </div>

      </div>
    </section> --><!-- #testimonials -->

<div class="modal fade" id="myModalharian">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Sewa Harian</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="<?=base_url('client/tambahPesan')?>" method="post">
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container">
              <div class="form-group">
                <label>Pilih Mobil yang tersedia</label>
                <select class="form-control" name="mobil" id="mobil" onchange="cekHarga(this.value)" required>
                  <option value="">--Pilih Mobil--</option>
                <?php
                 foreach ($cekmobil as $key => $c) {
                ?>
                  <option value=<?=$c->id_mobil?>""><?=$c->nama_mobil?></option>
                <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Mulai</label>
                <input type="date" class="form-control" name="tgl_book" id="txtDate">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" required></textarea>
                <?php
                if(isset($this->session->nik)){
                ?>  
                <input type="checkbox" id="cekAlamat">
                <label>Alamat sama dengan data anda</label>
                <?php } ?>
              </div>
              <div class="form-group">
                <button type="button" id="min">-</button>
                  <input type="text" style="width: 100px" value="0" name="qty" id="qty" >
                <button type="button" id="max">+</button>
              </div>
              <div class="form-group">
                <input type="checkbox" id="pengemudi" name="pengemudi">
                <label>Dengan Driver</label>
              </div>
              <hr>
              <input type="hidden" name="harga" id="harga" value="0">
              <input type="hidden" name="totalharga" id="totalharga" value="0">
              <h4 id="tampilHarga">Harga  : 0</h4>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <?php
          if(!isset($this->session->nik)){
              $alert ='Anda Harus Login Terlebih Dahhulu!';
              $click = "onclick=\"alert('$alert')\"";
          }else{
            $click ="type='submit'";
          }
          ?>
          <button <?=$click?> class="btn btn-success" >Simpan</button>
        </div>
       </form>
      </div>
    </div>
 </div>


  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pilih Paket</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row"> 
            <?php
            foreach ($paket as $keyx => $p) {
            $color = ($keyx%2==1)?"style='background-color:#4CAF50'":'';
            ?>  
              <div class="columns">
                <form method="POST" action="<?=base_url('client/tambahPesanPaket/'.$p->id_paket)?>">  
                <ul class="price">
                  <li class="header" <?=$color?>><?=$p->nama_paket?></li>
                  <li class="grey"><?='Rp. '.$p->harga_paket?></li>
                  <li>Pengemudi + <?=$p->nama_mobil?></li>
                  <li><?=$p->jml_hari?> Hari</li>
                  <li><input type="date" class="form-control date" name="tgl_book" id="txtDate" required></li>
                  <li class="grey"><button type="submit" class="btn btn-success">Pilih</button></li>
                </ul>
                </form>
              </div>
            <?php } ?>
          </div>  
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
 </div>

          <div class="modal fade" id="mypaket">
              <div class="modal-dialog modal-md">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title" id="judul"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <form action="<?=base_url('client/addBooking')?>" method="POST">
                  <div class="modal-body">
                    <div class="container"> 
                        <div class="row col col-md-10"> 
                           <div class="form-group">
                              <input type="hidden" name="paket" id="id_paket">
                              <label for="exampleInputnik1">NIK</label>
                              <input type="email" class="form-control" id="exampleInputnik1" name="email" aria-describedby="emailHelp" placeholder="Enter email" readonly>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputname1">Nama Lengkap</label>
                              <input type="password"  class="form-control" id="exampleInputname1" placeholder="password" readonly>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputname2">Nama Lengkap</label>
                              <select class="form-control"  id="exampleInputname2" name="mobil" style="width: 100%" required>
                                <option value="">--Pilih Mobil--</option>
                                <?php
                                foreach ($mobil as $keyq => $m1) {
                                ?>
                                <option value="<?=$m1->id_mobil?>"><?=$m1->nama_mobil?></option>
                                <?php } ?>
                              </select>
                            </div>


                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="$(this).prop('checked')==true?$('#submit').prop('disabled',false):$('#submit').prop('disabled',true);">
                              <label class="form-check-label" for="exampleCheck1">Apakah Data Anda Sudah Benar?</label>
                            </div>

                        </div>
                    </div>
                    
                    <div class="modal-footer">
                       <button type="submit" id="submit" class="btn btn-success" disabled>Submit</button>
                    </div>
                    </form>  
                  </div>

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><?=$judul?></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="<?=base_url('assets/')?>lib/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/easing/easing.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/superfish/hoverIntent.js"></script>
  <script src="<?=base_url('assets/')?>lib/superfish/superfish.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/wow/wow.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/sticky/sticky.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="<?=base_url('assets/')?>contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?=base_url('assets/')?>js/main.js"></script>

<script>
  var hargaSupir=parseInt(125000);

  $("#cekAlamat").click(function(){
  if($(this).prop('checked')==true){
    $("#alamat").val("<?=$this->session->alamat?>");
  }else{
    $("#alamat").val("");
  }
  });
  

  $("#min").click(function(){
  var qty = $("#qty").val();
    var qtyNew = qty-1;
    if(qtyNew==0){
      $("#min").hide();
    }
    $("#qty").val(qtyNew);
    var total = parseInt($("#harga").val())*parseInt(qtyNew);
    
    if($(this).prop('checked')==true){
    var hargaTotal = parseInt(total)+hargaSupir;
    }else{
    var hargaTotal = parseInt(total-hargaSupir);
    }

    $("#totalharga").val(parseInt(total));
    $( "#tampilHarga" ).html( "Harga : "+total );;
  });

  $("#max").click(function(){
    var qty = $("#qty").val();
    var qtyNew2 = parseInt(qty)+1;
    var total = parseInt($("#harga").val())*parseInt(qtyNew2);
    if(qtyNew2 > 0){
      $("#min").show();
    }

    if($(this).prop('checked')==true){
    var hargaTotal = parseInt(total)+hargaSupir;
    }else{
    var hargaTotal = parseInt(total-hargaSupir);
    }

    $("#qty").val(qtyNew2);
    $("#totalharga").val(parseInt(total));
    $( "#tampilHarga" ).html( "Harga : "+total);
  });

function cekHarga(id_mobil){
$.post( "<?=base_url('client/showHarga')?>",{id_mobil:id_mobil}, function( data ) {
  if($("#pengemudi").prop("checked")==true){
    data  = parseInt(data)+hargaSupir; 
  }
  $( "#tampilHarga" ).html( "Harga : "+data );
  $("#harga").val(data)
  $("#totalharga").val(parseInt(data));
  // alert(data);
});
}

$("#pengemudi").click(function(){
if($(this).prop('checked')==true){
var hargaTotal = parseInt($("#totalharga").val())+hargaSupir;
}else{
var hargaTotal = parseInt($("#totalharga").val()-hargaSupir);
}
$( "#tampilHarga" ).html( "Harga : "+hargaTotal );
$("#totalharga").val(parseInt(hargaTotal));
});




$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var minDate= year + '-' + month + '-' + day;
    
    $('#txtDate').attr('min', minDate);
});

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var minDate= year + '-' + month + '-' + day;
    
    $('.date').attr('min', minDate);
});

</script>
</body>
</html>
