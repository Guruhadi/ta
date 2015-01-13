<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
class Server extends REST_Controller {
   
        public function __construct() {
        parent::__construct();
        $this->load->model('ta_model');
        }        
	public function coba_get()
        {
            $this->response(array('id_koordinat' => -1, 'id_arduino' => 'xxxx',  'latitude' => 'xxx', 'longitude' => 'xxx' ), 200);
        }
        
        public function pemakaian_get()
        {
            $data  = $this->ta_model->get_arduino($this->get('id_arduino'));
            $this->response($data, 200);
        }
        
        public function gantiPemakaian_get()
        {
            $data  = $this->ta_model->get_arduino($this->get('id_arduino'));
            
            if($data->status_pemakaian==0)
                $data->status_pemakaian = 1;
            else
                $data->status_pemakaian = 0;
            
            $this->ta_model->update_arduino($data->id_arduino, $data);
            
            $this->response($data, 200);
        }
        
        
        public function mesin_get()
        {
            $data  = $this->ta_model->get_arduino($this->get('id_arduino'));
            $this->response($data, 200);
        }
        
        public function gantiMesin_get()
        {
            $data  = $this->ta_model->get_arduino($this->get('id_arduino'));
            
            if($data->status_mesin==0)
                $data->status_mesin = 1;
            else
                $data->status_mesin = 0;
            
            $this->ta_model->update_arduino($data->id_arduino, $data);
            
            $this->response($data, 200);
        }
        
        public function lokasi_get()
        {         
            
            $arduino = $this->ta_model->get_arduino($this->get('id_arduino'));
            if($arduino==null)
            {
                $ard = array(
                    'id_arduino' => $this->get('id_arduino'),
                    'nama' => '',
                    'email' => '',
                    'password' => '',
                    'status_pemakaian' => '1',
                    'status_mesin' => '1'
                );
                $this->ta_model->add_arduino($ard);
            }
            
            $koordinat   =   array(
                       'id_koordinat' => '',
                        'id_arduino' => $this->get('id_arduino'),
                        'longitude'      =>  $this->get('longitude'),
                        'latitude'      =>  $this->get('latitude'),				
                        ); 

            $data = null;
            if($this->get('id_arduino') && $this->get('longitude') && $this->get('latitude'))
            {				
                $data = $this->ta_model->add_koordinat($koordinat);
            }

            if($data!=null)
            {
                $temp = $this->ta_model->get_koordinat($this->get('id_arduino'), $this->get('latitude'), $this->get('longitude'));
                $this->response($temp, 200);
            }
            else
            {
                $this->response(array('id_koordinat' => -1, 'id_arduino' => 'xxxx',  'latitude' => 'xxx', 'longitude' => 'xxx' ), 200);
            }
				
        }
		
		

		

}