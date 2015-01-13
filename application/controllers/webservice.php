<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
class Webservice extends REST_Controller {
   
        public function __construct() {
        parent::__construct();
        $this->load->model('webservice_model');
        }
        
	public function index()
	{
		$this->load->view('welcome_message');
	}
        
        public function users_get()
        {
            $users = $this->webservice_model->select_member();
            $this->response($users, 200);
        }
		
        public function events_get()
        {
            $events = $this->webservice_model->select_event();
            $this->response($events, 200);
        }
		
		public function eventsenjoy_get()
		{
			$iduser = $this->get('iduser');
			$events = $this->webservice_model->enjoyevent($iduser);
             if($events)
            {
                $this->response($events, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('idevent' => -1, 'email' => 'xxxx', 'pswd' => 'xxx', 'name' => 'xxx', 'country' => 'xxx',  'city' => 'xxx'), 200);
            }
		}
		
		public function eventscity_get()
		{
			$city = $this->get('city');
            $now = $this->get('now');
			$country = $this->get('country');
			$category = $this->get('category');
			$events = $this->webservice_model->eventsnew($city,$now,$country,$category);
             if($events)
            {
                $this->response($events, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('idevent' => -1, 'email' => 'xxxx', 'pswd' => 'xxx', 'name' => 'xxx', 'country' => 'xxx',  'city' => 'xxx'), 200);
            }
		}
        public function userlog_get()
        {
            $email = $this->get('email');
            $pswd = $this->get('pswd');
            $user = $this->webservice_model->login($email,$pswd);
            if($user)
            {
                $this->response($user, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('iduser' => -1, 'email' => 'xxxx', 'pswd' => 'xxx', 'name' => 'xxx', 'country' => 'xxx',  'city' => 'xxx'), 200);
            }
        }
        
		public function usercek_get()
		{
			$email = $this->get('email');
			$user = $this->webservice_model->cekEmail($email);
			if($user)
            {
                $this->response($user, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('iduser' => -1, 'email' => 'xxxx', 'pswd' => 'xxx', 'name' => 'xxx', 'country' => 'xxx',  'city' => 'xxx'), 200);
            }
			
		}
		
		public function userinsert_get()
		{
			$usernew   =   array(
                'iduser' => '',
				'email'   =>  $this->get('email'),
                'pswd'      =>  $this->get('pswd'),
                'name'      =>  $this->get('name'),
                'country'      =>  $this->get('country'),
                'city' => $this->get('city')
                );
				
			$success = false;
			
			if($this->get('email') && $this->get('pswd') && $this->get('name'))
			{
				
				$success = $this->webservice_model->add_user($usernew);
			}
			
			if($success)
            {
                $this->response(array('iduser' => 1, 'email' => $this->get('email'), 'pswd' => $this->get('pswd'), 'name' => $this->get('name'), 'country' => $this->get('country'),  'city' => $this->get('city')));
            }
            else
            {
                $this->response(array('iduser' => -1, 'email' => 'xxxx', 'pswd' => 'xxx', 'name' => 'xxx', 'country' => 'xxx',  'city' => 'xxx'), 200);
            }
				
		}
		
		public function eventinsert_get()
		{
			$eventnew   =   array(
                'idevent' => '',
				'name'   =>  $this->get('name'),
                'tanggal'      =>  $this->get('tanggal'),
                'location'      =>  $this->get('location'),
                'waktu'      =>  $this->get('waktu'),
                'performer' => $this->get('performer'),
				'ticket_price' => $this->get('ticket_price'),
				'category' => $this->get('category'),
				'country' => $this->get('country'),
				'city' => $this->get('city'),
				'description' => $this->get('description'),
				'img' => $this->get('img'),
				'maplokasi' => $this->get('maplokasi')
                );
				
			$success = false;
			
			if($this->get('name') && $this->get('location') && $this->get('waktu'))
			{
				
				$success = $this->webservice_model->add_event($eventnew);
			}
			
			if($success)
            {
                $this->response(array('idevent' => 1, 'name' => $this->get('name'), 'tanggal' => $this->get('tanggal'), 'location' => $this->get('location'), 'country' => $this->get('country'),  'city' => $this->get('city')));
            }
            else
            {
                $this->response(array('idevent' => -1, 'email' => 'xxxx', 'pswd' => 'xxx', 'name' => 'xxx', 'country' => 'xxx',  'city' => 'xxx'), 200);
            }
				
		}
		
		public function checkininsert_get()
		{
			$checkinnew   =   array(
                'idcheck' => '',
				'iduser' => $this->get('iduser'),
				'idevent' => $this->get('idevent'),
				'waktu_checkin' => ''
                );
				
			$success = false;
			
			if($this->get('iduser') && $this->get('idevent'))
			{
				
				$success = $this->webservice_model->add_checkin($checkinnew);
			}
			
			if($success)
            {
                $this->response(array('idcheckin' => 1, 'iduser' => $this->get('iduser'), 'idevent' => $this->get('idevent')));
            }
            else
            {
                $this->response(array('idcheckin' => -1, 'email' => 'xxxx', 'pswd' => 'xxx', 'name' => 'xxx', 'country' => 'xxx',  'city' => 'xxx'), 200);
            }
				
		}

}