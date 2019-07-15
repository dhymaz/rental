<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('general_model');
		// $this->load->libs('Libs');
		$this->load->library('user_agent');
		date_default_timezone_set('Asia/Jakarta');
	}

public function index(){
	if(isset($this->session->id_user)){
		$admin = $this->general_model->getAll('tbl_admin')->num_rows();
		$user = $this->general_model->getAll('tbl_customer')->num_rows();
		$data['count_user'] = $admin+$user;
		$data['count_mobil'] = $this->general_model->getAll('tbl_mobil')->num_rows();
		$data['count_transaksi'] = $this->general_model->getAll('tbl_transaksi')->num_rows();
		$data['count_transaksi_ok'] = $this->general_model->getWhere('tbl_jadwal',['status_jadwal'=>'ok'])->num_rows();
		$this->load->view('admin/header');
		$this->load->view('admin/index',$data);
		$this->load->view('admin/footer');	
	}else{
		$this->load->view('admin/page-login');
	}
}

function lihatUser($jenis){
	if($jenis=='customer'){
		$data['user'] = $this->general_model->getAll('tbl_customer')->result();
	}else{
		$data['user'] = $this->general_model->getwhere('tbl_admin',['tipe'=>$jenis])->result();
	}
	$data['jenis'] = $jenis;
	$this->load->view('admin/header');
	$this->load->view('admin/user',$data);
	$this->load->view('admin/footer');
}

function lihatMobil(){
	$data['mobil'] = $this->general_model->getAll('tbl_mobil')->result();
	$this->load->view('admin/header');
	$this->load->view('admin/mobil',$data);
	$this->load->view('admin/footer');
}

function booking(){
	$data['booking'] = $this->general_model->getSpesificWhereJoin(['*'],['tbl_jadwal','tbl_customer','tbl_mobil'],['tbl_jadwal.id_penyewa=tbl_customer.id_user','tbl_jadwal.id_mobil=tbl_mobil.id_mobil'],'inner',[])->result();
	// echo $this->db->last_query();die;
	$this->load->view('admin/header');
	$this->load->view('admin/booking',$data);
	$this->load->view('admin/footer');	
}

function paket(){
	$data['paket'] = $this->general_model->getAll('tbl_paket')->result();
	$data['mobil'] = $this->general_model->getAll('tbl_mobil')->result();
	// echo $this->db->last_query();die;
	$this->load->view('admin/header');
	$this->load->view('admin/paket',$data);
	$this->load->view('admin/footer');	
}

function edit_paket($id){
	$data_input = array(
		'nama_paket' => $this->input->post('nama_paket'),
		'harga_paket' => $this->input->post('harga_paket'),
		'jml_hari' => $this->input->post('jml_hari'),
		'id_mobil' => $this->input->post('id_mobil')
	);
	$sql = $this->general_model->updateWhereData('tbl_paket',$data_input,['id_paket'=>$id]);
	if($sql){
		 $this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Data Berhasil diinput.'));
		// redirect(base_url('admin/lihatmobil'));
		 redirect(base_url('admin/paket'));
	}else{
	     $this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong> Data Gagal dinput.'));
		// redirect(base_url('admin/lihatmobil'));
		redirect(base_url('admin/paket'));
	}
}

function add_paket(){
	$data_input = array(
		'nama_paket' => $this->input->post('nama_paket'),
		'harga_paket' => $this->input->post('harga_paket'),
		'jml_hari' => $this->input->post('jml_hari'),
		'id_mobil' => $this->input->post('id_mobil')
	);
	$sql = $this->general_model->insertData('tbl_paket',$data_input);
	if($sql){
		 $this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Data Berhasil diinput.'));
		 redirect(base_url('admin/paket'));
	}else{
	     $this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong> Data Gagal dinput.'));
		 redirect(base_url('admin/paket'));
	}
}

function transaksi($bulan = 0){
	if($bulan != 0){
		$where = "Where MONTH(tanggal)=$bulan";
	}else{
		$where = "";
	}
	$data['bulan']=$bulan; 
	$data['booking'] = $this->db->query('SELECT * FROM `tbl_jadwal` JOIN `tbl_transaksi` ON `tbl_jadwal`.`id_jadwal`=`tbl_transaksi`.`id_jadwal`'.$where)->result();
	// echo $this->db->last_query();die;
	$this->load->view('admin/header');
	$this->load->view('admin/transaksi',$data);
	$this->load->view('admin/footer');	
}

function transaksiBook($id){
	$data['booking'] = $this->db->query('SELECT * FROM `tbl_jadwal` JOIN `tbl_transaksi` ON `tbl_jadwal`.`id_jadwal`=`tbl_transaksi`.`id_jadwal` where tbl_jadwal.id_jadwal="'.$id.'"')->row();
	$bulanpisah=explode('-',$data['booking']->tanggal); 
	$data['bulan'] = $bulanpisah[1];
	$data['link']=true;
	// echo $this->db->last_query();die;
	$this->load->view('admin/header');
	$this->load->view('admin/transaksi',$data);
	$this->load->view('admin/footer');	
}

public function tambahPesan(){
	$data_input = array(
		'tanggal' =>$this->input->post('tgl_book'),
		'alamat_sewa' =>$this->input->post('alamat'),
		'id_mobil' =>$this->input->post('mobil'),
		'id_penyewa' =>$this->session->id_user,
		'status_jadwal' =>'waiting'
	);
	$this->general_model->insertData('tbl_jadwal',$data_input);
	redirect(base_url());
}

public function tambahUser($jenis){
	$config['upload_path']          = './assets/img/client/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = 'client_'.time();
    $config['overwrite']			= true;
    $config['max_size']             = 1500000; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
        $this->upload->data("file_name");
		$data_input = array(
			'nik' => $this->input->post('nik'),
			'nama_lengkap' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tgl_lahir'),
			'email' => $this->input->post('email'),
			'tlp' => $this->input->post('tlp'),
			'password' => md5($this->input->post('password')),
			'alamat' => $this->input->post('alamat'),
			'tipe'=>$jenis,
			'status'=>1,
			'foto'=>'assets/img/'.$config['file_name'].''.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->insertData('tbl_admin',$data_input);
		if($sql){
			echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			// redirect(base_url('/'));
			redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}else{
			echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			// redirect(base_url('/'));
			redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}
    }else{
    	$data_input = array(
			'nik' => $this->input->post('nik'),
			'nama_lengkap' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tgl_lahir'),
			'email' => $this->input->post('email'),
			'tlp' => $this->input->post('tlp'),
			'password' => md5($this->input->post('password')),
			'alamat' => $this->input->post('alamat'),
			'tipe'=>$jenis,
			'status'=>1
		);

		$sql = $this->general_model->insertData('tbl_admin',$data_input);
    	if($sql){
			echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			redirect(base_url('/'));
		}else{
			echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			redirect(base_url('/'));
		}
    }

}

public function editUser($id,$jenis){
	$config['upload_path']          = './assets/img/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = 'client_'.time();
    $config['overwrite']			= true;
    $config['max_size']             = 1500000; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
        $this->upload->data("file_name");
		$data_input = array(
			'nama_lengkap' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tgl_lahir'),
			'email' => $this->input->post('email'),
			'tlp' => $this->input->post('tlp'),
			'password' => md5($this->input->post('password')),
			'alamat' => $this->input->post('alamat'),
			'foto'=>'assets/img/'.$config['file_name'].''.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->updateWhereData('tbl_admin',$data_input,['id_admin'=>$id]);
		if($sql){
			echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			// redirect(base_url('/'));
			redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}else{
			echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			// redirect(base_url('/'));
			redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}
    }else{
    	$data_input = array(
			'nama_lengkap' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tgl_lahir'),
			'email' => $this->input->post('email'),
			'tlp' => $this->input->post('tlp'),
			'password' => md5($this->input->post('password')),
			'alamat' => $this->input->post('alamat')
		);

		$sql = $this->general_model->updateWhereData('tbl_admin',$data_input,['id_admin'=>$id]);
    	if($sql){
			 $this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Data Berhasil diinput.'));
			// redirect(base_url('admin/lihatmobil'));
			 redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}else{
			 $this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong> Data Gagal dinput.'));
			// redirect(base_url('admin/lihatmobil'));
			redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}
    }

}

public function addBooking(){
	$config['upload_path']          = './assets/img/client/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = 'client_'.time();
    $config['overwrite']			= true;
    $config['max_size']             = 1500000; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
        $this->upload->data("file_name");
		$data_input = array(
			'nik' => $this->input->post('nik'),
			'nama_lengkap' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('templahir'),
			'tanggal_lahir' => $this->input->post('tgllahir'),
			'email' => $this->input->post('email'),
			'tlp' => $this->input->post('tlp'),
			'password' => md5($this->input->post('password')),
			'tipe'=>'siswa',
			'status'=>1,
			'foto'=>'/assets/img/client/'.$config['file_name'].'.'.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->insertData('tbl_customer',$data_input);
		if($sql){
			echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			redirect(base_url('/'));
		}else{
			echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			redirect(base_url('/'));
		}
    }

}

public function add_mobil(){
	$config['upload_path']          = './assets/img/mobil/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = 'mobil_'.time();
    $config['overwrite']			= true;
    $config['max_size']             = 1500000; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
        $this->upload->data("file_name");
		$data_input = array(
			'nama_mobil' => $this->input->post('nama'),
			'tahun_keluar' => $this->input->post('tahun'),
			'jenis' => $this->input->post('jenis'),
			'harga' => $this->input->post('harga'),
			'gambar'=>'assets/img/mobil/'.$config['file_name'].''.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->insertData('tbl_mobil',$data_input);
		if($sql){
			 $this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Data Berhasil diinput.'));
			// redirect(base_url('admin/lihatmobil'));
			 redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}else{
			 $this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong> Data Gagal dinput.'));
			// redirect(base_url('admin/lihatmobil'));
			redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}
    }

}

public function edit_mobil($id){
	$config['upload_path']          = './assets/img/mobil/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = 'mobil_'.time();
    $config['overwrite']			= true;
    $config['max_size']             = 1500000; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);
    if ($this->upload->do_upload('gambar')) {
        $this->upload->data("file_name");
		$data_input = array(
			'nama_mobil' => $this->input->post('nama'),
			'tahun_keluar' => $this->input->post('tahun'),
			'jenis' => $this->input->post('jenis'),
			'harga' => $this->input->post('harga'),
			'gambar'=>'assets/img/mobil/'.$config['file_name'].''.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->updateWhereData('tbl_mobil',$data_input,['id_mobil'=>$id]);
		if($sql){
			echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			redirect(base_url('admin/lihatmobil'));
		}else{
			echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			redirect(base_url('admin/lihatmobil'));
		}
    }else{
    	$data_input = array(
			'nama_mobil' => $this->input->post('nama'),
			'tahun_keluar' => $this->input->post('tahun'),
			'jenis' => $this->input->post('jenis'),
			'harga' => $this->input->post('harga')
		);

		$sql = $this->general_model->updateWhereData('tbl_mobil',$data_input,['id_mobil'=>$id]);
		if($sql){
			echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			redirect(base_url('/admin'));
		}else{
			echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			redirect(base_url('/admin'));
		}
    }

}

    public function proseslogin(){
		$data_input = array(
			'email'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password'))
		);
		// var_dump($data_input);
		$sql = $this->general_model->getWhere('tbl_admin',$data_input);
		// echo $sql->num_rows();
		if($sql->num_rows() > 0){
			$data = $sql->row();
			$data_sess = array(
				'id_user'=>$data->id_admin,
				'nik' =>$data->nik,
				'nama_lengkap' =>$data->nama_lengkap,
				'email' => $data->password,
				'alamat' =>$data->alamat,
				'ttl'=>$data->tempat_lahir.','.$data->tanggal->lahir,
				'foto'=>$data->foto,
				'tlp'=>$data->tlp,
				'tipe'=>$data->tipe,
			);
			$this->session->set_userdata($data_sess);
		}else{
		    $this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong> Data Email dan Password tidak cocok.'));
		}
		redirect(base_url('admin'));
}

public function approveResi($id){
	$sql = $this->db->query("SELECT * FROM tbl_admin WHERE tipe='supir' AND STATUS=1 ORDER BY RAND() LIMIT 1")->row();
	$data1 = $this->general_model->updateWhereData('tbl_transaksi',['waktu_approve'=>date('Y-m-d H:i:s')],['id_transaksi'=>$id]);
	$data2 = $this->general_model->getWhere('tbl_transaksi',['id_transaksi'=>$id])->row();
	$data3 = $this->general_model->updateWhereData('tbl_jadwal',['id_supir'=>$sql->id_admin,'status_jadwal'=>'ok'],['id_jadwal'=>$data2->id_jadwal]);
	if($data3){
		$this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong>Data Berhasil Diinput.'));
	}else{
		$this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong>Data Berhasil Diinput.'));
	}
	redirect(base_url('admin/transaksi'));
}

public function selesaiBook($id){
	$data1 = $this->general_model->updateWhereData('tbl_jadwal',['status_jadwal'=>'finish'],['id_jadwal'=>$id]);
	$data = $this->general_model->updateWhereData('tbl_transaksi',['waktu_approve'=>date('Y-m-d H:i:s')],['id_jadwal'=>$id]);
	$this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong>Data Berhasil Diinput.'));
	redirect(base_url('admin/transaksi'));
}

public function uploadResi(){
	$config['upload_path']          = './assets/img/resi/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = 'resi_'.time();
    $config['overwrite']			= true;
    $config['max_size']             = 1500000; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
        $this->upload->data("file_name");
		$data_input = array(
			'nik' => $this->input->post('nik'),
			'nama_lengkap' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('templahir'),
			'tanggal_lahir' => $this->input->post('tgllahir'),
			'email' => $this->input->post('email'),
			'tlp' => $this->input->post('tlp'),
			'password' => md5($this->input->post('password')),
			'tipe'=>'siswa',
			'status'=>1,
			'resi'=>'/assets/img/client/'.$config['file_name'].'.'.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->insertData('tbl_customer',$data_input);
		if($sql){
			echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			redirect(base_url('/'));
		}else{
			echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			redirect(base_url('/'));
		}
    }

}


function alertz($type,$text){
        return '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
          '.$text.'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    }

public function logout(){
	$this->session->sess_destroy();
	redirect(base_url('admin'));
}

public function showHarga(){
	$data = $this->general_model->getWhere('tbl_mobil',['id_mobil'=>$this->input->post('id_mobil')])->row();
	echo $data->harga;
}

function  delete($table,$id){
        $field = ['tbl_mobil'=>'id_mobil','tbl_admin'=>'id_admin','tbl_customer'=>'id_user','tbl_paket'=>'id_paket'];
        if($table=='tbl_mobil'){
            $sql  = $this->general_model->getWhere('tbl_mobil',['id_mobil'=>$id])->row();
            unlink('./assets/img/mobil/'.$sql->foto);
        }
        $sql = $this->general_model->deleteWhereData($table,[$field[$table]=>$id]);
        if($sql){
            $this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Data anda berhasil disimpan.'));
        }else{
            $this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong> Data Anda gagal disimpan.'));
        }
        redirect(str_replace(base_url(), '',$this->agent->referrer()));
        
    }

}
