<?php $this->load->view('admin/comman/header');?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Form </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="add_artisteo_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name"> Name </label>
                        <input type="text"  class="form-control col-8" name="name" id="name" placeholder="Enter Name">
                    </div>
                     <div class="form-group">
                        <label for="Address"> Address </label>
                        <input type="text" class="form-control col-8"  name="address" id="address">
                    </div>
                     <div class="form-group">
                        <label for="bio"> Description </label>
                        <textarea type="text" class="form-control  col-8"  name="bio" id="bio"></textarea>
                        
                    </div>
               
                    <div class="form-group">
                        <label for="input-2">Profile Picture</label>
                        <div class="custom-file">
                            <input type="file" name="image"  class="custom-file-input" onchange="readURL(this,'showImage')">
                            <label class="custom-file-label col-8" for="customFileLangHTML" data-browse="Bestand kiezen">Select Image</label>
                        </div>
                       <p class="noteMsg">Note: Image Size must be lessthan 2MB.Image Height and Width
                            less
                            than 1000px.</p>
                        <img id="showImage"
                            src="<?php echo base_url().'assets/images/placeholder.png';?>" height="150"
                            width="150" alt="your image" />
                    </div>
                
                    <div class="form-group">
                        <button type="button" onclick="addArtist()"
                            class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url()?>admin/artist" class="btn btn-dark mw-120"> Cancel
                        </a>
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
        function addArtist() {

            displayLoader();
            var formData = new FormData($("#edit_artisteo_form")[0]);
           

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/artist/save',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(resp) {
                    hideLoader();
                    if (resp.status == '200') {
                        document.getElementById("edit_artisteo_form").reset();
                        toastr.success(resp.message, 'success');
                        setTimeout(function() {
                            window.location.replace(
                                '<?php echo base_url(); ?>admin/artist'
                            );
                        }, 500);
                    } else {
                        var obj = resp.message;
                        $.each(obj, function(i, e) {
                            toastr.error(e);
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    hideLoader();
                    toastr.error(errorThrown.msg, 'failed');
                }
            });
        }
        </script>