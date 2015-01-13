<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ta_model extends CI_Model{
    private  $table_arduino;
    private  $table_koordinat;

    
    public function __construct() {
        parent::__construct();
        $this->table_arduino     =   'arduino';
        $this->table_koordinat     =   'koordinat';        
    }
    
    
    
    function add_arduino($data){
        $this->db->insert($this->table_arduino, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function update_arduino($id_arduino, $data)
    {
        $this->db->where('id_arduino', $id_arduino);
        $this->db->update($this->table_arduino, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function add_koordinat($data){
        $this->db->insert($this->table_koordinat, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
		
    function select_arduino()
    {
        $SQL    =   $this->db->get($this->table_arduino);
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
	
    function select_koordinat()
    {
        $SQL    =   $this->db->get($this->table_koordinat);
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
	
    function get_arduino($id_arduino)
    {
        $SQL = "select * from arduino where id_arduino = $id_arduino";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() == 1)
        {
            foreach ($query->result() as $row) {
                $data =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
    }
    
    function get_koordinat($id_arduino, $latitude, $longitude)
    {
        $SQL = "select * from koordinat where latitude = '$latitude' and longitude = '$longitude' and id_arduino = $id_arduino";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() > 0)
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
        

    function koordinatsnew($city, $now, $country, $category)
    {
        $SQL = "select * from koordinat where LOWER(city) = LOWER( ? ) and tanggal >= '$now' and LOWER(country) = LOWER( '$country' ) and category like '%$category%' order by (tanggal) ASC";
        $query = $this->db->query($SQL, $city);
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
