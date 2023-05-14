<?php $this->load->view('admin/comman/header');?>
<!-- transactionList Data Show -->
<div class="clearfix"></div>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Payout Report</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payout Report</li>
				</ol>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<div class="row">

		  	<div class="col-sm-6">
			  	<div class="card">
			  		<div class="card-body" style="min-height: 140px;">
			  			<h5>Next Payout <a class="btn btn-outline-github btn-round btn-sm float-lg-right" href="<?php echo base_url()?>admin/Authorprofile/sales_report"> See Report</a></h5>
			  			<?php
			  			$settlement_amount = 0; 
			  			if(count($settlement) > 0)
			  			{
							$settlement_amount = $settlement[0]->total_amount - $settlement[0]->total_admin_commission_amount;
			  			}

			  			$account_no = isset($bankdetail->account_no) ? $bankdetail->account_no : '';
			  			
			  			$account_no = substr($account_no,-4);
			  			
			  			?>
			  			<p><?php echo $_SESSION['currency_symbol'];?><?php echo $settlement_amount;?> <br>To <?php echo $_SESSION['name'];?> [xxxx xxxx <?php echo $account_no; ?>] via bank transfer.</p>
			  		</div>
			  	</div>
		  	</div>
		  	<div class="col-sm-6">
		  		<div class="card">
			  		<div class="card-body"  style="min-height: 140px;">
			  			<h5>Payout Account   <a class="btn btn-outline-github btn-round btn-sm float-lg-right" href="<?php echo base_url()?>admin/Authorprofile/bankdetail"> See Account</a></h5>
			  			<p><i class="fa fa-bank"></i> Bank Account : [xxxx xxxx <?php echo $account_no; ?>]</p>
			  			<p>&nbsp</p>
			  			
			  		</div>
			  	</div>
		  	</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"> Payment History</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th> Amount </th>
										<th> Payment Method </th>
										<th> Process Date</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($payout as $value) { ?>
									<tr>
										<td> <?php echo $_SESSION['currency_symbol'];?><?php echo $value->amount;?></td>
										<td> Bank Transfer</td>
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
	