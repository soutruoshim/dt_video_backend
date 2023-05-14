<?php $this->load->view('admin/comman/header'); ?>
<?php 
    $setn=array(); 
    foreach($settinglist as $set){
        $setn[$set->key]=$set->value;
    }
?>
<div class="body-content">
    <ul class="nav nav-pills custom-tabs inline-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-settings-tab" data-toggle="pill" href="#pills-settings" role="tab"
                aria-controls="pills-settings" aria-selected="true">App Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-password-tab" data-toggle="pill" href="#pills-password" role="tab"
                aria-controls="pills-password" aria-selected="false">Change Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-admob-tab" data-toggle="pill" href="#pills-admob" role="tab"
                aria-controls="pills-admob" aria-selected="false">Admob</a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab">
            <div class="app-right-btn">
                <a href="<?php echo base_url();?>admin/setting/smtp" class="btn btn-default">Email Setting [SMTP]</a>
            </div>
            <div class="card custom-border-card">
                <h5 class="card-header">App Settings</h5>
                <div class="card-body">
                    <form id="save_setting" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>App Name</label>
                            <input type="text" class="form-control" name="app_name"
                                value="<?php echo $setn['app_name'];?>" placeholder="Enter app Name">
                        </div>
                        <div class="form-group">
                            <label for="bio"> Description </label>
                            <textarea type="text" class="form-control " name="app_desripation"
                                id="app_desripation"><?php echo $setn['app_desripation']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="input-2">App Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input"
                                    onchange="readURL(this,'showImage')">
                                <label class="custom-file-label" for="customFileLangHTML"
                                    data-browse="Bestand kiezen">Select Image</label>
                            </div>
                            <p class="noteMsg">Note: Image Size must be lessthan 2MB.Image Height and Width Maximum -
                                100x200</p>
                            <img id="showImage" src="<?php echo base_url().'assets/images/app/'.$setn['app_logo'];?>"
                                height="50" width="200" alt="your image" />
                        </div>
                        <div class="text-right pt-3">
                            <button type="button" class="btn btn-default mw-120" onclick="save_setting()"> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <?php /*?>
            <div class="card custom-border-card">
                <h5 class="card-header">Currency Settings</h5>
                <div class="card-body">
                    <form id="save_currency_setting" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Set Currency</label>
                            <select class="form-control" name="currency">
                                <option>
                                    Select Currency
                                </option>
                                <?php foreach ($currency as $key => $value) {?>
                                <option value="<?php echo $value->id;?>"
                                    <?php if($value->status == 1){echo "selected";}?>>
                                    (<?php echo $value->symbol;?>)<?php echo $value->name;?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="text-right pt-3">
                            <button class="btn btn-default mw-120" onclick="save_currency_setting()">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            */ ?>
        </div>

        <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-Premium-tab">
            <div class="card custom-border-card mt-3">
                <h5 class="card-header">Change Password </h5>
                <div class="card-body">
                    <form id="save_password">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="text" name="password" id="password" class="form-control"
                                placeholder="Enter New Password">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="text" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Enter confirm  Password">
                        </div>
                        <div class="text-right pt-3">
                            <button type="button" class="btn btn-default mw-120" onclick="change_password()">
                                Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-admob" role="tabpanel" aria-labelledby="pills-admob-tab">
            <div class="card custom-border-card mt-3">
                <h5 class="card-header">Android Settings</h5>
                <div class="card-body">
                    <form id="save_admob" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Banner Ad</label>
                                    <div class="radio-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" value="yes" name="banner_ad" checked
                                                class="custom-control-input"
                                                <?php if($setn['banner_ad']=='yes'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio1">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" value="no" name="banner_ad"
                                                class="custom-control-input"
                                                <?php if($setn['banner_ad']=='no'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio2">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Interstital Ad</label>
                                    <div class="radio-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" value="yes" name="interstital_ad"
                                                checked class="custom-control-input"
                                                <?php if($setn['interstital_ad']=='yes'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio3">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio4" value="no" name="interstital_ad"
                                                class="custom-control-input"
                                                <?php if($setn['interstital_ad']=='no'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio4">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Reward Ad</label>
                                    <div class="radio-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio5" value="yes" name="reward_ad" checked
                                                class="custom-control-input"
                                                <?php if($setn['reward_ad']=='yes'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio5">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio6" value="no" name="reward_ad"
                                                class="custom-control-input"
                                                <?php if($setn['reward_ad']=='no'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio6">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Banner Ad ID</label>
                                    <input type="text" class="form-control" name="banner_adid"
                                        value="<?php echo $setn['banner_adid'];?>" placeholder="Enter Banner Ad ID">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Interstital Ad ID</label>
                                    <input type="text" name="interstital_adid"
                                        value="<?php echo $setn['interstital_adid'];?>" class="form-control"
                                        placeholder="Enter Interstital Ad ID">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Reward Ad ID</label>
                                    <input type="text" class="form-control" name="reward_adid"
                                        value="<?php echo $setn['reward_adid'];?>" placeholder="Enter Reward Ad ID">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                </div>
                            </div>


                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Interstital Ad Click</label>
                                    <input type="text" name="interstital_adclick"
                                        value="<?php echo $setn['interstital_adclick'];?>" class="form-control"
                                        placeholder="Enter Interstital Ad Click">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Reward Ad Click</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $setn['reward_adclick'];?>" name="reward_adclick"
                                        placeholder="Enter Reward Ad Click">
                                </div>
                            </div>
                        </div>
                        <div class="text-right pt-3">
                            <button class="btn btn-default mw-120" onclick="save_admob()"> Save </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card custom-border-card mt-3">
                <h5 class="card-header">IOS Settings</h5>
                <div class="card-body">
                    <form id="ios_save_admob" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Banner Ad</label>
                                    <div class="radio-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio7" value="yes" name="ios_banner_ad"
                                                <?php if($setn['ios_banner_ad']=='yes'){ echo 'checked'; } ?>
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio7">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio8" value="no" name="ios_banner_ad"
                                                <?php if($setn['ios_banner_ad']=='no'){ echo 'checked'; } ?>
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio8">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Interstital Ad</label>
                                    <div class="radio-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio9" value="yes" name="ios_interstital_ad"
                                                class="custom-control-input"
                                                <?php if($setn['ios_interstital_ad']=='yes'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio9">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio10" value="no" name="ios_interstital_ad"
                                                class="custom-control-input"
                                                <?php if($setn['ios_interstital_ad']=='no'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio10">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Reward Ad</label>
                                    <div class="radio-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio11" value="yes" name="ios_reward_ad"
                                                <?php if($setn['ios_reward_ad']=='yes'){ echo 'checked'; } ?>
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio11">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio12" value="no" name="ios_reward_ad"
                                                class="custom-control-input"
                                                <?php if($setn['ios_reward_ad']=='no'){ echo 'checked'; } ?>>
                                            <label class="custom-control-label" for="customRadio12">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Banner Ad ID</label>
                                    <input type="text" class="form-control" name="ios_banner_adid"
                                        value="<?php echo $setn['ios_banner_adid'];?>" placeholder="Enter Banner Ad ID">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Interstital Ad ID</label>
                                    <input type="text" class="form-control" name="ios_interstital_adid"
                                        value="<?php echo $setn['ios_interstital_adid'];?>"
                                        placeholder="Enter Interstital Ad ID">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Reward Ad ID</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $setn['ios_reward_adid'];?>" name="ios_reward_adid"
                                        placeholder="Enter Reward Ad ID">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">

                                </div>
                            </div>


                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Interstital Ad Click</label>
                                    <input type="text" class="form-control" name="ios_interstital_adclick"
                                        value="<?php echo $setn['ios_interstital_adclick'];?>"
                                        placeholder="Enter Interstital Ad Click">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label>Reward Ad Click</label>
                                    <input type="text" class="form-control" name="ios_reward_adclick"
                                        value="<?php echo $setn['ios_reward_adclick'];?>"
                                        placeholder="Enter Reward Ad Click">
                                </div>
                            </div>
                        </div>

                        <div class="text-right pt-3">
                            <button class="btn btn-default mw-120" onclick="ios_save_admob()">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function save_setting() {

    var formData = new FormData($("#save_setting")[0]);

    // var app_desc = $('#app_desc').code();
    // formData.append("app_desripation", app_desc);

    // var textareaValue = $('#summernote').code();
    // formData.append("privacy_policy", textareaValue);


    displayLoader();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/setting/save',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(resp) {
            hideLoader();
            if (resp.status == '200') {
                toastr.success(resp.message, 'Setting saved.');
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/setting'
                    );
                }, 500);
            } else {
                toastr.error(resp.message);
            }
        }
    });
}

function save_currency_setting() {
    var formData = new FormData($("#save_currency_setting")[0]);

    displayLoader();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/setting/save_currency',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(resp) {
            hideLoader();
            if (resp.status == '200') {
                toastr.success(resp.message,
                    'Update currency setting sucessfully.');
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/setting'
                    );
                }, 500);
            } else {
                toastr.error(resp.message);
            }
        }
    });
}

function change_password() {

    var formData = new FormData($("#save_password")[0]);
    var password = jQuery('#password').val();
    var confirm_password = jQuery('#confirm_password').val();
    if (password != confirm_password) {
        toastr.error('Password and confirm password not match.');
        return false;
    }
    displayLoader();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/setting/save_change_password',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(resp) {
            hideLoader();
            if (resp.status == '200') {
                toastr.success(resp.message,
                    'Password change sucessfully.');
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/setting'
                    );
                }, 500);
            } else {
                toastr.error(resp.message);
            }
        }
    });
}

function save_admob() {
    var formData = new FormData($("#save_admob")[0]);
    displayLoader();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/setting/save',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(resp) {
            hideLoader();
            if (resp.status == '200') {
                toastr.success(resp.message, 'Password change sucessfully.');
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/setting/admob');
                }, 500);
            } else {
                toastr.error(resp.message);
            }
        }
    });
}

function ios_save_admob() {
    var formData = new FormData($("#ios_save_admob")[0]);
    displayLoader();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/setting/save',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(resp) {
            hideLoader();
            if (resp.status == '200') {
                toastr.success(resp.message, 'Password change sucessfully.');
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/setting/admob');
                }, 500);
            } else {
                toastr.error(resp.message);
            }
        }
    });
}
</script>

<?php $this->load->view('admin/comman/footerpage'); ?>