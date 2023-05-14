<?php $this->load->view('admin/comman/header');?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Form </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="edit_page_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Address"> Title </label>
                        <input type="text" value="<?php echo $page->title; ?>" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="bio"> Description </label>
                        <textarea type="text" class="form-control summernote" name="description"  id="description"><?php echo $page->description; ?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $page->id; ?>"> 
                
                    <div class="form-group">
                        <button type="button" onclick="updatepage()"
                            class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url()?>admin/page" class="btn btn-dark mw-120"> Cancel
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
        function updatepage(){

            displayLoader();
            var formData = new FormData($("#edit_page_form")[0]);

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/page/update',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(resp) {
                    hideLoader();
                    if (resp.status == '200') {
                        document.getElementById("edit_page_form").reset();
                        toastr.success(resp.message, 'success');
                        setTimeout(function() {
                            window.location.replace(
                                '<?php echo base_url(); ?>admin/page'
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