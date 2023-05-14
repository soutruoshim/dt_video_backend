<?php $this->load->view('admin/comman/header');?>
<?php 
    $setn = array();foreach ($settinglist as $set) {
        $setn[$set->key] = $set->value;
    }
?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="<?php echo base_url()?>admin/dashboard"><span class="fa-home fa"></span></a> <span
                        class="fa-angle-right fa"></span> Notification Setting
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="col-md-12">
                    <div class="col-md-12 panel">
                        <div class="col-md-12 panel-heading">
                            <h4>Notification Setting</h4>
                        </div>
                        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                            <div class="col-md-12">
                                <form id="save_signal_noti" enctype="multipart/form-data">
                                    <div class="form-group col-lg-6">
                                        <label>OneSignal App ID</label>
                                        <input type="text" name="onesignal_apid" required class="form-control"
                                            placeholder="Enter Your App Name"
                                            value="<?php echo $setn['onesignal_apid']; ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>OneSignal Rest Key</label>
                                        <input type="text" name="onesignal_rest_key" required class="form-control"
                                            value="<?php echo $setn['onesignal_rest_key']; ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="input-1">&nbsp;</label>
                                        <button type="button" class="btn btn-primary" onclick="save_signal_noti()">
                                            Save</button>
                                        <a href="<?php echo base_url()?>admin/notification/setting"
                                            class=" btn btn-group">
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('admin/comman/footerpage'); ?>
        <script type="text/javascript">
        function save_signal_noti() {
            $("#dvloader").show();
            var formData = new FormData($("#save_signal_noti")[0]);

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/admin/notification/setting_save',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(resp) {
                    hideLoader();
                    toastr.success('Setting saved.');
                    window.location.replace(
                        '<?php echo base_url(); ?>admin/notification/setting');
                }
            });
        }
        </script>