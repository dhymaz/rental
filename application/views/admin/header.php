<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Administrator</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/admin/')?>css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Admin</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!--Notification Menu-->
        
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?=$this->session->nama_lengkap?></p>
          <p class="app-sidebar__user-designation"><?=$this->session->jenkel?></p>
        </div>
      </div>

      <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.html"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">User</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?=base_url('admin/lihatUser/admin')?>"><i class="icon fa fa-circle-o"></i> Admin</a></li>
            <li><a class="treeview-item" href="<?=base_url('admin/lihatUser/supir')?>"><i class="icon fa fa-circle-o"></i> Supir</a></li>
            <li><a class="treeview-item" href="<?=base_url('admin/lihatUser/customer')?>"><i class="icon fa fa-circle-o"></i> Customer</a></li>
          </ul>
        </li>
        <li><a class="app-menu__item" href="<?=base_url('admin/booking')?>"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Booking</span></a></li>
        <li><a class="app-menu__item" href="<?=base_url('admin/transaksi')?>"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Transaksi</span></a></li>
        <li><a class="app-menu__item" href="<?=base_url('admin/paket')?>"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Paket</span></a></li>
        <li><a class="app-menu__item" href="<?=base_url('admin/lihatMobil')?>"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">Mobil</span></a></li>
        <li><a class="treeview-item" href="<?=base_url('admin/logout')?>"><i class="icon fa fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </aside>