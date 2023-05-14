<?php $this->load->view('admin/comman/header');?>
 <div class="body-content">
        <!-- mobile title -->
        <h1 class="page-title-sm">Artist</h1>
        <div class="border-bottom mb-3 pb-3">
            <a href="<?php echo base_url();?>admin/artist/add" class="btn btn-default mw-120">Add</a>
        </div>
        <div class="table-responsive">
            <table id="artist-datatable" class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Artist's Bio</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <?php $this->load->view('admin/comman/footerpage'); ?>
    <script>
    $(document).ready(function() {
        var dataTable = $('#artist-datatable').DataTable({
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
                url: "<?php echo base_url() . 'admin/artist/fetch_data'; ?>",
                type: "POST"
            },
            "columnDefs": [{
                //  "targets":[0, 3, 4],  
                "orderable": false,
            }, ],
        });
    });
    </script>