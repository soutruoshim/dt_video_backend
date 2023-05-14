<!DOCTYPE html>
<html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
    $setn=array(); 
    $settinglist = get_setting(); 

    foreach($settinglist as $set){
        $setn[$set->key]=$set->value;
    }
    $data['setn'] = $setn;
?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $setn['app_name'];?></title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/select2/select2.min.css" />
    </head>
<body>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
<?php $this->load->view('admin/comman/sidemenu');?>