    </div>
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/plupload.full.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/js.js"></script>
    <script src="<?php echo base_url();?>assets/select2/select2.min.js"></script>
    

    <script type="text/javascript">
        var base_url = "<?php echo base_url()?>";

        function get_responce_message(resp, form_name, url) {
            hideLoader();
            if (resp.status == '200') {
                document.getElementById(form_name).reset();
                toastr.success(resp.message);
                setTimeout(function() {
                    window.location.replace('<?php echo base_url(); ?>admin/' + url);
                }, 500);

            } else {
                var obj = resp.message;
                if (typeof obj === 'string') {
                    toastr.error(obj);
                } else {
                    $.each(obj, function(i, e) {
                        toastr.error(e);
                    });
                }
            }
        }
        </script>
</body>

</html>