<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_modal extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}

	public function getCategoryBivideoId()
	{
		$this->db->select("category.*");
	    $this->db->from("video");
	    $this->db->join('category', 'category.id = video.category_id');
	    $this->db->group_by("category_id");
	    $this->db->order_by("category.name", "asc");
	    $query = $this->db->get();
		$result =  $query->result();
		return $result;
	}
	/*=================End User====================*/

	public function get_videoList($category_id=Null,$name=Null,$type=Null) {

		$this->db->select('video.*,category.name as category_name');
		$this->db->from('video');
		$this->db->join('category', 'category.id = video.category_id');
		$this->db->order_by("created_at", "desc");
		if($name)
		{
			$this->db->like('video.name', $name);
		}

		if($category_id > 0)
		{
			$this->db->where('category.id',$category_id);
		}

		if($type)
		{
			$this->db->where('video_type',$type);	
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function videoList($limit, $start,$category_id,$name=Null,$type=Null) {
		$offset = ($limit * $start) - $limit;
		$this->db->limit($limit, $offset);
		$this->db->select('video.*,category.name as category_name');
		$this->db->from('video');
		$this->db->join('category', 'category.id = video.category_id');
		if($name)
		{
			$this->db->like('video.name', $name);
		}
		if($category_id > 0)
		{
			$this->db->where('category.id',$category_id);
		}
		if($type)
		{
			$this->db->where('video_type',$type);	
		}
		$this->db->order_by("created_at", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_general_setting($data,$where){
		$this->db->where('key', $where);
		$this->db->update('general_setting', $data);
		return true;
	}
	
}