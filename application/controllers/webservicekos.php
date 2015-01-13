<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
class Webservicekos extends REST_Controller {
   
        public function __construct() {
        parent::__construct();
        $this->load->model('webservicekos_model');
        }        
		
		public function allkos_get()
        {
            $users = $this->webservicekos_model->select_all_kos();
            $this->response($users, 200);
        }
		
		public function alluser_get()
        {
            $users = $this->webservicekos_model->select_all_user();
            $this->response($users, 200);
        }
		
		public function kosgender_get()
		{
			$gender = $this->get('gender');
			$kos = $this->webservicekos_model->select_kos_gender($gender);
             if($kos)
            {
                $this->response($kos, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('id_kos' => -1, 'nama' => 'xxxx', 'alamat' => 'xxx', 'langitude' => 'xxx', 'latitude' => 'xxx',  'harga' => 'xxx', 'tampakdepan' => 'xxx', 'streetview' => 'xxx'), 200);
            }
		}
		
		public function kos_get()
		{
			$idkos = $this->get('idkos');
			$kos = $this->webservicekos_model->select_kos($idkos);
             if($kos)
            {
                $this->response($kos, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('id_kos' => -1, 'nama' => 'xxxx', 'alamat' => 'xxx', 'langitude' => 'xxx', 'latitude' => 'xxx',  'harga' => 'xxx', 'tampakdepan' => 'xxx', 'streetview' => 'xxx'), 200);
            }
		}
		
		public function keterangan_get()
		{
			$idkos = $this->get('idkos');
			$kos = $this->webservicekos_model->detail_kos($idkos);
             if($kos)
            {
                $this->response($kos, 200); // 200 being the HTTP response code
            }
            else
            {
                $this->response(array('id_aturan' => -1, 'kos_id' => 'xxxx', 'detail' => 'xxx'), 200);
            }
		}
		
		public function kosinsert_get()
		{
			$kosnew   =   array(
                'id_kos' => '',
				'nama'   =>  $this->get('nama'),
                'alamat'      =>  $this->get('alamat'),
                'longitude'      =>  $this->get('longitude'),
                'latitude'      =>  $this->get('latitude'),
                'harga' => $this->get('harga'),
				'tampakdepan' => $this->get('tampakdepan'),
				'streetview' => $this->get('streetview'),				
                );
				
			$data = null;
			if($this->get('nama') && $this->get('longitude') && $this->get('latitude'))
			{				
				$data = $this->webservicekos_model->add_kos($kosnew);
			}
			
			if($data!=null)
            {
				$temp = $this->webservicekos_model->select_kos_koordinat($this->get('nama'), $this->get('longitude'), $this->get('latitude'));
				$this->response($temp, 200);
            }
            else
            {
                $this->response(array('id_kos' => -1, 'nama' => 'xxxx', 'alamat' => 'xxx', 'longitude' => 'xxx', 'latitude' => 'xxx',  'harga' => 'xxx', 'tampakdepan' => 'xxx', 'streetview' => 'xxx'), 200);
            }
				
		}

		public function keteranganinsert_get()
		{
			$keterangannew   =   array(
                'id_aturan' => '',
				'kos_id'   =>  $this->get('kos_id'),
                'detail'      =>  $this->get('detail'),                		
                );
				
			$data = null;
			if($this->get('kos_id') && $this->get('detail'))
			{				
				$data = $this->webservicekos_model->add_keterangan($keterangannew);
			}
			
			if($data!=null)
            {
				$this->response(array('id_aturan' => 1, 'kos_id' => $this->get('kos_id'), 'detail' => $this->get('detail')), 200);
            }
            else
            {
                $this->response(array('id_aturan' => -1, 'kos_id' => 'xxxx', 'detail' => 'xxx'), 200);
            }
		}
		
		public function login_get()
		{
			$email = $this->get('email');
			$pass = $this->get('pass');
			
			$user = $this->webservicekos_model->login($email, $pass);
             if($user)
            {
                $this->response($user, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('id_pengguna' => -1, 'email' => 'xxxx', 'pass' => 'xxx'), 200);
            }
		}
		
		public function userinsert_get()
		{
			$user   =   array(
                'id_pengguna' => '',
				'email'   =>  $this->get('email'),
                'pass'      =>  $this->get('pass'),                		
                );
				
			$data = null;
			if($this->get('email') && $this->get('pass'))
			{				
				$data = $this->webservicekos_model->add_pengguna($user);
			}
			
			if($data!=null)
            {
				$this->response(array('id_pengguna' => 1, 'email' => $this->get('email'), 'pass' => $this->get('pass')), 200);
            }
            else
            {
                $this->response(array('id_pengguna' => -1, 'email' => 'xxxx', 'pass' => 'xxx'), 200);
            }
		}

}