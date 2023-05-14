<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('frontendcheck')) {
    function frontendcheck()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $user = $CI->session->userdata();
        if (!isset($user['id'])) {
            redirect(base_url() . 'admin/login');
        } else {
            return TRUE;
        }
    }
}

function isInsert()
{
    $base_url = base_url();

    $strpos  = strpos($base_url, 'https://divinetechs.com');
    $strpos1  = strpos($base_url, 'https://www.divinetechs.com/envato/app/Dance/');

    if ($strpos === false && $strpos1 === false) {
        return 0;
    } else {
        return 1;
    }
}

// Eaasy to deug your class
function p($data)
{
    echo '<pre>';
    print_r($data);
    exit;
}

// number formate if number is 1000 then it will return 1k 
function no_format($num)
{
    if ($num > 1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }
    return $num;
}

// Easy to string cut and check start and end number 
function string_cut($string, $len)
{
    if (strlen($string) > $len) {
        $string = '<p title="' . $string . '">' . substr($string, 0, $len) . ' ...</p>';
    } else {
        $string = '<p>' . $string . '</p>';
    }
    return $string;
}

function get_setting()
{
    $CI = &get_instance();
    $CI->load->model('CRUD_model');
    $data = $CI->CRUD_model->get('', 'general_setting');
    return $data;
}

function get_smtp_setting()
{
    $CI = &get_instance();
    $CI->load->model('CRUD_model');

    $smtpWhere = 'id="1"';
    $data = $CI->CRUD_model->getById($smtpWhere, 'smtp_setting');

    $smtp_config['protocol']    = $data->protocol;
    $smtp_config['smtp_host']    = $data->host;
    $smtp_config['smtp_port']    = $data->port;
    $smtp_config['smtp_timeout'] = '7';
    $smtp_config['smtp_user']    = $data->user;
    $smtp_config['smtp_pass']    = $data->pass;
    $smtp_config['charset']    = 'utf-8';
    $smtp_config['newline']    = "\r\n";
    $smtp_config['mailtype'] = 'text'; // or html
    $smtp_config['validation'] = TRUE; // bool whether to validate email or not  


    return $smtp_config;
}

function dateformate($data)
{
    return date('Y-m-d', strtotime($data));
}

function curl($url = Null, $data = Null)
{
    $some_data = array();
    if ($data) {
        $some_data = $data;
    }

    $curl = curl_init();
    // We POST the data
    curl_setopt($curl, CURLOPT_POST, 1);
    // Set the url path we want to call
    curl_setopt($curl, CURLOPT_URL, $url);
    // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Insert the data
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);
    // Free up the resources $curl is using
    curl_close($curl);

    return  json_decode($result);
}

function get_image_path($image = "", $folder = "")
{
    $ci = &get_instance();
    $image_base_path = $ci->config->item('image_base_path');
    $image_base_url = $ci->config->item('image_base_url');

    // Thumbnail Img Check
    $thumbnail_img = $image_base_url . $folder . '/' . $image;


    if (empty($image)) {
        if ($folder == 'user') {
            $thumbnail_img = $image_base_url . 'user.png';
        } else {
            $thumbnail_img = $image_base_url . 'placeholder.png';
        }
    }
    if (!file_exists($image_base_path . $folder . '/' . $image)) {
        if ($folder == 'user') {
            $thumbnail_img = $image_base_url . 'user.png';
        } else {
            $thumbnail_img = $image_base_url . 'placeholder.png';
        }
    }
    return $thumbnail_img;
}
