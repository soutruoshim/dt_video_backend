<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class CRUD_model extends CI_Model
{
    
  public function __construct()
  {
    $this->load->database();
  }

  public function p($data)
  {
    echo '<pre>';
    print_r($data);exit;
  }

  public function view_website($where){
    $this->db->set('views', 'views+1', FALSE);
    $this->db->where($where);
    $this->db->update('website_analysis');
  }
   

  // Get count 
  public function getCount($where,$tablename)
  {
    $this->db->select('count(id) as total');
    $this->db->from($tablename);
    if(!empty($where)){
      $this->db->where($where);
    }
    $query = $this->db->get();
    $row = $query->row();
    return $row;
  }

  public function updateByIdWithcount($id,$field_name,$value,$tablename){
    $this->db->set($field_name, $field_name.'+'.$value, FALSE);
    $this->db->where('id', $id);
    $this->db->update($tablename);
    return $id; 
  } 

  public function updateById($id,$field_name,$data,$tablename){
    $isInsert = isInsert();
    if($isInsert  == 1)
    {
      return true;
    }
    $this->db->where($field_name, $id);
    $this->db->update($tablename, $data);
    return $id; 
  } 

  public function get($where,$tablename,$field_name=null,$order_by='desc')
  {
    $this->db->select('*');
    $this->db->from($tablename);
    if(!empty($where)){
      $this->db->where($where);
    }
    if($field_name){
      $this->db->order_by($field_name, $order_by);
    }
    $query = $this->db->get();
    $row = $query->result();
    return $row;
  }

	public function getById($where,$tablename)
	{
		$this->db->select('*');
		$this->db->from($tablename);
		if(!empty($where)){
			$this->db->where($where);
		}
    $query = $this->db->get();
		$row = $query->row();
		return $row;
	}

  public function get_join_allrecord($table1, $table2, $joinid, $field, $where = Null) {
    $this->db->select($field);
    $this->db->from($table1);
    $this->db->join($table2, $joinid);
    $query = $this->db->get();
    $row = $query->result();
    return $row;
  }

  public function get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field) {
    $this->db->select($field);
    $this->db->from($table1);
    $this->db->join($table2, $joinid1);
    $this->db->join($table3, $joinid2);
    $query = $this->db->get();
    $row = $query->result();
    return $row;
  }

  public function get_all_active_category($table1, $table2, $joinid, $field, $where = Null) {
    $this->db->select($field);
    $this->db->from($table1);
    $this->db->join($table2, $joinid);
    $this->db->group_by('category.name');
    $query = $this->db->get();
    $row = $query->result();
    return $row;
  }


  public function getLastRecord($where,$tablename)
  {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where($where);
    $this->db->limit(1);
    $this->db->order_by('id',"desc");
    $query = $this->db->get();
    $row = $query->row();
    return $row;
  }

  public function insert($data,$tablename){
    $isInsert = isInsert();
    
    if($isInsert  == 1)
    {
      return true;
    }
    $data = $this->security->xss_clean($data);
   
    $query = $this->db->insert($tablename,$data);
    return $this->db->insert_id();
  }

  public function update($id,$field_name,$data,$tablename){
    $isInsert = isInsert();
    if($isInsert  == 1)
    {
      return true;
    }
    $data = $this->security->xss_clean($data);
    $insert = [];
    
    $this->db->where($field_name, $id);
    $this->db->update($tablename, $data);
    return $id; 
  }

  public function update_currency()
  {
    $insert['status'] = 0;
    $this->db->update('currency', $insert);
  }

  public function  delete($where,$tablename)
  {

    $isInsert = isInsert();
    if($isInsert  == 1)
    {
      return true;
    }
    $this->db->where($where);
    $this->db->delete($tablename);
    return true;
  }

  public function delete_all($id,$field_name,$tablename)
  {
    $isInsert = isInsert();
    if($isInsert  == 1)
    {
      return true;
    }
    $this->db->where($field_name, $id);
    $this->db->delete($tablename);
    return true; 
  }

  public function imageupload($imageName,$imgname, $uploadpath,$widths=2500,$heights=2500){

    if (!file_exists($uploadpath)) {
        mkdir($uploadpath, 0777, true);
    }
    
    if(empty($imageName['name'])){
      $res=array('status'=>'400','message'=>'Please Upload Image first.');
      echo json_encode($res);exit;
    }
    if(!empty($imageName['name']) && ($imageName['error']==1 || $imageName['size']>3215000)){
      $res=array('status'=>'202','message'=>'Max 2MB file is allowed for image.');
      echo json_encode($res);exit;
    }else{
      list($width, $height) = getimagesize($imageName['tmp_name']);
      if($width>$widths || $height >$heights){
        $res=array('status'=>'201','message'=>'Image height and width must be less than height .'.$heights.' and width '.$widths);
        echo json_encode($res);exit;
      }else{

        $catImg = $imageName['name'];
        $ext = pathinfo($catImg);
        $catImages = str_replace(array(' ', '.', '-', '`'), '_', $ext['filename']);
        $category_image =time().'.'.$ext['extension'];       
        $config = array(
          'allowed_types' => 'jpg|jpeg|gif|png',
          'upload_path' => $uploadpath,
          'file_name' => $category_image
        );
        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload($imgname);
        return $category_image;
      }

    }
  }

  public function videoupload($imageName,$imgname, $uploadpath){

      if(empty($imageName['name'])){
        $res=array('status'=>'400','message'=>'Please Upload Image first.');
        echo json_encode($res);exit;
      } 

      $catImg = $imageName['name'];
      $ext = pathinfo($catImg);
      $catImages = str_replace(array(' ', '.', '-', '`'), '_', $ext['filename']);
      $category_image =time().'.'.$ext['extension'];       
      $config = array(
        'allowed_types' => '*',
        'upload_path' => $uploadpath,
        'file_name' => $category_image
      );
      $this->load->library('upload');
      $this->upload->initialize($config);
      $this->upload->do_upload($imgname);
      return $category_image;
  }

  function make_query($table,$select_column,$order_column,$searcharray=null,$where=null)  
  {  
      $this->db->select($select_column);  
      $this->db->from($table);

      if(isset($_POST["search"]["value"]))  
      {
        if($searcharray)
        {  
          foreach ($searcharray as $key => $value) {
            $this->db->or_like($value, $_POST["search"]["value"]);  
          }
        }
      }
    
      if($where != '')
      {  
        $this->db->where($where);
      }
     

      if(isset($_POST["order"]))  
      {  
        $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
      }  
      else  
      {  
        $this->db->order_by('id', 'DESC');  
      }  
  }  

  function make_datatables($table,$select_column,$order_column,$search=null,$where=null){  

      $this->make_query($table,$select_column,$order_column,$search,$where);  



      if($_POST["length"] != -1)  
      {  
          $this->db->limit($_POST['length'], $_POST['start']);  
      }  
      $query = $this->db->get();  
      return $query->result();  
  }
     
  function get_filtered_data($table,$select_column,$order_column,$search=null,$where=null){  
      $this->make_query($table,$select_column,$order_column,$search=null,$where);  
      $query = $this->db->get();  
      return $query->num_rows();  
  } 

  function get_all_data($table)  
  {   
      $this->db->select("*");  
      $this->db->from($table);  
      return $this->db->count_all_results();  
  }
}
?>
