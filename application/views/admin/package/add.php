<?php $this->load->view('admin/comman/header'); ?>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <p class="animated fadeInDown">
                    <a href="<?php echo base_url() ?>admin/dashboard"><span class="fa-home fa"></span></a> <span
                        class="fa-angle-right fa"></span> Add Package
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
                            <h4>Add Package</h4>
                        </div>
                        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                            <div class="col-md-12">
                                <form id="package_form" enctype="multipart/form-data">
                                    <div class="row col-lg-12">
                                        <div class="form-group col-md-6">
                                            <label for="input-1">Package Name</label>
                                            <input type="text" name="name" class="form-control" id="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="input-1">Price</label>
                                            <input type="text" name="price"
                                                onkeypress="return isNumberKeyWithFloat(event,this)"
                                                class="form-control" id="price">
                                        </div>
                                    </div>
                                    <div class="row col-lg-12">
                                        <div class="form-group col-md-6">
                                            <label>Plan Period</label>
                                            <input name="time" type="number" class="form-control" placeholder="Ex. 1">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Plan type</label>
                                            <select name="type" required class="form-control">
                                                <option value="year">Year</option>
                                                <option value="month">Month</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-lg-12">
                                        <div class="form-group  col-md-6">
                                            <label for="input-2">package Image</label>
                                            <input type="file" name="image" class="form-control" id="input-2"
                                                onchange="readURL(this,'showImage')">
                                            <p class="noteMsg">Note: Image Size must be lessthan
                                                2MB.Image Height and Width less than 1000px.</p>
                                            <img id="showImage"
                                                src="<?php echo base_url() . 'assets/images/placeholder.png'; ?>"
                                                height="100px" width="100px" />
                                        </div>
                                   
                                     <div class="form-group col-md-6">
                                            <label for="input-1">Product Package</label>
                                            <input type="text"  name="product_package"
                                                class="form-control" id="product_package">
                                        </div>
                                         </div>
                                    <div class="row col-lg-12">
                                        <button type="button" onclick="savepackage()"
                                            class="btn btn-primary shadow-primary px-5">Save</button>
                                        <a href="<?php echo base_url() ?>admin/package" class=" btn btn-group">
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

        </html>
        <?php $this->load->view('admin/comman/footerpage'); ?>

        <script type="text/javascript">
        function savepackage() {

            var formData = new FormData($("#package_form")[0]);

            $("#dvloader").show();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>admin/package/save',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(resp) {
                    $("#dvloader").hide();
                    if (resp.status == '200') {
                        document.getElementById("package_form").reset();
                        toastr.success(resp.message);
                        window.location.replace(
                            '<?php echo base_url(); ?>admin/package');
                    } else {
                        var obj = resp.message;
                        $.each(obj, function(i, e) {
                            toastr.error(e);
                        });
                    }
                }
            });
        }
        </script>