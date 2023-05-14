<?php 
    $this->load->view('admin/comman/header');
    $setn=array(); foreach($settinglist as $set){
    $setn[$set->key]=$set->value;
}
?>
<div class="body-content">
    <div class="card custom-border-card mt-3">
        <h5 class="card-header">Form </h5>
        <div class="card-body">
            <div class="card-body">
                <form id="save_smtp_setting" enctype="multipart/form-data">
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-2">Host</label>
                            <input type="text" name="host" required class="form-control" id="host"
                                value="<?php echo $smtp_setting->host;?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="input-2">Port</label>
                            <input type="text" name="port" required class="form-control" id="port"
                                value="<?php echo $smtp_setting->port;?>">
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-2">User
                                name</label>
                            <input type="text" name="user" required class="form-control" id="user"
                                value="<?php echo $smtp_setting->user;?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="input-2">Password</label>
                            <input type="password" name="pass" required class="form-control" id="pass"
                                value="<?php echo $smtp_setting->pass;?>">
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-2">From
                                name</label>
                            <input type="text" name="from_name" required class="form-control"
                                id="from_name" value="<?php echo $smtp_setting->from_name;?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="input-2">From
                                Email</label>
                            <input type="text" name="from_email" required class="form-control"
                                id="from_email" value="<?php echo $smtp_setting->from_email;?>">
                        </div>
                    </div>
                    <div class="row col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="input-1">Protocol</label>
                            <input type="text" name="protocol" required class="form-control"
                                id="protocol" placeholder="Enter Your protocol"
                                value="<?php echo $smtp_setting->protocol;?>">
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="button" onclick="save_smtp_setting()"
                            class="btn btn-default mw-120">Save</button>
                        <a href="<?php echo base_url()?>admin/setting" class="btn btn-dark mw-120"> Cancel </a>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function save_smtp_setting() {
    var formData = new FormData($("#save_smtp_setting")[0]);
    displayLoader();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>admin/setting/save_smtp_setting',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(resp) {
            hideLoader();
            var obj = JSON.parse(resp);
            if (obj.status == '200') {
                toastr.success(obj.message);
                setTimeout(function() {
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/setting/smtp'
                    );
                }, 500);
            } else {
                toastr.error(obj.message);
            }
        }
    });
}
</script>

<?php $this->load->view('admin/comman/footerpage'); ?>