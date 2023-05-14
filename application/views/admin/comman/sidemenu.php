<?php
$setn = array();
$settinglist = get_setting();

foreach ($settinglist as $set) {
    $setn[$set->key] = $set->value;
}
$data['setn'] = $setn;

$menu = $this->uri->segment(2);
$menuName = isset($menu) ? $menu : 'dashboard';


$menusubmenu = $this->uri->segment(3);
$menuNameSubmenu = isset($menusubmenu) ? $menusubmenu : '';

?>
<div class="sidebar">
    <div class="side-head">
        <h2 class="bold"><?php echo string_cut($setn['app_name'], 9); ?></h2>
        <button class="btn side-toggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <ul class="side-menu">
        <li class="<?php if ($menuName == 'dashboard') {
                        echo 'active';
                    } ?>">

            <a href="<?php echo base_url(); ?>admin/dashboard">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/dashboard.png" alt="" />
                <span> Dashboard </span>
            </a>
        </li>
        <li class="<?php if ($menuName == 'category') {
                        echo 'active';
                    } ?>">
            <a href="<?php echo base_url(); ?>admin/category">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/categories.png" alt="" />
                <span> Category </span></a>
        </li>
        <li class="<?php if ($menuName == 'album') {
                        echo 'active';
                    } ?>">
            <a href="<?php echo base_url(); ?>admin/album">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/categories.png" alt="" />
                <span> Album </span></a>
        </li>

        <li class="<?php if ($menuName == 'users') {
                        echo 'active';
                    } ?>">
            <a href=" <?php echo base_url(); ?>admin/users">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/user.png" alt="" />
                <span>User</span>
            </a>
        </li>

        <li class="<?php if ($menuName == 'artist') {
                        echo 'active';
                    } ?> ">
            <a href="<?php echo base_url(); ?>admin/artist">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/artist.png" alt="" />
                <span>Artist</span>
            </a>
        </li>

        <li class="<?php if ($menuName == 'video') {
                        echo 'active';
                    } ?> ">
            <a href="<?php echo base_url(); ?>admin/video">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/videos.png" alt="" />
                <span>Video</span>
            </a>
        </li>
        <li class="<?php if ($menuName == 'page') {
                        echo 'active';
                    } ?>">
            <a href="<?php echo base_url(); ?>admin/page">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/pages.png" alt="" />
                <span>Pages</span>
            </a>
        </li>
        <li class="<?php if ($menuName == 'package') {
                        echo 'active';
                    } ?>">
            <a href="<?php echo base_url(); ?>admin/package">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/package.png" alt="" />
                <span>Package</span>
            </a>
        </li>
        <li class="<?php if ($menuName == 'setting' and $menuNameSubmenu == '') {
                        echo 'active';
                    } ?>">
            <a href="<?php echo base_url(); ?>admin/setting">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/settings.png" alt="" />
                <span>Settings</span>
            </a>
        </li>

        <li class="<?php if ($menuName == 'notification' and $menuNameSubmenu == '') {
                        echo 'active';
                    } ?>">
            <a href="<?php echo base_url(); ?>admin/notification">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/notification.png" alt="" />
                <span>Notification</span>
            </a>
        </li>

        <li>
            <a href="<?php echo base_url(); ?>admin/Login/logout">
                <img class="menu-icon" src="<?php echo base_url(); ?>assets/imgs/logout.png" alt="" />
                <span>Logout</span>
            </a>
        </li>
    </ul>

</div>

<div class="right-content">
    <header class="header">
        <div class="title-control">
            <button class="btn side-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="#">
                <img src="<?php echo base_url(); ?>assets/imgs/logo.png" alt="" class="side-logo" />
            </a>
            <h1 class="page-title text-capitalize"><?php echo $menuName; ?></h1>
        </div>
        <div class="head-control">
            <!-- <div class="input-group head-search">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                  <img src="assets/imgs/search.png" />
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                aria-describedby="basic-addon1">
              <button class="d-md-none mobile-close-search">
                <span></span>
                <span></span>
              </button>
            </div> -->
            <!-- <a href="#" class="btn head-btn  d-none d-md-flex">
              <img src="<?php echo base_url(); ?>assets/imgs/setting-colored.png" />
            </a> -->
            <div class="dropdown dropright">
                <!-- <a class="btn dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Dropdown link
              </a> -->
                <a href="#" class="btn head-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/imgs/avatar.png" class="avatar-img" />
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/Login/logout">Logout</a>
                </div>
            </div>
        </div>
    </header>