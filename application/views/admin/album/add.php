<?php $this->load->view('admin/comman/header'); ?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header"> Album </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="album_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="input-1"> Name</label>
                        <input type="text" name="name" class="form-control col-8" id="name" placeholder="Enter Your album Name">
                    </div>
                    <div class="form-group">
                        <label for="input-1"> Video</label>
                        <select class="form-control selectd2" multiple name="video_ids[]" id="video_id">
                            <?php foreach ($videos as $item){?> 
                                <option value="<?php echo  $item->id;?>" ><?php echo $item->name;?> </option>
                             <?php }?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="input-2"> Image</label>
                        <div class="custom-file">

                            <input type="file" name="image" class="custom-file-input" onchange="readURL(this,'showImage')">
                            <label class="custom-file-label col-8" for="customFileLangHTML" data-browse="Bestand kiezen">Select Image</label>
                        </div>
                        <p class="noteMsg">Note: Image Size must be lessthan 2MB.Image Height and Width
                            less
                            than 1000px.</p>
                        <img id="showImage" src="<?php echo base_url() . 'assets/images/placeholder.png'; ?>" height="150" width="150" alt="your image" />
                    </div>


                    <div class="form-group">
                        <button type="button" onclick="savealbum()" class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url() ?>admin/album" class="btn btn-dark mw-120"> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('admin/comman/footerpage'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#video_id").select2();
        $(".selectd2").select2({
        placeholder: "Select Video"
        });
    });

    function savealbum() {
        var formData = new FormData($("#album_form")[0]);
        displayLoader();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/album/save',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(resp) {
                hideLoader();

                if (resp.status == '200') {
                    document.getElementById("album_form").reset();

                    toastr.success(resp.message);
                    window.location.replace('<?php echo base_url(); ?>admin/album');
                } else {
                    toastr.error(resp.message);
                }
            }
        });
    }
</script>