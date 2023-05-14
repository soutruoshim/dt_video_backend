<?php $this->load->view('admin/comman/header'); ?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Form </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="edit_category_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="input-1">Category Name</label>
                        <input type="text" name="name" class="form-control col-8" id="name" value="<?php echo $category->name?>"
                            placeholder="Enter Your Category Name">

                             <input type="hidden" name="id"  value="<?php echo $category->id?>"
                            placeholder="Enter Your Category Name">
                    </div>
                    <div class="form-group">
                        <label for="input-2">Category Image</label>
                        <div class="custom-file">
                            <input type="file" name="image"  class="custom-file-input" onchange="readURL(this,'showImage')">
                            <label class="custom-file-label col-8" for="customFileLangHTML" data-browse="Bestand kiezen">Select Image</label>
                        </div>
                        <p class="noteMsg">Note: Image Size must be lessthan 2MB.Image Height and Width less than 1000px.</p>
                        <img id="showImage" src="<?php echo base_url().'assets/images/category/'.$category->image; ?>" height="150"
                            width="150" alt="your image" />
                    </div>
                
                    <div class="form-group">
                        <button type="button" onclick="updateCategory()" class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url()?>admin/category" class="btn btn-dark mw-120"> Cancel </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function updateCategory() {
    var category_name = jQuery('input[name=name]').val();
    if (category_name == '') {
        toastr.error('Please enter category name', 'failed');
        return false;
    }
    $("#dvloader").css('display', 'block');
    $("body").addClass('overlay');

    var formData = new FormData($("#edit_category_form")[0]);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/category/update',
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
                    '<?php echo base_url(); ?>admin/category');
            } else {
                toastr.error(resp.message);
                $("#dvloader").hide();
            }
        }
    });
}
</script>

<?php
   $this->load->view('admin/comman/footerpage');
  ?>