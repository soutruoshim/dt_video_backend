<?php $this->load->view('admin/comman/header');?>
<!-- transactionList Data Show -->
<div class="clearfix"></div>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Sales Report</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sales Report</li>
				</ol>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<div class="row">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-header"> 
					<div class="row">
						<form>
							<div class="form-group col-xs-6">
								<label>Search : </label>
							</div>

							<?php 

							$start_date = date('m/01/Y');
							$end_date  = date('m/t/Y');

							$start_date = isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : $start_date;
							$end_date = isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : $end_date; 

							?>
							<div class="form-group col-xs-6">
								<input type="text" class="form-control col-sm-12 start_date" value="<?php echo $start_date;?>" placeholder="From Date" name="start_date">
							</div>
							<div class="form-group col-xs-6">
								<input type="text" class="form-control col-sm-12 end_date" value="<?php echo $end_date;?>" placeholder="To Date" name="end_date">
							</div>
							<div class="form-group col-xs-6">
								<button class="btn submit"> Search </button>
							</div>
						</form>
					</div>

				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table id="transaction-datatable" class="table table-bordered">
							<thead>
								<tr>
									<th> Buyer Name </th>
									<th> Book </th>
									<th> Book Price </th>
									<th> Author Earning </th>
									<th> Admin Commission </th>
									<th> Sales Date </th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($transaction as $key => $value) { ?>
								<tr>
									<td> <?php echo $value->fullname;?></td>
									<td> <?php echo $value->title;?></td>
									<td> <?php echo $_SESSION['currency_symbol'];?><?php echo $value->amount;?></td>
									<td> <?php echo $_SESSION['currency_symbol'];?><?php echo $value->amount - $value->author_commission_amount;?></td>
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
			
			$(".start_date").datepicker();
		    $(".end_date").datepicker();  
		});

		$(document).ready(function(){  
			$('.submit').on('click',function(){

				var start_date = $('.start_date').val();
				var end_date = $('.end_date').val();

				$.ajax({
					type:'POST',
					url:'<?php echo base_url();?>admin/Authorprofile/sales_report_search/',
					data:{"start_date":start_date,"end_date":end_date},
					dataType: "json",
					success:function(resp){
						
					}
				});
			})
		});
	</script>