<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('general_model');
		$this->load->library('user_agent');
		date_default_timezone_set('Asia/Jakarta');
	}

public function index(){
	$data['mobil'] = $this->general_model->getAll('tbl_mobil')->result();
	$data['cekmobil'] = $this->general_model->getWhere('tbl_mobil',['qty !='=>0])->result();
	$data['pengajar'] = $this->general_model->getWhere('tbl_admin',['tipe'=>'supir'])->result();
	$data['paket'] = $this->general_model->getWhereJoin(['tbl_paket','tbl_mobil'],['tbl_paket.id_mobil=tbl_mobil.id_mobil'],'inner',[])->result();
	$data['transaksi'] = $this->general_model->getSpesificWhereJoin(['*'],['tbl_jadwal','tbl_transaksi','tbl_mobil'],['tbl_jadwal.id_jadwal=tbl_transaksi.id_jadwal','tbl_jadwal.id_mobil=tbl_mobil.id_mobil'],'inner',['id_penyewa'=>$this->session->id_user])->result();
	$this->load->view('client/index',$data);
}

public function tambahPesan(){
	$data_input = array(
		'tanggal' =>$this->input->post('tgl_book'),
		'alamat_sewa' =>$this->input->post('alamat'),
		'id_mobil' =>$this->input->post('mobil'),
		'id_penyewa' =>$this->session->id_user,
		'status_jadwal' =>'waiting',
		'lama_hari' =>$this->input->post('qty'),
		'supir' =>($this->input->post('pengemudi')=='on')?'true':'false'
	);
	$this->general_model->insertData('tbl_jadwal',$data_input);
	// echo $this->db->last_query();die;
	$last_data = $this->general_model->getLastData('tbl_jadwal','id_jadwal')->row();
	$data_input2 = array(
		'no_invoice' =>'INV'.DATE('YmdHis'),
		'id_jadwal'=> $last_data->id_jadwal,
		'tagihan' =>  $this->input->post('totalharga')
	);
	$this->general_model->insertData('tbl_transaksi',$data_input2);
	$this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Pesanan anda telah dibooking, cek history untuk proses resi!.'));
	redirect(base_url());
}

public function tambahPesanPaket($id){
	$data  = $this->general_model->getWhere('tbl_paket',['id_paket'=>$id])->row();
	$data_input = array(
		'tanggal' =>$this->input->post('tgl_book'),
		'alamat_sewa' =>$this->session->alamat,
		'id_mobil' =>$data->id_mobil,
		'id_penyewa' =>$this->session->id_user,
		'status_jadwal' =>'waiting',
		'lama_hari' =>$data->jml_hari,
		'supir' =>true
	);
	// var_dump($data_input);die;
	$this->general_model->insertData('tbl_jadwal',$data_input);
	// echo $this->db->last_query();die;
	$last_data = $this->general_model->getLastData('tbl_jadwal','id_jadwal')->row();
	$data_input2 = array(
		'no_invoice' =>'INV'.DATE('YmdHis'),
		'id_jadwal'=> $last_data->id_jadwal,
		'tagihan' =>  $data->harga_paket
	);
	$this->general_model->insertData('tbl_transaksi',$data_input2);
	 $this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Pesanan anda telah dibooking, cek history untuk proses resi!.'));
	redirect(base_url());
}

public function uploadResi($id){
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
			'waktu_upload'=>date('Y-m-d H:i:s'),
			'resi'=>'/assets/img/resi/'.$config['file_name'].''.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->UpdateWhereData('tbl_transaksi',$data_input,['id_transaksi'=>$id]);
		if($sql){
			$this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Resi Berhasil diinput!.'));
			redirect(base_url(''));
		}else{
			$this->session->set_flashdata('notif',$this->alertz('danger','<strong>Selamat!</strong> Sepertinya resi gagal diinput!.'));
			redirect(base_url(''));
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
			'alamat' => $this->input->post('alamat'),
			'foto'=>'assets/img/'.$config['file_name'].''.$this->upload->data('file_ext')
		);

		$sql = $this->general_model->updateWhereData('tbl_customer',$data_input,['id_user'=>$id]);
		if($sql){
			echo "<script>alert('User Berhasil diedit!')</script>";
			// echo "<script>Alert('Data Berhasil Diinput, Silahkan Login!')</script>";
			// redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}else{
			echo "<script>alert('User Gagal diperbarui!')</script>";
			// echo "<script>Alert('Data Gagal Diinput, Silahkan Isikan Dengan Benar!')</script>";
			// redirect(base_url('/'));
		}
			redirect(base_url('./logout'));
			// redirect(str_replace(base_url(), '',$this->agent->referrer()));
    }else{
    	$data_input = array(
			'nama_lengkap' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tgl_lahir'),
			'email' => $this->input->post('email'),
			'tlp' => $this->input->post('tlp'),
			'alamat' => $this->input->post('alamat')
		);

		$sql = $this->general_model->updateWhereData('tbl_customer',$data_input,['id_user'=>$id]);
    	if($sql){
    		echo "<script>alert('User Berhasil diedit!')</script>";
			 // $this->session->set_flashdata('notif',$this->alertz('success','<strong>Selamat!</strong> Data Berhasil diinput.'));
			// redirect(base_url('admin/lihatmobil'));
			 // redirect(str_replace(base_url(), '',$this->agent->referrer()));
		}else{
			echo "<script>alert('User Gagal diperbarui!')</script>";
			 // $this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf!</strong> Data Gagal dinput.'));
			// redirect(base_url('admin/lihatmobil'));
		}
		redirect(base_url('admin/logout'));
			// redirect(str_replace(base_url(), '',$this->agent->referrer()));
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

    public function login(){
		$data_input = array(
			'email'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password'))
		);
		$sql = $this->general_model->getWhere('tbl_customer',$data_input);
		// echo $sql->num_rows();
		if($sql->num_rows() > 0){
		$data = $sql->row();
		$data_sess = array(
			'id_user'=>$data->id_user,
			'nik' =>$data->nik,
			'nama_lengkap' =>$data->nama_lengkap,
			'email' => $data->email,
			'alamat' =>$data->alamat,
			'ttl'=>$data->tempat_lahir.','.$data->tanggal->lahir,
			'foto'=>$data->foto,
			'tlp'=>$data->tlp,
			'jenkel'=>$data->jenkel,
			'tipe'=>$data->tipe,
			'gambar'=>$data->foto,
		);
		$this->session->set_userdata($data_sess);
		$this->session->set_flashdata('notif',$this->alertz('success','<strong>Hai, '.$data->nama_lengkap.' </strong> Selamat datang!.'));
		redirect(base_url());
	}else{
		// echo "<script>alert('User Tidak ditemmukan!')</script>";
		$this->session->set_flashdata('notif',$this->alertz('danger','<strong>Maaf </strong> Sepertinya username dan password tidak cocok!.'));
	}
	redirect(str_replace(base_url(), '',$this->agent->referrer()));
	// redirect(base_url());

}

public function logout(){
	$this->session->sess_destroy();
	echo "<script>alert('Logout!')</script>";
	redirect(base_url());
}

public function showHarga(){
	$data = $this->general_model->getWhere('tbl_mobil',['id_mobil'=>$this->input->post('id_mobil')])->row();
	echo $data->harga;
}

}
