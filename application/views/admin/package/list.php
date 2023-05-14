<?php $this->load->view('admin/comman/header'); ?>

<div class="body-content">
    <!-- mobile title -->
    <h1 class="page-title-sm">Package List</h1>
    <div class="border-bottom mb-3 pb-3">
        <a href="<?php echo base_url(); ?>admin/package/add" class="btn btn-default mw-120">Add</a>
    </div>
    <div class="table-responsive">

        <table id="package-datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Time</th>
                    <th> Type</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Product Package</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?php $this->load->view('admin/comman/footerpage'); ?>
<script>
$(document).ready(function() {
    var dataTable = $('#package-datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "<?php echo base_url() . 'admin/package/fetch_data'; ?>",
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
        }, ],
    });
});
</script>