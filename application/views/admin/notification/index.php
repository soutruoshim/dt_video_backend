<?php $this->load->view('admin/comman/header'); ?>

<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Notification</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/dashboard">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin/notification">Notification</a></li>
					<li class="breadcrumb-item active" aria-current="page">Send Notification</li>
				</ol>
			</div>

		</div>
		<!-- End Breadcrumb-->

		<div class="row">
			<div class="col-lg-12 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Send Notification</div>
						<hr>
						<form id="savenotifi" enctype="multipart/form-data">
							<div class="form-group">
								<label for="input-1">Title</label>
								<input type="text" required class="form-control" required="" name="title" id="input-1" placeholder="Enter title">
							</div>

							<div class="form-group">
								<label for="input-2">Message</label>
								<textarea name="message" class="form-control"></textarea>
							</div>


							<div class="form-group">
								<label for="input-1">Image (Optional)</label>
								<input type="file" required class="form-control" name="thumbnail" id="input-1" placeholder="Enter Video Name">
								<p class="noteMsg">Note: Image Size Minimum - 512x256 & Maximum - 2880x1440</p>
							</div>

							<div class="form-group">
								<button type="button" onclick="saveNotification()" class="btn btn-primary shadow-primary px-5"> Save</button>
							</div>
						</form>
					</div>
				</div>


			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/comman/footerpage'); ?>
<script>
	function saveNotification() {
		$("#dvloader").show();
		var formData = new FormData($("#savenotifi")[0]);
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>admin/notification/save',
			data: formData,
			dataType: "json",
			cache: false,
			contentType: false,
			processData: false,
			success: function(resp) {
				$("#dvloader").hide();
				if (resp.status == '200') {
					document.getElementById("savenotifi").reset();
					toastr.success(resp.message);
					window.location.replace('<?php echo base_url(); ?>admin/notification');
				} else {
					var obj = resp.message;
					$.each(obj, function(i, e) {
						toastr.error(e);
					});
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				$("#dvloader").hide();
				alert("".textStatus);
			}
		});
	}
</script>