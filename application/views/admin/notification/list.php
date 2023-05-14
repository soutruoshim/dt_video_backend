<?php $this->load->view('admin/comman/header'); ?>
<div class="body-content">
    <!-- mobile title -->
    <h1 class="page-title-sm">Category</h1>
    <div class="border-bottom mb-3 pb-3">
        <a href="<?php echo base_url(); ?>admin/notification/add" class="btn btn-default mw-120">Add</a>
    </div>
    <div class="table-responsive">
        <table id="notification-datatable" class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th> Id </th>
                    <!-- <th> Image </th> -->
                    <th> Title </th>
                    <th> Message </th>
                    <th> Date </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('admin/comman/footerpage'); ?>
<script>
    $(document).ready(function() {

        var dataTable = $('#notification-datatable').DataTable({
            language: {
                oPaginate: {
                    sNext: '<i class="arrow-icon next-arrow"></i>',
                    sPrevious: '<i class="arrow-icon"></i>',
                }
            },
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo base_url() . 'admin/notification/fetch_data'; ?>",
                type: "POST"
            },

        });
    });
</script>