<?php
  $this->load->view('admin/comman/header');
  $setn=array(); 
  foreach($settinglist as $set){
    $setn[$set->key]=$set->value;
  }
?>
<div class="body-content">
    <!-- mobile title -->
    <h1 class="page-title-sm">Dashboard</h1>

    <div class="row counter-row">

        <div class="col-6 col-sm-4 col-md col-lg-4 col-xl">
            <div class="db-color-card">
                <img src="<?php echo base_url();?>assets/imgs/video-green.png" alt="" class="card-icon" />
                <div class="dropdown dropright">
                    <a href="#" class="btn head-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo base_url();?>assets/imgs/dot.png" class="dot-icon" />
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url();?>admin/video">List</a>
                    </div>
                </div>
                <h2 class="counter">
                    <?php echo isset($video) ? $video  : 0;?>
                    <span>Video</span>
                </h2>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md col-lg-4 col-xl">
            <div class="db-color-card cate-card">
                <img src="<?php echo base_url();?>assets/imgs/categories-purple.png" alt="" class="card-icon" />
                <div class="dropdown dropright">
                    <a href="#" class="btn head-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo base_url();?>assets/imgs/dot.png" class="dot-icon" />
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url();?>admin/category">List</a>
                    </div>
                </div>
                <h2 class=" counter">
                    <?php echo isset($category) ? $category : 0;?>
                    <span>Category</span>
                </h2>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md col-lg-4 col-xl">
            <div class="db-color-card user-card">
                <img src="<?php echo base_url();?>assets/imgs/user-brown.png" alt="" class="card-icon" />
                <div class="dropdown dropright">
                    <a href="#" class="btn head-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo base_url();?>assets/imgs/dot.png" class="dot-icon" />
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url();?>admin/users">list</a>
                    </div>
                </div>
                <h2 class="counter">
                    <?php echo isset($user) ? $user : 0;?>
                    <span>Users</span>
                </h2>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md col-lg-4 col-xl">
            <div class="db-color-card artist-card">
                <img src="<?php echo base_url();?>assets/imgs/artist-blue.png" alt="" class="card-icon" />
                <div class="dropdown dropright">
                    <a href="#" class="btn head-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo base_url();?>assets/imgs/dot.png" class="dot-icon" />
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo base_url();?>admin/artist">List</a>
                    </div>
                </div>
                <h2 class="counter">
                    <?php echo isset($artist) ? $artist : 0;?>
                    <span>Artist</span>
                </h2>
            </div>
        </div>

    </div>
    <?php $this->load->view('admin/comman/footerpage');?>