<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Libs {
	var $CI;
	
	function __construct(){
		$this->CI =& get_instance();
	}
	
	/* General Function Application */
	function checkJenisLogin($currentLogin){
		if($currentLogin!=JENIS_LOGIN){
			switch(JENIS_LOGIN){
				case 'default' : redirect("signin"); break;
			}
		}
	}
	
	/*** Core Template Function ***/
	
	function getView($view='home/WelcomeMessage',$data=array(),$string=FALSE)
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
				if($string==FALSE){
					$this->CI->load->view($view,$data);
				}else{
					return $this->CI->load->view($view,$data,TRUE);
				}
			}else{
				$data['content'] = $this->CI->load->view($view,$data,TRUE);
				if($string==FALSE){
					$this->CI->load->view('theme/MainTemplate',$data);
				}else{
					return $this->CI->load->view('theme/MainTemplate',$data,TRUE);
				}
			}
		}else{
			$data['content'] = $this->CI->load->view($view,$data,TRUE);
			if($string==FALSE){
				$this->CI->load->view('theme/MainTemplate',$data);
			}else{
				return $this->CI->load->view('theme/MainTemplate',$data,TRUE);
			}
		}
	}
	
	function checkMainTemplate($view='home/WelcomeMessage',$data=array())
	{
		if($this->CI->input->get_post('mt')==1){
			$this->CI->load->view($view,$data);
		}else{
			$data['content'] = $this->CI->load->view($view,$data,TRUE);
			$this->CI->load->view('theme/MainTemplate',$data);
		}
	}
	
	/*** End Core Template Function ***/
	
	/*** Utility Function ***/	
	function rpad($string,$digit,$char=' ')
	{
		return str_pad($string,$digit,$char,STR_PAD_RIGHT);
	}
	
	function lpad($string,$digit,$char=' ')
	{
		return str_pad($string,$digit,$char,STR_PAD_LEFT);
	}
	
	function bpad($string,$digit,$char=' ')
	{
		return str_pad($string,$digit,$char,STR_PAD_BOTH);
	}
	
	function getUserIP()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}
	
	function getClientIP() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress;
	}
	
	function highlightStrings($string='',$length_char=0,$link='')
	{
		$string = strip_tags($string);
		$string = trim($string);
		if(strlen($string)>$length_char){
			$string = substr($string,0,$length_char);
			$string = substr($string,0,strrpos($string,' ')).' ...'; 
		}
		return $string!=''?trim($string.' '.$link):trim($string);
	}
	
	function unzip($zipfile,$destination,$filename=''){
		try{
			$zip = new ZipArchive;
			$res = $zip->open($zipfile);
			if($filename!=''){
				$zip->extractTo($destination,$filename);
			}else{
				$zip->extractTo($destination);
			}
			$zip->close();
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	
	function terbilang($x)
	{
		$x = intval($x);
		$x = abs($x);
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x < 12)
			return " ".$abil[$x];
		elseif ($x < 20)
			return $this->terbilang($x - 10)." belas";
		elseif ($x < 100)
			return $this->terbilang($x / 10)." puluh".$this->terbilang($x % 10);
		elseif ($x < 200)
			return " seratus".$this->terbilang($x - 100);
		elseif ($x < 1000)
			return $this->terbilang($x / 100)." ratus".$this->terbilang($x % 100);
		elseif ($x < 2000)
			return " seribu".$this->terbilang($x - 1000);
		elseif ($x < 1000000)
			return $this->terbilang($x / 1000)." ribu".$this->terbilang($x % 1000);
		elseif ($x < 1000000000)
			return $this->terbilang($x / 1000000)." juta".$this->terbilang($x % 1000000);
		elseif ($x < 1000000000000)
			return $this->terbilang($x / 1000000000)." milyar".$this->terbilang($x % 1000000000);
		else
			return $this->terbilang($x / 1000000000000)." triliun".$this->terbilang($x % 1000000000000);
	}
	
	function phpConfVal2byte($param)
	{
		$conf = ini_get($param);
		switch(substr($conf,-1))
		{
			case 'T':
			   return (int)$conf * 1024 * 1024 * 1024 * 1024;break;
			case 'G':
			   return (int)$conf * 1024 * 1024 * 1024;break;
			case 'M':
			   return (int)$conf * 1024 * 1024;break;
			case 'K':
			   return (int)$conf * 1024;break;
			default: return 0;break;
		}
	}
	
	function formatSizeUnits($byte)
	{
		/* Satuan in byte */
		$KB = 1024;
		$MB = $KB * 1024;
		$GB = $MB * 1024;
		$TB = $GB * 1024;
		if($byte>=$TB){
			$byte = number_format($byte/$TB,2).' TB';
		}elseif($byte>=$MB){
			$byte = number_format($byte/$MB,2).' MB';
		}elseif($byte>=$KB){
			$byte = number_format($byte/$KB,2).' KB';
		}elseif($byte>1){
			$byte = $byte.' bytes';
		}elseif($byte==1){
			$byte = $byte.' byte';
		}else{
			$byte = '0 bytes';
		}
		return $byte;
	}
	
	function json2Array($str)
	{
		$arr_data = json_decode($str,true);
		return is_array($arr_data)?$arr_data:array();
	}
	
	/*** End Utility Function ***/
	
	/*** Date and Time Function ***/
	function num2NameMonth($num)
	{
		$num = $this->lpad($num,2,'0');
		switch($num)
		{
			case '01': return 'Januari'; break;
			case '02': return 'Februari'; break;
			case '03': return 'Maret'; break;
			case '04': return 'April'; break;
			case '05': return 'Mei'; break;
			case '06': return 'Juni'; break;
			case '07': return 'Juli'; break;
			case '08': return 'Agustus'; break;
			case '09': return 'September'; break;
			case '10': return 'Oktober'; break;
			case '11': return 'November'; break;
			case '12': return 'Desember'; break;
			default : return ''; break;
		}
	}
	
	function arrMonth()
	{
		return array(1=>'Januari'
					,2=>'Februari'
					,3=>'Maret'
					,4=>'April'
					,5=>'Mei'
					,6=>'Juni'
					,7=>'Juli'
					,8=>'Agustus'
					,9=>'September'
					,10=>'Oktober'
					,11=>'November'
					,12=>'Desember');
	}
	
	function arrMonth2Digit()
	{
		return array('01'=>'Januari'
					,'02'=>'Februari'
					,'03'=>'Maret'
					,'04'=>'April'
					,'05'=>'Mei'
					,'06'=>'Juni'
					,'07'=>'Juli'
					,'08'=>'Agustus'
					,'09'=>'September'
					,'10'=>'Oktober'
					,'11'=>'November'
					,'12'=>'Desember');
	}
	
	function dayOfTheWeek($day=7)
	{
		switch($day)
		{
			case 0: return 'Minggu'; break;
			case 1: return 'Senin'; break;
			case 2: return 'Selasa'; break;
			case 3: return 'Rabu'; break;
			case 4: return 'Kamis'; break;
			case 5: return 'Jumat'; break;
			case 6: return 'Sabtu'; break;
			default : return ''; break;
		}
	}
	
	function ymdhis2dMonthyhis($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].' '.$this->num2NameMonth($arr_date[1]).' '.$arr_date[0].' Pukul '.$arr_datetime[1];
		}
		return $datetime;
	}
	
	function ymdhis2dmyhis($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0].' Pukul '.$arr_datetime[1];
		}
		return $datetime;
	}
	
	function ymdhis2dmyhis_pure($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0].' '.$arr_datetime[1];
		}
		return $datetime;
	}
	
	function ymdhis2dMonthy($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].' '.$this->num2NameMonth($arr_date[1]).' '.$arr_date[0];
		}
		return $datetime;
	}
	
	function dmy2dMonthy($datetime)
	{
		if($datetime!=''){
			$arr_date = explode('-',$datetime);
			$datetime = $arr_date[0].' '.$this->num2NameMonth($arr_date[1]).' '.$arr_date[2];
		}
		return $datetime;
	}
	
	function ymdhis2dmy($datetime)
	{
		if($datetime!=''){
			$arr_datetime = explode(' ',$datetime);
			$arr_date = explode('-',$arr_datetime[0]);
			$datetime = $arr_date[2].'-'.$arr_date[1].'-'.$arr_date[0];
		}
		return $datetime;
	}
	
	function createCurrentTime()
	{
		$t = microtime(true);
		$micro = sprintf("%06d",($t-floor($t))*1000000);
		$d = new DateTime(date('Y-m-d H:i:s.'.$micro,$t));
		return $d->format("YmdHisu");
	}
	
	function isTime($time,$is24Hours=true,$seconds=false) 
	{
		// $pattern = "/^".($is24Hours ? "([1-2][0-3]|[01]?[1-9])" : "(1[0-2]|0?[1-9])").":([0-5]?[0-9])".($seconds ? ":([0-5]?[0-9])" : "")."$/";
		$pattern = "/^(?:".($is24Hours ? "([01]?\d|2[0-3])" : "(1[0-2]|0?[1-9])").":([0-5]?\d))?".($seconds ? ":([0-5]?[0-9])" : "")."$/";
		if (preg_match($pattern, $time)) {
			return true;
		}
		return false;
	}
	
	function arr24Hour()
	{
		$arr = array();
		for($i=0;$i<24;$i++){
			$str_i = $this->lpad($i,2,'0');
			$arr[$str_i] = $str_i;
		}
		return $arr;
	}
	
	function arrMinuteSecond()
	{
		$arr = array();
		for($i=0;$i<60;$i++){
			$str_i = $this->lpad($i,2,'0');
			$arr[$str_i] = $str_i;
		}
		return $arr;
	}
	
	function dateDiff($tgl_awal, $tgl_akhir)
	{
		return round((strtotime($tgl_akhir)-strtotime($tgl_awal))/86400);
	}
	
	function dateDiffInYear($tgl_awal, $tgl_akhir)
	{
		$diff = abs(strtotime($tgl_akhir) - strtotime($tgl_awal));
		$years = floor($diff / (365*60*60*24));
		return $years;
	}
	
	/*** End Date and Time Function ***/
	
	/*** Employee Function ***/
	function num2JenisKelamin($num)
	{
		switch($num)
		{
			case 'M' : 
			case 'L' : return 'Laki-Laki'; break;
			case 'F' : 
			case 'P' : return 'Perempuan'; break;
			default : return ''; break;
		}
	}
	
	/*** End Employee Function ***/
	
	/*** Form Function ***/
	
	/*** End Form Function ***/
	
	/*** Model Function ***/
	function arrWhere($operator,$field,$value,$escape_type=1,$fieldOperator='=',$prefix='',$sufix='')
	{
		return array('field'=>$field,'operator'=>$operator,'field_operator'=>$fieldOperator,'value'=>$value,'escape_type'=>$escape_type,'prefix'=>$prefix,'sufix'=>$sufix);
	}
	
	function generateWhereStatement($param,$connection,$conjuction='WHERE')
	{
		$where = '';
		if($param!=''){
			if(is_array($param)){
				foreach($param as $value){
					if(trim($where)!=''){
						$where .= isset($value['operator'])?" {$value['operator']} ":'';
					}
					$field = isset($value['field'])?$value['field']:'';
					$fieldOperator = isset($value['field_operator'])?' '.$value['field_operator'].' ':'';
					if(isset($value['value'])){
						if(is_array($value['value'])){
							$arrTemp = array();
							foreach($value['value'] as $idx=>$item){
								if($value['escape_type']==1){
									$arrTemp[$idx] = $connection->escape($item);
								}else{
									$arrTemp[$idx] = $connection->escape_str($item);
								}
							}
							$fieldValue = "(".implode(",",$arrTemp).")";
						}else{
							if($value['escape_type']==1){
								$fieldValue = $connection->escape($value['value']);
							}else{
								$fieldValue = $connection->escape_str($value['value']);
							}
						}
					}else{
						$fieldValue = '';
					}
					$prefix = isset($value['prefix'])?$value['prefix']:'';
					$sufix = isset($value['sufix'])?$value['sufix']:'';
					$where .= $field.$fieldOperator.$prefix.$fieldValue.$sufix;
				}
			}else{
				$where = trim($param);
			}
		}
		$where = trim($where);
		$where = ($where!='')?" {$conjuction} {$where}":"";
		return $where;
	}
	
	/*** End Model Function ***/
	
	/* Additional Function */
	function generateSessionID()
	{
		return substr(sha1(mt_rand() . microtime()), mt_rand(0,35), 5);
	}
	
	function getBrowser() 
	{ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 

		return $bname;
	}
	
	function checkFileByUrl($url)
	{
		if($url!=''){
			$file_headers = getimagesize($url);
			if(!is_array($file_headers)){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
	
	function arrActiveWithStyle()
	{
		return array(0=>'<span class="red">Non Aktif</span>',1=>'<span class="blue">Aktif</span>');
	}
	
	function arrActive()
	{
		return array(0=>'Non Aktif',1=>'Aktif');
	}
	
	function breadcrumb($data)
	{
		$breadcrumb = '';
		if(is_array($data)){
			$nb = count($data);
			if($nb>0){
				$breadcrumb .= '<ol class="breadcrumb">';
				$i = 1;
				foreach($data as $idx=>$row){
					if($nb==$i){
						$breadcrumb .= '<li class="active">'.$idx.'</li>';
					}else{
						$breadcrumb .= '<li>'.anchor($row,$idx,'class="ajax"').'</li>';
					}
					$i++;
				}
				$breadcrumb .= '</ol>';
			}
		}
		return $breadcrumb;
	}
	
	function generateMessage($tipe='light',$message="....")
	{
		return '<div class="alert alert-'.$tipe.' fade show"><span class="close" data-dismiss="alert">×</span>'.$message.'</div>';
	}
	
	function arrStatusApprover()
	{
		return 	array(
					0 	=> 'Draft'
				  , 1 	=> 'Dalam Proses'
				  , 2 	=> 'Disetujui'
				  , 3 	=> 'Ditolak'
				  , 4 	=> 'Dibatalkan'
				 );
	}
	
	function arrStatusApproverWithStyle()
	{
		return 	array(
					0 	=> 'Draft'
				  , 1 	=> '<span class="orange">Dalam Proses</span>'
				  , 2 	=> '<span class="blue">Disetujui</span>'
				  , 3 	=> '<span class="red">Ditolak</span>'
				  , 4 	=> '<span class="red">Dibatalkan</span>'
				 );
	}
	
	function myEncrypt($data='')
	{
		return base64_encode($this->CI->encrypt->encode($data,$this->CI->config->item('encryption_key')));
	}
	
	function myDecrypt($data)
	{
		$data = trim($data);
		$base64_decode = base64_decode($data);
		$is_base64_string = (bool)preg_match($this->CI->config->item('base64_string'),$data);
		if($is_base64_string===TRUE && $base64_decode!==FALSE && $data!=''){
			return $this->CI->encrypt->decode($base64_decode,$this->CI->config->item('encryption_key'));
		}else{
			return FALSE;
		}
	}
	
	function arrBoolean()
	{
		return array(0=>'Tidak',1=>'Ya');
	}
	
	function createDateTimeMicrosecond($format="Y_m_d_H_i_s_u")
	{
		$t = microtime(true);
		$micro = sprintf("%06d",($t-floor($t))*1000000);
		$d = new DateTime(date('Y-m-d H:i:s.'.$micro,$t));
		return $d->format($format);
	}
	
	function generateUnikName($name)
	{
		$random = mt_rand();
		$time = $this->createDateTimeMicrosecond("YmdHisu");
		$name = str_replace(' ','_',$name);
		return $name.'_'.$_SESSION[$this->CI->config->item('session_prefix')]['pernr'].'_'.$time.'_'.$random;
	}
	
	function generateMultiOL($arr,$type='1')
	{
		echo '<ol style="padding-left:20px;" type="'.$type.'">';
		if(is_array($arr)){
			foreach($arr as $row){
				if(is_array($row)){
					echo '<li style="padding-left:5px;">'.(isset($row['parent'])?$row['parent']:'');
					$this->generateMultiOL((isset($row['child'])?$row['child']:''),(isset($row['type'])?$row['type']:''));
					echo '</li>';
				}else{
					echo '<li style="padding-left:5px;">'.$row.'</li>';
				}
			}
		}else{
			echo '<li style="padding-left:5px;">'.$arr.'</li>';
		}
		echo '</ol>';
	}
	
	public function getNBHariKerja($strtime_startdate, $strtime_enddate, $libur_nasional, $sift=0)
	{
		$jml_hari = ceil(abs($strtime_enddate - $strtime_startdate) / 86400) + 1;
		if($sift!=1){
			if($jml_hari > 0){
				$weekend = 0;
				for($i=0;$i<$jml_hari;$i++){	
					$date_time = strtotime(date('Y-m-d',$strtime_enddate).' +'.$i.' day');
					$dayname = date("D", $date_time);
					if($dayname == "Sun" || $dayname == "Sat"){
						$weekend++;
					}
				}
				$jml_hari -= $weekend;
			}
			$jml_hari = $jml_hari<0?0:$jml_hari;
			$jml_libur = 0;
			foreach($libur_nasional as $row){
				$day_name = date("D", strtotime($row->tanggal));
				if($day_name!='Sun' && $day_name!='Sat'){
					$jml_libur++;
				}
			}
			$jml_hari = $jml_hari-$jml_libur;
		}
		$jml_hari = $jml_hari<0?0:$jml_hari;
		return $jml_hari;
	}
	
	function wkhtmltoPDF($document,$filename='filename',$paper_size='A4',$orientation='Portrait',$mtop='10mm',$mright='10mm',$mbottom='10mm',$mleft='10mm')
	{	
		$this->CI->load->helper(array('download','file'));
		$random = mt_rand();
		$time = $this->createDateTimeMicrosecond("YmdHisu");
		$filename_ori = $filename;
		$filename = str_replace(array('.pdf','.',' '),array('','','_'),$filename);
		$tmp_pdf_filename = $filename.'_'.$_SESSION[$this->CI->config->item('session_prefix')]['pernr'].'_'.$time.$random.'.pdf';
		$tmp_html_filename = $filename.'_'.$_SESSION[$this->CI->config->item('session_prefix')]['pernr'].'_'.$time.$random.'.html';
		write_file(FCPATH.$this->CI->config->item('tmp_folder').$tmp_html_filename, $document);
		$url_document = FCPATH.$this->CI->config->item('tmp_folder').$tmp_html_filename;
		exec("wkhtmltopdf -T ".$mtop." -R ".$mright." -L ".$mleft." -B ".$mbottom." -O ".$orientation." --page-size ".$paper_size." ".$url_document." /tmp/".$tmp_pdf_filename);
		$result_file = "/tmp/".$tmp_pdf_filename;
		$data = file_get_contents($result_file); // Read the file's contents
		$name = $filename_ori.'.pdf';
		unlink($result_file);
		unlink(FCPATH.$this->CI->config->item('tmp_folder').$tmp_html_filename);
		force_download($name, $data); 
	}
	
	function arrBoolApproveWithStyle()
	{
		return array(0=>'<span class="red">Tolak</span>',1=>'<span class="blue">Setuju</span>');
	}
	
	public function createQRcode($data, $full_path)
	{
		$this->CI->load->library('ciqrcode');
		$params['data'] = $data;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = $full_path;
		$this->CI->ciqrcode->generate($params);
	}
	
	function getRunningText()
	{
		$param[] = $this->arrWhere('AND','jenis','RUNNINGTEXT');
		$runningText = $this->CI->media_model->getRunningText(false,$param,'',0,1);
		if(count($runningText)>0){
			return str_replace('|',' <i class="fa fa-star"></i> ',$runningText[0]->isi);
		}else{
			return '';
		}
	}
	
	function isDateFormat($string)
	{
		if($string==''){
			return FALSE;
		}
		$isDateFormat = (bool)preg_match('/^\d{2}-\d{2}-\d{4}$/',$string);
		if($isDateFormat===TRUE){
			$arrPart = explode('-',$string);
			$day = (int)$arrPart[0];
			$month = (int)$arrPart[1];
			if($day>=1 && $day<=31 && $month>=1 && $month<=12){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	public function calcNumGroupDays($strtimeStart, $strtimeEnd, $liburNasional=array())
	{
		$groupDay = array('weekday'=>0,'listWeekday'=>array(),'weekend'=>0,'listWeekend'=>array(),'holiday'=>0,'listHoliday'=>array(),'total'=>0,'listDay'=>array());
		$jmlHari = ceil(abs($strtimeEnd - $strtimeStart) / 86400) + 1;
		$groupDay['total'] = $jmlHari;
		$arrHoliday = array();
		foreach($liburNasional as $row){
			$dayName = date("D", strtotime($row->tanggal));
			if($dayName!='Sun' && $dayName!='Sat'){
				$arrHoliday[] = $row->tanggal;
				$groupDay['holiday']++;
				$groupDay['listHoliday'][] = $row->tanggal;
			}
		}
		if($jmlHari > 0){
			for($i=0;$i<$jmlHari;$i++){	
				$dateTime = strtotime(date('Y-m-d',$strtimeStart).' +'.$i.' day');
				$dayname = date("D", $dateTime);
				$date = date("Y-m-d", $dateTime);
				$groupDay['listDay'][] = $date;
				if($dayname == "Sun" || $dayname == "Sat"){
					$groupDay['weekend']++;
					$groupDay['listWeekend'][] = $date;
				}else{
					if(!in_array($date,$arrHoliday)){
						$groupDay['weekday']++;
						$groupDay['listWeekday'][] = $date;
					}
				}
			}
		}
		return $groupDay;
	}
	
	function generate_message($tipe,$message)
	{
		return '<div class="alert alert-'.$tipe.' fade show"><span class="close" data-dismiss="alert">×</span>'.$message.'</div>';
	}
	
	function correctDigit($digit,$number)
	{
		if(is_int($digit)){
			$correct = '';
			for($i=0;$i<$digit;$i++){
				$correct .= '0';
			}
			$digit = -1 * $digit;
			$number = $correct.$number;
			$number = substr($number,$digit);
		}
		return $number;
	}

	function generateRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
}