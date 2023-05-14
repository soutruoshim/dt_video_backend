<?php $this->load->view('admin/comman/header'); ?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Notification </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="savenotifi" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="input-1">Title</label>
                        <input type="text" required class="form-control" required="" name="title" id="input-1" placeholder="Enter title">
                    </div>

                    <div class="form-group">
                        <label for="input-2">Message</label>
                        <textarea name="message" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="input-1">Image (Optional)</label>
                        <input type="file" required class="form-control" onchange="readURL(this,'showImage')" name="image" id="input-1">
                        <p class="noteMsg">"Note: Image Size Minimum - 512x256 &
                            Maximum - 2880x1440"</p>
                        <img id="showImage" src="<?php echo base_url() . 'assets/images/placeholder.png'; ?>" height="100px" width="100px" />
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="saveNotification()" class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url() ?>admin/notification" class="btn btn-dark mw-120"> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/comman/footerpage'); ?>
<script>
    function saveNotification() {
        $("#dvloader").show();
        var formData = new FormData($("#savenotifi")[0]);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/notification/save',
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(resp) {

                get_responce_message(resp, 'savenotifi', 'notification');


            }
        });
    }
</script>