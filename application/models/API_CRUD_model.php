<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class API_CRUD_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function p($data)
    {
        echo '<pre>';
        print_r($data);
        exit;
    }

    public function getvideoCount($id)
    {
        $this->db->select('count(id) as total_video,sum(v_view) as total_view, sum(v_like) as total_like');
        $this->db->where('artist_id', $id);
        return $result = $this->db->get('video')->row();
    }
    public function avg_rating($video_id)
    {
        $this->db->select('AVG(rating) as average');
        $this->db->where('video_id', $video_id);
        return $result = $this->db->get('ratings')->row();
    }

    public function view_website($where)
    {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->where($where);
        $this->db->update('website_analysis');
    }

    public function get_book_id($id)
    {
        $this->db->select("*");
        $this->db->from("book");
        $this->db->where_in('id', $id);
        $q = $this->db->get();
        return $q->result();
    }

    // Get count 
    public function getCount($where, $tablename)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }

    public function updateByIdWithcount($id, $field_name, $value, $tablename)
    {
        $this->db->set($field_name, $field_name . '+' . $value, FALSE);
        $this->db->where('id', $id);
        $this->db->update($tablename);
        return $id;
    }

    public function subtractCountById($id, $field_name, $value, $tablename)
    {
        $this->db->set($field_name, $field_name . '-' . $value, FALSE);
        $this->db->where('id', $id);
        $this->db->update($tablename);
        return $id;
    }

    public function get($where, $tablename, $field_name = null, $order_by = 'desc')
    {
        $this->db->select('*');
        $this->db->from($tablename);
        if (!empty($where)) {
            $this->db->where($where);
        }
        if ($field_name) {
            $this->db->order_by($field_name, $order_by);
        }
        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }

    public function getById($where, $tablename)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function get_book_ids($id)
    {
        $this->db->select("book.*,category.name as category_name,category.image as category_image, author.name as author_name,author.image as author_image");
        $this->db->from("book");
        $this->db->join('category', 'category.id = book.category_id');
        $this->db->join('author', 'author.id = book.author_id');
        $this->db->where_in('book.id', $id);
        $q = $this->db->get();
        return $q->result();
    }

    public function allbook($user_id)
    {
        $this->db->select("book.*,category.name as category_name,category.image as category_image, author.name as author_name,author.image as author_image");
        $this->db->from("continue_read");
        $this->db->join('book', 'book.id = continue_read.book_id');
        $this->db->join('category', 'category.id = book.category_id');
        $this->db->join('author', 'author.id = book.author_id');
        $this->db->where("continue_read.user_id", $user_id);
        $q = $this->db->get();
        return $q->result();
    }

    public function allBookWithBookmark($user_id)
    {
        $this->db->select("book.*,category.name as category_name,category.image as category_image, author.name as author_name,author.image as author_image");
        $this->db->from("continue_read");
        $this->db->join('book', 'book.id = continue_read.book_id');
        $this->db->join('category', 'category.id = book.category_id');
        $this->db->join('author', 'author.id = book.author_id');
        $this->db->where("continue_read.user_id", $user_id);
        $q = $this->db->get();
        return $q->result();
    }
    public function get_join($data)
    {
        $where = isset($data['where']) ? $data['where'] : '';
        $whereIn = isset($data['where_in']) ? $data['where_in'] : '';
        $group_by = isset($data['group_by']) ? $data['group_by'] : '';
        $order_by_field = isset($data['order_by_field']) ? $data['order_by_field'] : $data['table'] . '.id';
        $order_by = isset($data['order_by']) ? $data['order_by'] : 'DESC';
        $page_no = isset($data['page_no']) ? $data['page_no'] : '1';
        $page_limit = isset($data['page_limit']) ? $data['page_limit'] : $this->config->item('page_limit');

        $this->db->select($data['field']);
        $this->db->from($data['table']);

        if (isset($data['joins'])) {
            foreach ($data['joins'] as $joins) {
                $this->db->join($joins['table'], $joins['join']);
            }
        }

        if ($where) {
            foreach ($where as $value) {
                $this->db->where($value);
            }
        }

        if ($whereIn) {

            foreach ($whereIn as $value) {

                $this->db->where("FIND_IN_SET(" . $value['value'] . ",`" . $value['key'] . "`) <>", '0');
            }
        }

        if ($order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }

        if ($group_by) {
            $this->db->group_by($group_by);
        }

        $num_rows = $this->db->count_all_results('', false);

        if ($page_no) {
            $offset = ($page_limit * $page_no) - $page_limit;
            $this->db->limit($page_limit, $offset);
        }

        $query = $this->db->get();

        $row = $query->result();


        return $row;
    }

    public function get_join_pagination($data)
    {
        $where = isset($data['where']) ? $data['where'] : '';
        $whereIn = isset($data['where_in']) ? $data['where_in'] : '';
        $group_by = isset($data['group_by']) ? $data['group_by'] : '';
        $order_by_field = isset($data['order_by_field']) ? $data['order_by_field'] : $data['table'] . '.id';
        $order_by = isset($data['order_by']) ? $data['order_by'] : 'DESC';
        $page_no = isset($data['page_no']) ? $data['page_no'] : '1';
        $page_limit = isset($data['page_limit']) ? $data['page_limit'] : $this->config->item('page_limit');

        $this->db->select($data['field']);
        $this->db->from($data['table']);

        if (isset($data['joins'])) {
            foreach ($data['joins'] as $joins) {
                $this->db->join($joins['table'], $joins['join']);
            }
        }

        if ($where) {
            foreach ($where as $value) {
                $this->db->where($value);
            }
        }

        if ($whereIn) {

            foreach ($whereIn as $value) {

                $this->db->where("FIND_IN_SET(" . $value['value'] . ",`" . $value['key'] . "`) <>", '0');
            }
        }

        if ($order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }

        if ($group_by) {
            $this->db->group_by($group_by);
        }

        $num_rows = $this->db->count_all_results('', false);

        if ($page_no) {
            $offset = ($page_limit * $page_no) - $page_limit;
            $this->db->limit($page_limit, $offset);
        }
        $query = $this->db->get();

        $row['total_record'] = $num_rows;
        $row['result'] = $query->result();

        return $row;
    }
    public function get_join_allrecord($table1, $table2, $joinid, $field, $where = '', $order_by_field = '', $order_by = 'DESC')
    {
        $this->db->select($field);
        $this->db->from($table1);
        $this->db->join($table2, $joinid);
        if ($where) {
            $this->db->where($where);
        }

        if ($order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }
        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }

    public function get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where = '', $order_by_field = '', $order_by = 'DESC')
    {
        $this->db->select($field);
        $this->db->from($table1);
        $this->db->join($table2, $joinid1);
        $this->db->join($table3, $joinid2);



        if ($where) {
            $this->db->where($where);
        }

        if ($order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }

        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }


    public function get_two_join_all_record($table1, $table2, $table3, $joinid1, $joinid2, $field, $where = '', $order_by_field = '', $order_by = 'DESC')
    {
        $this->db->select($field);
        $this->db->from($table1);
        $this->db->join($table2, $joinid1);
        $this->db->join($table3, $joinid2);
        if ($where) {
            $this->db->where($where);
        }
        if ($order_by_field) {
            $this->db->order_by($order_by_field, $order_by);
        }

        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }
    public function getLastRecord($where, $tablename)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($where);
        $this->db->limit(1);
        $this->db->order_by('id', "desc");
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function insert($data, $tablename)
    {
        $data = $this->security->xss_clean($data);
        $insert = [];
        foreach ($data as  $key => $value) {
            $insert[$key] = $this->db->escape_str($value);
        }

        $query = $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }

    public function update($id, $field_name, $data, $tablename)
    {

        $data = $this->security->xss_clean($data);
        $insert = [];
        foreach ($data as  $key => $value) {
            $insert[$key] = $this->db->escape_str($value);
        }

        $this->db->where($field_name, $id);
        $this->db->update($tablename, $insert);
        return $id;
    }

    public function  delete($where, $tablename)
    {
        $this->db->where($where);
        $this->db->delete($tablename);
        return true;
    }

    public function delete_all($id, $field_name, $tablename)
    {
        $this->db->where($field_name, $id);
        $this->db->delete($tablename);
        return true;
    }

    public function imageupload($imageName, $imgname, $uploadpath, $widths = 2000, $heights = 2000)
    {

        if (empty($imageName['name'])) {
            $res = array('status' => '400', 'message' => 'Please Upload Image first.');
            echo json_encode($res);
            exit;
        }
        if (!empty($imageName['name']) && ($imageName['error'] == 1 || $imageName['size'] > 2215000)) {
            $res = array('status' => '202', 'message' => 'Max 2MB file is allowed for image.');
            echo json_encode($res);
            exit;
        } else {
            list($width, $height) = getimagesize($imageName['tmp_name']);
            if ($width > $widths || $height > $heights) {
                $res = array('status' => '201', 'message' => 'Image height and width must be less than height .' . $heights . ' and width ' . $widths);
                echo json_encode($res);
                exit;
            } else {

                $catImg = $imageName['name'];
                $ext = pathinfo($catImg);
                $catImages = str_replace(array(' ', '.', '-', '`'), '_', $ext['filename']);
                $category_image = time() . '.' . $ext['extension'];
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

    public function videoupload($imageName, $imgname, $uploadpath)
    {
        if (empty($imageName['name'])) {
            $res = array('status' => '400', 'message' => 'Please Upload Image first.');
            echo json_encode($res);
            exit;
        }

        $catImg = $imageName['name'];
        $ext = pathinfo($catImg);
        $catImages = str_replace(array(' ', '.', '-', '`'), '_', $ext['filename']);
        $category_image = time() . '.' . $ext['extension'];
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

    public function get_favorite_list_video($user_id)
    {
        $this->db->select("video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image");
        $this->db->from("favorite");
        $this->db->join('video', 'video.id = favorite.video_id');
        $this->db->join('artist', 'artist.id = video.artist_id');
        $this->db->join('category', 'category.id = video.category_id');
        $this->db->where('favorite.user_id', $user_id);
        $this->db->order_by("favorite.created_at", "desc");
        $q = $this->db->get();
        return $q->result();
    }
}
