<?php $this->load->view('admin/comman/header'); ?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Form </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="edit_video_form" enctype="multipart/form-data">
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-1">Name</label>
                            <input type="text" required value="" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="category_id">Category</label>
                            <select name="category_id" required class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach ($categorylist as $cat) { ?>
                                <option required value="<?php echo $cat->id; ?>">
                                    <?php echo $cat->name; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="is_feature"> Feature </label>
                            <select name="is_feature" required class="form-control" id="is_feature">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <div>
                                <label for="input-2"> Artist </label>
                                <!-- DropDown -->
                                <select name="artist_id" required class="form-control">
                                    <option value="">Select Artist</option>
                                    <?php foreach ($artistlist as $cat) { ?>
                                    <option value="<?php echo $cat->id; ?>">
                                        <?php echo $cat->name; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-2">Type</label>
                            <select name="video_type" required onchange="checkVtype(this.value)" class="form-control">
                                <option value="video">Server Video</option>
                                <option value="external">External URL
                                </option>
                                <option value="youtube">Youtube Video
                                </option>

                                <option value="vimeo">Vimeo Video
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6" id="videoLink">
                            <div id="serverVideo">
                                <label for="input-1">Upload</label>
                                <div id="filelist">Your browser doesn't have Flashs, Silverlight or HTML5 support.</div>
                                <div id="container">
                                    <div class="form-group">
                                        <input type="file" id="uploadFile" name="uploadFile">
                                    </div>
                                    <input type="hidden" name="mp3_file_name" id="mp3_file_name" value=""
                                        class="form-control">
                                    <div class="form-group">
                                        <a id="upload" href="javascript:;" class="btn btn-danger">Upload
                                            files</a>
                                    </div>
                                </div>
                                <input type="hidden" id="file_ext" name="file_ext"
                                    value="<?= substr(md5(rand(10, 100)), 0, 10) ?>">
                                <div id="console"></div>
                            </div>

                            <div id="showUrl" style="display: none;">
                                <div class="form-group"><label for="input-1">Video
                                        URL</label><input type="text" value="" class="form-control" name="url" id="url"
                                        placeholder="Enter Server Video URL">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-lg-12">
                        <div class="form-group col-lg-12">
                            <label for="input-1"> Description</label>
                            <textarea class="form-control summernote" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="input-2">Cover Poster</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input"
                                    onchange="readURL(this,'showImage')">
                                <label class="custom-file-label col-12" for="customFileLangHTML"
                                    data-browse="Bestand kiezen">Select Image</label>
                            </div>
                            <p class="noteMsg">Note: Image Size must be lessthan 2MB.Image Height and Width
                                less
                                than 1000px.</p>
                            <img id="showImage" src="<?php echo base_url() . 'assets/images/placeholder.png'; ?>"
                                height="150" width="150" alt="your image" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="is_feature"> Is Paid </label>
                            <select name="is_paid" required class="form-control" id="is_paid">
                                <option value="0"> Free </option>
                                <option value="1"> Paid </option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <button type="button" onclick="savevideo()" class="btn btn-default mw-120">Save</button>
                            <a href="<?php echo base_url() ?>admin/video" class="btn btn-dark mw-120">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/comman/footerpage'); ?>
<script type="text/javascript">
function checkVtype(server) {
    if (server != 'video') {
        jQuery('#showUrl').css('display', 'block');
        jQuery('#serverVideo').css('display', 'none');
    } else {
        jQuery('#serverVideo').css('display', 'block');
        jQuery('#showUrl').css('display', 'none');
    }
}

function savevideo() {

    $("#dvloader").show();
    var formData = new FormData($("#edit_video_form")[0]);

    // var textareaValue = $('#description').code();
    // formData.append("description", textareaValue);

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/video/save',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(resp) {
            $("#dvloader").hide();


            if (resp.status == '200') {
                document.getElementById("edit_video_form").reset();
                toastr.success(resp.message, 'success');
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/video'
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
            $("#dvloader").hide();
            toastr.error(errorThrown.msg, 'failed');
        }
    });
}
</script>