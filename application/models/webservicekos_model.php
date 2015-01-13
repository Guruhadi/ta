<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class webservicekos_model extends CI_Model{
    private  $table_kos;
	private  $table_keterangan;
    
    public function __construct() {
        parent::__construct();
        $this->table_kos     =   'kos';
		$this->table_keterangan     =   'keterangan';
		$this->table_pengguna = 'pengguna';
    }
    
    

    function add_kos($data){
        $this->db->insert($this->table_kos, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return null;
        }
    }
    
	function add_pengguna($data){
        $this->db->insert($this->table_pengguna, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return null;
        }
    }
	
	function add_keterangan($data){
        $this->db->insert($this->table_keterangan, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    function select_all_kos()
    {
        $SQL    =   $this->db->get($this->table_kos);
        if($SQL->num_rows() > 0)
        {
            foreach ($SQL->result() as $row) {
                $data[] =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
    }
	
	function select_kos_gender($gender)
	{
		if($gender=='pria') $gender = 'kostan pria';
		else $gender = 'kostan wanita';
		$SQL = "select k.id_kos, k.nama, k.alamat, k.latitude, k.longitude, k.harga, k.tampakdepan, k.streetview  from kos k , keterangan kn where k.id_kos = kn.kos_id and kn.detail like '%$gender'";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() > 0)
        {
            foreach ($query->result() as $row) {
                $data[] =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
	}
	
	function login($email, $password)
	{
		$SQL = "select * from pengguna where email = ? and pass = '$password'";
        $query = $this->db->query($SQL, $email);
        if($this->db->affected_rows() == 1)
        {
            foreach($query->result() as $row)
            {
                return $row;
    
            }
        }
        else
        {
            return null;
        }
	}
	
	function select_kos($id_kos)
	{
		$SQL = "select * from kos where id_kos = ?";
        $query = $this->db->query($SQL, $id_kos);
        if($this->db->affected_rows() == 1)
        {
            foreach($query->result() as $row)
            {
                return $row;
    
            }
        }
        else
        {
            return null;
        }
	}
	
	function select_kos_koordinat($name, $langitude, $latitude)
	{
		$SQL = "select * from kos where longitude = ? and latitude = '$latitude'";
        $query = $this->db->query($SQL, $langitude);
        if($this->db->affected_rows() == 1)
        {
            foreach($query->result() as $row)
            {
                return $row;
    
            }
        }
        else
        {
            return null;
        }
	}
	
    function detail_kos($kos_id)
    {
        $SQL = "select * from keterangan where keterangan.kos_id = ? ";
        $query = $this->db->query($SQL, $kos_id);
        if($this->db->affected_rows() > 0)
        {
            foreach ($query->result() as $row) {
                $data[] =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
    }
	
	function select_all_user()
    {
        $SQL = "select email from pengguna";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() > 0)
        {
            foreach ($query->result() as $row) {
                $data[] =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
    }
	      
}

?>
