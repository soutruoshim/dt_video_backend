<?php $this->load->view('admin/comman/header');?>
<!-- transactionList Data Show -->
<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Transaction List</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaction List</li>
				</ol>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<div class="row">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-header"> transaction List</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="transaction-datatable" class="table table-bordered">
							<thead>
								<tr>
									<th> User Name </th>
									<th> Book </th>
									<th> Price </th>
									<th> Commission </th>
									<th> Created Date </th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($transaction as $key => $value) { ?>
								<tr>
									<td> <?php echo $value->fullname;?></td>
									<td> <?php echo $value->title;?></td>
									<td> <?php echo $_SESSION['currency_symbol'];?><?php echo $value->amount;?></td>
									<td> <?php echo $_SESSION['currency_symbol'];?><?php echo $value->author_commission_amount;?></td>
									<td> <?php echo dateformate($value->created_at);?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div><!-- End Row-->

	<?php $this->load->view('admin/comman/footerpage'); ?>
	<script>
	$(document).ready(function(){  
	    $('#transaction-datatable').DataTable();  
	});  
  </script>