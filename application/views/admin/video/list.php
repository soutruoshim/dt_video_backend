<?php
    $this->load->view('admin/comman/header');

    $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
    $type = isset($_GET['video_type']) ? $_GET['video_type'] : '';
    $name = isset($_GET['name']) ? $_GET['name'] : '';
?>

<div class="body-content">
    <!-- mobile title -->
    <h1 class="page-title-sm">Videos</h1>
    <form class="">
        <div class="page-search">
            <div class="input-group">
                <div class="input-group-prepend">
                    <a href="#" class="btn btn-3d" id="search_category">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="<?php echo base_url();?>/assets/imgs/search.png">
                        </span>
                    </a>
                </div>
                <input type="text" class="form-control video_search" name="name" value="<?php echo $name;?>" placeholder="Search"
                    aria-label="Search" aria-describedby="basic-addon1">
            </div>
            <div class="sorting">
                <label>
                    Sort by :
                </label>
                <select id="category_id" class="form-control">
                    <option>All Category</option>
                    <?php foreach($category as $row){?>
                    <option <?php if($category_id == $row->id) { echo 'selected'; }?> value="<?php echo $row->id;?>">
                        <?php echo $row->name;?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
            <a href="<?php echo base_url();?>admin/video/add" class="add-video-btn">
                <img src="<?php echo base_url();?>/assets/imgs/add.png" alt="" class="icon" />
                Add new video
            </a>
        </div>

        <?php 
            if (count($video) > 0) {
            $i=1;
            foreach ($video as $vid) {
                $base_path = $_SERVER['DOCUMENT_ROOT'];
                $base_path .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        
                $img_url = base_url().'assets/images/video/'.$vid['image'];
                if (!file_exists($base_path.'/assets/images/video/'.$vid['image'])) {
                    $img_url = base_url().'assets/images/placeholder.png';
        } ?>

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
            <div class="card video-card">
                <div class="position-relative">
                    <img class="card-img-top" src="<?php echo $img_url;?>" alt="">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php  echo string_cut($vid['name'], 30); ?></h5>
                    <div class="dropdown dropright">
                        <a href="#" class="btn head-btn" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img src="<?php echo base_url();?>/assets/imgs/dot.png" class="dot-icon" />
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <!-- <a class="dropdown-item" href="#"> <img src="<?php echo base_url();?>/assets/imgs/view.png" class="dot-icon" /> Status</a> -->
                            <a class="dropdown-item"
                                href="<?php echo base_url();?>admin/video/edit?id=<?php echo $vid['id']; ?>">
                                <img src="<?php echo base_url();?>/assets/imgs/edit.png" class="dot-icon" />
                                Edit
                            </a>
                            <a class="dropdown-item" href="javaScript:void(0)"
                                onclick="delete_record('<?php echo $vid['id']; ?>','video')">
                                <img src="<?php echo base_url();?>/assets/imgs/trash.png" class="dot-icon" />
                                Delete
                            </a>
                        </div>
                    </div>
                    <div class="card-details">
                        <?php  echo string_cut($vid['category_name'], 20); ?>
                        <!--  <p class="tag">#tag</p> -->
                    </div>
                </div>
            </div>
        </div>
        <?php  } } ?>
    </div>

    <?php 
            $pageno = $pagination['page']; 
            $total_pages = $pagination['total_pages']; 

            $start_number =$pageno;

            if($pageno > 1)
            {
                $start_number = $pageno - 1;
            } 

            if($total_pages == $pageno)
            {
                $end_number = $pageno;
            }
            else
            {
                $end_number = $pageno +3;
            }

            if($category_id > 0 )
            {
                $base_url = base_url().'admin/video?category_id='.$category_id.'&page=';  
            }else
            {
                $base_url = base_url().'admin/video?page=';
            }
        ?>
    <nav class="d-flex justify-content-center">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link " href="<?php echo  base_url();?>admin/video" tabindex="-1">
                    <img src="<?php echo base_url();?>/assets/imgs/left-arrow.png" />
                </a>
            </li>
            <?php if($pageno <= 1){}else{ ?>
            <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php echo  $base_url.($pageno - 1);?>">Prev</a>
            </li>
            <?php } ?>
            <?php for ($i = $start_number; $i < $end_number; $i++){ $url = $base_url.$i;?>
            <li class="page-item <?php if($pageno == $i){ echo 'active'; }?>">
                <a class="page-link" href="<?php echo $url; ?>" id="page[<?php echo $i;?>]"> <?php echo $i;?></a>
            </li>
            <?php } ?>

            <?php if($pageno >= $total_pages){ }else{?>
            <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php echo  $base_url.($pageno + 1); ?>">Next</a>
            </li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" href="#">
                    <img src="<?php echo base_url();?>/assets/imgs/left-arrow.png" class="right-arrow" />
                </a>
            </li>
        </ul>
    </nav>
    <nav class="pull-left">
        <?php $totla_record = isset($pagination['totla_record']) ? $pagination['totla_record'] : 0; ?>
        <?php
                if($pageno > 1 ){
                    $current_show_no =  ($pageno - 1) * ($pagination['per_page']) ; 
                    $end_show_no  =$pagination['per_page'] *$pageno ;
                }else
                {
                    $current_show_no =  1 ;
                    $end_show_no  =$pagination['per_page'] *$pageno ;
                }

                if($total_pages == $pageno)
                {       
                    if($total_pages == 1)
                    {
                        $end_show_no = count($video);
                    }else
                    {
                        $end_show_no = $current_show_no + count($video);
                    }
                }
            ?>
        Showing <?php echo $current_show_no ; ?> to <?php echo $end_show_no ; ?> of <?php echo $totla_record; ?> entries
    </nav>
</div>

<div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent">
            <div class="modal-body p-0 bg-transparent">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <video id='video' controls="controls" preload='none' class="w-100"
                    poster="https://assets.codepen.io/32795/poster.png">
                    <source id='mp4' src="http://media.w3.org/2010/05/sintel/trailer.mp4" type='video/mp4' />
                </video>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/comman/footerpage');?>
<script>

$('#search_category').on('click', function() {
    var video_name = $('.video_search').val();
    if (video_name) {
        window.location.replace('<?php echo base_url(); ?>admin/video?name=' + video_name);
    } else {
        window.location.replace('<?php echo base_url(); ?>admin/video');
    }
})

$('#category_id').on('change', function() {
    var category_id = $(this).val();
    if (category_id > 0) {
        window.location.replace('<?php echo base_url(); ?>admin/video?category_id=' +
            category_id);
    } else {
        window.location.replace('<?php echo base_url(); ?>admin/video');
    }
})
$('#type').on('change', function() {
    var type = $(this).val();
    if (type) {
        window.location.replace('<?php echo base_url(); ?>admin/video?type=' + type);
    } else {
        window.location.replace('<?php echo base_url(); ?>admin/video');
    }
})
$(document).ready(function() {
    $('#default-datatable').DataTable();
});


function update_status(id, status) {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/video/update_video_status',
        data: {
            'id': id,
            'status': status
        },
        success: function(resp) {
            var obj = JSON.parse(resp);
            var text = '';
            if (obj.video_status == '1') {
                text =
                    '<div class="pull-right bottom-view"> <a style="color: #ffffff;"  href="#" onclick="update_status(' +
                    id + ',' + obj.video_status +
                    ')"> <i class="fa fa-toggle-on"></i></a> </div>';
            } else {
                text =
                    '<div class="pull-right bottom-view"> <a style="color: #ffffff;"  href="#" onclick="update_status(' +
                    id + ',' + obj.video_status +
                    ')"> <i class="fa fa-toggle-off"></i></a> </div>';
            }
            $('.update_status_' + id).html(text);
        }
    });
}
</script>