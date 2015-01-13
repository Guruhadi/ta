<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Model pendaftaran NLC
 */

class webservice_model extends CI_Model{
    private  $table_member;
	private  $table_event;
	private  $table_checkin;
    
    public function __construct() {
        parent::__construct();
        $this->table_member     =   'user';
		$this->table_event     =   'event';
		$this->table_checkin     =   'checkin';
    }
    
    
    /*
     * Menambahkan member
     */
    function add_member($data){
        $this->db->insert($this->table_member, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
	function add_event($data){
        $this->db->insert($this->table_event, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	function add_checkin($data){
        $this->db->insert($this->table_checkin, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /*
     * Menampilkan seluruh member
     */
    function select_member()
    {
        $SQL    =   $this->db->get($this->table_member);
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
	
	function select_event()
    {
        $SQL    =   $this->db->get($this->table_event);
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
	
    function eventsnew($city, $now, $country, $category)
    {
        $SQL = "select * from event where LOWER(city) = LOWER( ? ) and tanggal >= '$now' and LOWER(country) = LOWER( '$country' ) and category like '%$category%' order by (tanggal) ASC";
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
	
	
	function enjoyevent($id)
    {
        $SQL = "select distinct  e.idevent, e.name, e.tanggal, e.location, e.waktu, e.performer, e.ticket_price, e.category, e.country, e.city, e.description, e.img, e.maplokasi  from checkin c, event e  where c.iduser = ? && c.idevent = e.idevent order by (c.idcheck) DESC";
        $query = $this->db->query($SQL, $id);
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
    function login($email,$pass)
    {
        $SQL = "select * from user where email = ? and pswd = '$pass'";
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
	
	function cekEmail($email)
	{
		$SQL = "select * from user where email = ?";
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
    
}

?>
