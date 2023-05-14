<?php $this->load->view('admin/comman/header');?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Form </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="category_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="input-1">Name</label>
                        <input type="text" name="name" class="form-control col-8" id="name"
                            placeholder="Enter Your Name">
                    </div>
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" required class="form-control  col-8" name="email">
                    </div>
                     <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                       <input type="Number" required class="form-control  col-8" name="mobile">
                    </div>
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input type="Password" required class="form-control  col-8" name="password">
                    </div>
                
                    <div class="form-group">
                        <button type="button" onclick="saveuser()"
                            class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url()?>admin/users" class="btn btn-dark mw-120"> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php	$this->load->view('admin/comman/footerpage'); ?>
    
    <script type="text/javascript">
        function saveuser() {
            displayLoader();
            var formData = new FormData($("#user_form")[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/users/save',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(resp) {
                    hideLoader();
                    if (resp.status == '200') {
                        document.getElementById("user_form").reset();
                        toastr.success(resp.message);
                        window.location.replace(
                            '<?php echo base_url(); ?>admin/users');
                    } else {
                        var obj = resp.message;
                        $.each(obj, function(i, e) {
                            toastr.error(e);
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    hideLoader();
                    toastr.error(errorThrown.message, 'failed');
                }
            });
        }
    </script>