<?php $this->load->view('admin/comman/header'); ?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Form </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="edit_video_form" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?PHP echo $video->id; ?>">
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-1"> Name </label>
                            <input type="text" required value="<?php echo $video->name; ?>" class="form-control"
                                name="name" id="name" placeholder="Enter video Name">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="input-2"> Category </label>
                            <select name="category_id" required class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach ($categorylist as $cat) { ?>
                                <option value="<?php echo $cat->id; ?>" <?php if ($cat->id == $video->category_id) {
                                                                                echo 'selected="selected"';
                                                                            } ?>>
                                    <?php echo $cat->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="is_feature"> Feature </label>
                            <select name="is_feature" required class="form-control" id="is_feature">
                                <option <?php if ($video->is_feature  == 0) {
                                            echo 'selected="selected"';
                                        } ?> value="0">No</option>
                                <option <?php if ($video->is_feature  == 1) {
                                            echo 'selected="selected"';
                                        } ?> value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="input-2">video Artist</label>
                            <!-- DropDown -->
                            <select name="artist_id" required class="form-control">
                                <option value="">Select artist</option>
                                <?php $i = 1;
                                foreach ($artistlist as $auth) { ?>
                                <option value="<?php echo $auth->id; ?>" <?php if ($auth->id == $video->artist_id) {
                                                                                    echo 'selected="selected"';
                                                                                } ?>>
                                    <?php echo $auth->name ?></option>
                                <?php $i++;
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-2">Type</label>
                            <select name="video_type" id="video_type" required onchange="checkVtype(this.value)"
                                class="form-control">
                                <option <?php if ($video->video_type  == 'video') {
                                            echo 'selected="selected"';
                                        } ?> value="video">Server Video</option>
                                <option <?php if ($video->video_type  == 'external') {
                                            echo 'selected="selected"';
                                        } ?> value="external">External URL</option>
                                <option <?php if ($video->video_type  == 'youtube') {
                                            echo 'selected="selected"';
                                        } ?> value="youtube">Youtube Video</option>
                                <option <?php if ($video->video_type  == 'vimeo') {
                                            echo 'selected="selected"';
                                        } ?> value="vimeo">Vimeo Video</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6" id="videoLink">
                            <div id="serverVideo" <?php if ($video->video_type != 'video') { ?> style="display: none;"
                                <?php } ?>>
                                <label for="input-1">Upload</label>
                                <div id="filelist">Your browser doesn't have
                                    Flashs, Silverlight or HTML5 support.</div>
                                <div id="container">
                                    <div class="form-group">
                                        <input type="file" id="uploadFile" name="uploadFile">
                                    </div>
                                    <input type="hidden" name="mp3_file_name" id="mp3_file_name" value=""
                                        class="form-control">
                                    <input type="hidden" name="mp3_file_1" id="mp3_file_1"
                                        value="<?php echo $video->url; ?>" class="form-control">
                                    <input type="hidden" name="video_file" id="video_file"
                                        value="<?php echo $video->url; ?>">
                                    <div class="form-group">
                                        <a id="upload" href="javascript:;" class="btn btn-danger">Upload
                                            files</a>
                                    </div>
                                </div>
                                <input type="hidden" id="file_ext" name="file_ext"
                                    value="<?= substr(md5(rand(10, 100)), 0, 10) ?>">
                                <p> File Name :
                                    <?php echo base_url() . 'assets/images/video/' . $video->url; ?>
                                </p>
                                <div id="console"></div>
                            </div>

                            <div id="showUrl"
                                <?php if ($video->video_type != 'external' || $video->video_type != 'youtube') { ?>
                                style="display: none;" <?php } ?>>
                                <div class="form-group"><label for="input-1">Video URL</label><input type="text"
                                        value="<?php echo $video->url; ?>" class="form-control" name="url" id="url"
                                        placeholder="Enter Server Video URL">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-12">
                            <label for="input-1"> Description</label>
                            <textarea class="form-control summernote" name="description"
                                id="description"><?php echo $video->description; ?></textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="input-1"> Cover Poster</label>
                            <input type="file" required class="form-control" name="image" id="image"
                                onchange="readURL(this,'showImage')">
                            <input type="hidden" name="image_1" value="<?PHP echo $video->image; ?>">
                            <p class="noteMsg">Note: Image Size must be less
                                than 2MB.Image Height and Width less than
                                1000px.</p>
                            <img id="showImage" src="<?php echo base_url() . 'assets/images/video/' . $video->image; ?>"
                                height="100" width="100" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="is_feature"> Is Paid </label>
                            <select name="is_paid" required class="form-control" id="is_paid">
                                <option <?php if ($video->is_paid  == 0) {
                                            echo 'selected="selected"';
                                        } ?> value="0"> Free </option>
                                <option <?php if ($video->is_paid  == 1) {
                                            echo 'selected="selected"';
                                        } ?> value="1"> Paid </option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <button type="button" onclick="update_video()" class="btn btn-primary shadow-primary px-5">
                                Update</button>
                            <a href="<?php echo base_url() ?>admin/video" class=" btn btn-group">
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
$(document).ready(function() {
    var video_type = $('#video_type').val();
    checkVtype(video_type);
});

function checkVtype(server) {
    if (server != 'video') {
        jQuery('#showUrl').css('display', 'block');
        jQuery('#serverVideo').css('display', 'none');
    } else {
        jQuery('#serverVideo').css('display', 'block');
        jQuery('#showUrl').css('display', 'none');
    }
}

$('#is_paid').on('change', function() {
    if (this.value === '1') {
        $("#business").show();
    } else {
        $("#business").hide();
    }
});

function update_video() {
    $("#dvloader").show();
    var formData = new FormData($("#edit_video_form")[0]);

    // var textareaValue = $('#description').code();
    // formData.append("description", textareaValue);

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/video/update',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(resp) {
            if (resp.status == '200') {
                $("#dvloader").hide();
                document.getElementById("edit_video_form").reset();
                toastr.success(resp.message, 'success');
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/video');
                }, 500);
            } else {
                $("#dvloader").hide();
                var obj = resp.message;
                $.each(obj, function(i, e) {
                    toastr.error(e);
                });
            }
        }
    });
}
</script>