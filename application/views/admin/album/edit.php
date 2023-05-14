<?php $this->load->view('admin/comman/header'); ?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Album </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="edit_album_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="input-1"> Name</label>
                        <input type="text" name="name" class="form-control col-8" id="name" value="<?php echo $album->name?>"
                            placeholder="Enter Your album Name">

                             <input type="hidden" name="id"  value="<?php echo $album->id?>"
                            placeholder="Enter Your album Name">
                    </div>
                    <div class="form-group">
                        <label for="input-1"> Video</label>
                        <select class="form-control selectd2" multiple name="video_ids[]" id="video_id">
                            <?php
                            $a =explode(",",$album->video_ids);
                            foreach ($videos as $item){?> 
                                <option value="<?php echo  $item->id;?>" <?php if(in_array($item->id, $a)){ echo 'selected'; }?> ><?php echo $item->name;?> </option>
                           <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="input-2"> Image</label>
                        <div class="custom-file">
                            <input type="file" name="image"  class="custom-file-input" onchange="readURL(this,'showImage')">
                            <label class="custom-file-label col-8" for="customFileLangHTML" data-browse="Bestand kiezen">Select Image</label>
                        </div>
                        <p class="noteMsg">Note: Image Size must be lessthan 2MB.Image Height and Width less than 1000px.</p>
                        <img id="showImage" src="<?php echo base_url().'assets/images/album/'.$album->image; ?>" height="150"
                            width="150" alt="your image" />
                    </div>
                
                    <div class="form-group">
                        <button type="button" onclick="updatealbum()" class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url()?>admin/album" class="btn btn-dark mw-120"> Cancel </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
   $this->load->view('admin/comman/footerpage');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#video_id").select2();
        $(".selectd2").select2({
        placeholder: "Select Video"
        });
    });
     
function updatealbum() {
   
    $("#dvloader").css('display', 'block');
    $("body").addClass('overlay');

    var formData = new FormData($("#edit_album_form")[0]);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/album/update',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(resp) {
            if (resp.status == '200') {
                $("#dvloader").css('display', 'none');
                $("body").removeClass('overlay');
                toastr.success(resp.message);
                window.location.replace(
                    '<?php echo base_url(); ?>admin/album');
            } else {
                toastr.error(resp.message);
                $("#dvloader").hide();
            }
        }
    });
}
</script>

