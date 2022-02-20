<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';
if(isset($_SESSION['user_id']))
{
	extract($_GET);	

	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM customers WHERE id='$id' ;";
		$query=$conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);

		$sqlu="SELECT id,CONCAT_WS(' ',fname,lname) as name FROM users ;";
		$qu=$conn->query($sqlu);
		$users=$qu->fetchAll(PDO::FETCH_ASSOC);

		$sqlc="SELECT * FROM comments WHERE cust_id='$id' ORDER BY id DESC;";
		$qc=$conn->query($sqlc);
		$comments=$qc->fetchAll(PDO::FETCH_ASSOC);
		
	}else{ header('LOCATION: home.php'); }	
}
else
{
	session_destroy();
	header('LOCATION: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php $page="view_one_customer"; ?>
<!-- Main navbar -->
<?php include 'header.php'; ?>
<!-- /main navbar -->
		<!-- Page container -->
		<div class="page-container">
			<!-- Page content start-->
			<div class="page-content">
				<!-- siderbar start -->
				<?php include 'sidebar.php'; ?>
				<!-- siderbar end -->		

				<!-- Main content -->
				<div class="content-wrapper">
					<div class="page-header page-header-default">
						<div class="page-header-content">
							<div class="page-title">
								<h2 class="no-margin text-light">VIEW CUSTOMER</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<!-- Detached sidebar -->
						<div class="sidebar-detached">
							<div class="sidebar sidebar-default sidebar-separate">
								<div class="sidebar-content">
									<!-- User details -->
									<div class="content-group">
										<div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(#); background-size: contain;">
											<a class="display-inline-block content-group-sm">
												<img src="<?=ROOT_URL.$results[0]['pic_path'];?>" class="img-circle img-responsive" alt="customer_image" style="height: 100px;">
											</a>
										</div> 
										<div class="panel no-border-top no-border-radius-top">
											<ul class="navigation">
												<li align="center"><button onclick="document.location.href='view_customers.php';" class="btn btn-danger btn-labeled btn-labeled-left rounded-round"  style="width:150px;"><b><i class="icon-circle-left2"></i></b>Go Back</button></li>

												<li align="center"><button onclick="document.location.href='edit_customer.php?id=<?=$results[0]['id'];?>';" class="btn bg-teal btn-labeled btn-labeled-left rounded-round" style="width:150px;"><b><i class="icon-pen"></i></b> Edit Customer</button></li>
												
												<li class="navigation-divider"></li>
												<li class="navigation-header">Navigation</li>
												<li class="active"><a href="#overview" data-toggle="tab"><i class="icon-files-empty"></i> Overview</a></li>
												<li><a href="#comments" data-toggle="tab"><i class="icon-comments"></i> All Comments</a></li>
											</ul>
										</div>
									</div>
									<!-- /user details -->
								</div>
							</div>
						</div>
						<!-- /Detached sidebar -->
						<!-- Detached content -->
						<div class="container-detached">
							<div class="content-detached">
								<!-- Tab content -->
								<div class="tab-content">
									<div class="tab-pane fade in active" id="overview">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">CUSTOMER DETAILS</h6>
											</div>
											<div class="panel-body">
												<table class="table table-striped table-bordered">
													<tbody>
													<?php if(!empty($results)){ foreach($results as $result){ ?>
														<tr>
															<th>Name</th>
															<td><?=$result['cust_name'];?></td>
														</tr>
														<?php if(isset($result['cust_phone']) && !empty($result['cust_phone'])){ ?>
														<tr>
															<th>Phone No</th>
															<td><?=$result['cust_phone'];?></td>
														</tr>
														<?php } ?>
														<?php if(isset($result['cust_email']) && !empty($result['cust_email'])){ ?>
														<tr>	
															<th>Email</th>
															<td><?=$result['cust_email'];?></td>
														</tr>
														<?php } ?>
														
														<?php if(isset($result['created_by']) && !empty($result['created_by'])){ foreach($users as $user){ if($user['id']==$result['created_by']){ ?>
														<tr>	
															<th>Created By</th>
															<td><?=$user['name']?></td>
														</tr>
														<?php }}} ?>
														<?php if(isset($result['updated_by']) && !empty($result['updated_by'])){ foreach($users as $user){ if($user['id']==$result['updated_by']){?>
														<tr>	
															<th>Updated By</th>
															<td><?=$user['name']?></td>
														</tr>
														<?php }}} ?>
													<?php }} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="tab-pane fade" id="comments">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">ALL COMMENTS</h6>
												<div class="heading-elements">
													<span class="heading-text text-size-large">
														<span class="badge bg-success" style="font-size: 12px;">
															<?=count($comments); ?>
														</span>
													</span>
												</div>
											</div>

											<div class="table-responsive">
												<table class="table datatable-buttons table-striped">
													<thead>
														<tr>
															<th>Date</th>
															<th>Post #</th>
															<th>Comment</th>
															<th>Approval</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													<?php 
													if(!empty($comments)){ foreach($comments as $comm){ ?>	
														<tr>
															<td><?=date('d-m-Y',strtotime($comm['created_at']));?></td>
															<td>
																<a href="view_one_post.php?id=<?=$comm['post_id'];?>" class="text-semibold"><?=$comm['post_id']; ?></a>
															</td>
															<td><?=$comm['comment']; ?></td>
															<td>
																<?php if($comm['is_approved']=="1"){ ?>
																<span class="label label-flat border-teal text-teal-600">Approved</span> 
																<?php }elseif ($comm['is_approved']=="0") { ?>
																<span class="label label-flat border-danger text-danger-600">Pending</span>
																<?php }else{} ?>
															</td>
															<td>
																<ul class="icons-list">
																	<li class="text-primary-600"><a href="<?=ROOT_URL;?>pdfmaker/create_pdf_invoice.php?in_id=<?=$inv['id'];?>&do=download" data-popup="tooltip" data-original-title="PDF"><i class="icon-file-pdf"></i></a></li>
																</ul>
															</td>
														</tr>
													<?php }} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="tab-pane fade" id="unpaid_inv">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">UNPAID INVOICES</h6>
												<div class="heading-elements">
													<span class="heading-text text-size-large">
													<?php 
													$totpaid=0; $totunpaid=0; $totbal=0;
														if(!empty($invoices))
														{ 
															foreach($invoices as $inv)
															{ 
																if($inv['in_status']=="0")
																{
																	$in_paid="";
																	$sqlip="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																	$qip=$conn->query($sqlip);
																	$in_paid=$qip->fetchAll(PDO::FETCH_ASSOC);

																	$sqlcount="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																	$qcount=$conn->query($sqlcount);
																	$count_inpaid=$qcount->fetchAll(PDO::FETCH_ASSOC);

																	$totpaid=$totpaid+$inv['in_grandtotal'];
																	$totunpaid=$totunpaid+$count_inpaid[0]['paid_amt'];
																	$totbal=$totbal+($inv['in_grandtotal']-$in_paid[0]['paid_amt']);
																}
															}
														} 
														?>
														
														<span class="badge bg-danger" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totpaid, 'INR') );?>
														</span>

														<span class="badge bg-success" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totunpaid, 'INR') );?>
														</span>

														<span class="badge bg-orange" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totbal, 'INR') );?>
														</span>
													
													</span>
												</div>
											</div>

											<div class="table-responsive">
												<table class="table datatable-buttons table-striped">
													<thead>
														<tr>
															<th>Status</th>
															<th>Invoice #</th>
															<th>Grand Total</th>
															<th>Amount Paid</th>
															<th>Balance Amount</th>
															<th>Created Date</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													<?php 
													if(!empty($invoices[0]['id']))
													{ 
														foreach($invoices as $inv)
														{ 
															if($inv['in_status']=="0")
															{
																$in_paid="";
																$sqlip="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																$qip=$conn->query($sqlip);
																$in_paid=$qip->fetchAll(PDO::FETCH_ASSOC);
														?>	
														<tr>
															<td>
															<?php if($inv['in_status']=="0"){ ?>
															<span class="label label-flat border-primary text-primary-600">Unpaid</span> 
															<?php }elseif($inv['in_status']=="1"){ ?>
															<span class="label label-flat border-orange text-orange-600">Partially Paid</span>
															<?php }elseif($inv['in_status']=="2"){ ?>
															<span class="label label-flat border-teal text-teal-600">Paid</span> 
															<?php }elseif ($inv['in_status']=="3") { ?>
															<span class="label label-flat border-danger text-danger-600">Cancelled</span>
															<?php }else{} ?>
															</td>
															<td>
																<a href="view_one_invoice.php?id=<?=$inv['id'];?>" class="text-semibold">
																<?=$inv['id'];?>
																</a>
															</td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($inv['in_grandtotal'], 'INR') );?></td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($in_paid[0]['paid_amt'], 'INR') );?></td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency(($inv['in_grandtotal']-$in_paid[0]['paid_amt']), 'INR') );?></td>
															<td><?=date('d-m-Y',strtotime($inv['in_date']));?></td>
															<td>
																<ul class="icons-list">
																	<li class="text-primary-600"><a href="<?=ROOT_URL;?>pdfmaker/create_pdf_invoice.php?in_id=<?=$inv['id'];?>&do=download" data-popup="tooltip" data-original-title="PDF"><i class="icon-file-pdf"></i></a></li>
																</ul>
															</td>
														</tr>
													<?php }}} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="tab-pane fade" id="pp_inv">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">PARTIALLY PAID INVOICES</h6>
												<div class="heading-elements">
													<span class="heading-text text-size-large">
													<?php 
													$totpaid=0; $totunpaid=0; $totbal=0;
														if(!empty($invoices))
														{ 
															foreach($invoices as $inv)
															{ 
																if($inv['in_status']=="1")
																{
																	$in_paid="";
																	$sqlip="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																	$qip=$conn->query($sqlip);
																	$in_paid=$qip->fetchAll(PDO::FETCH_ASSOC);

																	$sqlcount="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																	$qcount=$conn->query($sqlcount);
																	$count_inpaid=$qcount->fetchAll(PDO::FETCH_ASSOC);

																	$totpaid=$totpaid+$inv['in_grandtotal'];
																	$totunpaid=$totunpaid+$count_inpaid[0]['paid_amt'];
																	$totbal=$totbal+($inv['in_grandtotal']-$in_paid[0]['paid_amt']);
																}
															}
														} 
														?>
														
														<span class="badge bg-danger" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totpaid, 'INR') );?>
														</span>

														<span class="badge bg-success" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totunpaid, 'INR') );?>
														</span>

														<span class="badge bg-orange" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totbal, 'INR') );?>
														</span>
													
													</span>
												</div>
											</div>

											<div class="table-responsive">
												<table class="table datatable-buttons table-striped">
													<thead>
														<tr>
															<th>Status</th>
															<th>Invoice #</th>
															<th>Grand Total</th>
															<th>Amount Paid</th>
															<th>Balance Amount</th>
															<th>Created Date</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													<?php 
													if(!empty($invoices[0]['id']))
													{ 
														foreach($invoices as $inv)
														{ 
															if($inv['in_status']=="1")
															{
																$in_paid="";
																$sqlip="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																$qip=$conn->query($sqlip);
																$in_paid=$qip->fetchAll(PDO::FETCH_ASSOC);
														?>	
														<tr>
															<td>
															<?php if($inv['in_status']=="0"){ ?>
															<span class="label label-flat border-primary text-primary-600">Unpaid</span> 
															<?php }elseif($inv['in_status']=="1"){ ?>
															<span class="label label-flat border-orange text-orange-600">Partially Paid</span>
															<?php }elseif($inv['in_status']=="2"){ ?>
															<span class="label label-flat border-teal text-teal-600">Paid</span> 
															<?php }elseif ($inv['in_status']=="3") { ?>
															<span class="label label-flat border-danger text-danger-600">Cancelled</span>
															<?php }else{} ?>
															</td>
															<td>
																<a href="view_one_invoice.php?id=<?=$inv['id'];?>" class="text-semibold">
																<?=$inv['id'];?>
																</a>
															</td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($inv['in_grandtotal'], 'INR') );?></td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($in_paid[0]['paid_amt'], 'INR') );?></td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency(($inv['in_grandtotal']-$in_paid[0]['paid_amt']), 'INR') );?></td>
															<td><?=date('d-m-Y',strtotime($inv['in_date']));?></td>
															<td>
																<ul class="icons-list">
																	<li class="text-primary-600"><a href="<?=ROOT_URL;?>pdfmaker/create_pdf_invoice.php?in_id=<?=$inv['id'];?>&do=download" data-popup="tooltip" data-original-title="PDF"><i class="icon-file-pdf"></i></a></li>
																</ul>
															</td>
														</tr>
													<?php }}} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="tab-pane fade" id="paid_inv">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">PAID INVOICES</h6>
												<div class="heading-elements">
													<span class="heading-text text-size-large">
													<?php 
													$totpaid=0; $totunpaid=0; $totbal=0;
														if(!empty($invoices))
														{ 
															foreach($invoices as $inv)
															{ 
																if($inv['in_status']=="2")
																{
																	$in_paid="";
																	$sqlip="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																	$qip=$conn->query($sqlip);
																	$in_paid=$qip->fetchAll(PDO::FETCH_ASSOC);

																	$sqlcount="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																	$qcount=$conn->query($sqlcount);
																	$count_inpaid=$qcount->fetchAll(PDO::FETCH_ASSOC);

																	$totpaid=$totpaid+$inv['in_grandtotal'];
																	$totunpaid=$totunpaid+$count_inpaid[0]['paid_amt'];
																	$totbal=$totbal+($inv['in_grandtotal']-$in_paid[0]['paid_amt']);
																}
															}
														} 
														?>
														
														<span class="badge bg-danger" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totpaid, 'INR') );?>
														</span>

														<span class="badge bg-success" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totunpaid, 'INR') );?>
														</span>

														<span class="badge bg-orange" style="font-size: 12px;">
															<?=str_replace( 'Rs', '₹', $formatter->formatCurrency($totbal, 'INR') );?>
														</span>
													
													</span>
												</div>
											</div>

											<div class="table-responsive">
												<table class="table datatable-buttons table-striped">
													<thead>
														<tr>
															<th>Status</th>
															<th>Invoice #</th>
															<th>Grand Total</th>
															<th>Amount Paid</th>
															<th>Balance Amount</th>
															<th>Created Date</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													<?php 
													if(!empty($invoices[0]['id']))
													{ 
														foreach($invoices as $inv)
														{ 
															if($inv['in_status']=="2")
															{
																$in_paid="";
																$sqlip="SELECT SUM(txn_amount) as paid_amt FROM  transactions WHERE in_id='".$inv['id']."';";
																$qip=$conn->query($sqlip);
																$in_paid=$qip->fetchAll(PDO::FETCH_ASSOC);
														?>	
														<tr>
															<td>
															<?php if($inv['in_status']=="0"){ ?>
															<span class="label label-flat border-primary text-primary-600">Unpaid</span> 
															<?php }elseif($inv['in_status']=="1"){ ?>
															<span class="label label-flat border-orange text-orange-600">Partially Paid</span>
															<?php }elseif($inv['in_status']=="2"){ ?>
															<span class="label label-flat border-teal text-teal-600">Paid</span> 
															<?php }elseif ($inv['in_status']=="3") { ?>
															<span class="label label-flat border-danger text-danger-600">Cancelled</span>
															<?php }else{} ?>
															</td>
															<td>
																<a href="view_one_invoice.php?id=<?=$inv['id'];?>" class="text-semibold">
																<?=$inv['id'];?>
																</a>
															</td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($inv['in_grandtotal'], 'INR') );?></td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($in_paid[0]['paid_amt'], 'INR') );?></td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency(($inv['in_grandtotal']-$in_paid[0]['paid_amt']), 'INR') );?></td>
															<td><?=date('d-m-Y',strtotime($inv['in_date']));?></td>
															<td>
																<ul class="icons-list">
																	<li class="text-primary-600"><a href="<?=ROOT_URL;?>pdfmaker/create_pdf_invoice.php?in_id=<?=$inv['id'];?>&do=download" data-popup="tooltip" data-original-title="PDF"><i class="icon-file-pdf"></i></a></li>
																</ul>
															</td>
														</tr>
													<?php }}} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

									<div class="tab-pane fade" id="quotes">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">ALL QUOTATIONS</h6>
												<div class="heading-elements">
													
												</div>
											</div>

											<div class="table-responsive">
												<table class="table datatable-small">
													<thead>
														<tr>
															<th>Quote #</th>
															<th>Grand Total</th>
															<th>Survey #</th>
															<th>Created Date</th>
															<th>Expiry Date</th>
															<th style="display: none;"></th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody>
													<?php if(!empty($quotes)){ foreach($quotes as $quote){ ?>	
														<tr>
															<td>
																<a href="view_one_quotation.php?id=<?=$quote['id'];?>" class="text-semibold">
																<?=$quote['id'];?>
																</a>
															</td>
															<td><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($quote['qt_grandtotal'], 'INR') );?></td>
															<td><a href="view_one_survey.php?id=<?=$quote['qt_surveyid'];?>"><?=$quote['qt_surveyid'];?></a></td>
															<td><?=date('d-m-Y',strtotime($quote['qt_date']));?></td>
															
															<td><?=date('d-m-Y',strtotime($quote['qt_expdate']));?></td>
															<td style="display: none;"></td>
															<td class="text-center">
														<?php if($quote['qt_status']=="0"){ ?>
															<span class="label label-flat border-primary text-primary-600">Draft</span>
														<?php }elseif($quote['qt_status']=="1"){ ?>
															<span class="label label-flat border-orange text-orange-600">Delievered</span>
														<?php }elseif($quote['qt_status']=="2"){ ?>
															<span class="label label-flat border-teal text-teal-600">Approved</span>
														<?php }elseif($quote['qt_status']=="3"){ ?>
															<span class="label label-flat border-danger text-danger-600">Disapproved</span>
														<?php }elseif($quote['qt_status']=="4"){ ?>
															<span class="label label-flat border-teal text-teal-600">Accepted</span>
													<?php }else{}?>
															</td>
														</tr>
													<?php }} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									
									<div class="tab-pane fade" id="trips">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title">ALL TRIPS</h6>
												<div class="heading-elements">
													<span class="heading-text text-size-large">
													</span>
												</div>
											</div>

											<div class="table-responsive">
												<table class="table datatable-small">
													<thead style="width:100%;">
														<tr>
															<th>Trip No</th>
															<th>Trip Type</th>
															<th>Vehicle</th>
															<th>Driver</th>
															<th style="display: none;"></th>
															<th>From</th>
															<th>To</th>
															<th>Status</th>
															
														</tr>
													</thead>
													<tbody>
														<!-- full_load_trips start-->
														<?php if(!empty($full_trips)){ foreach($full_trips as $ft){ ?>
															<tr>
																<td><a href='view_one_fullload.php?id=<?=$ft['id'];?>'><?=$ft['id'];?></a></td>
																<td>FULL LOAD</td>
																<?php if($ft['fl_type']=="1"){ ?>
																	<td><a href="view_one_vehicle.php?id=<?=$ft['vid'];?>"><?=$ft['v_type'].' - '.$ft['lorry_no'];?></a></td>
																<?php }else{ ?>
																	<td><?=$ft['rent_vno'];?></td>
																<?php } ?>
																
																<?php if($ft['fl_type']=="1"){ ?>
																	<td><a href='view_one_driver.php?id=<?=$ft['fl_drid'];?>'><?=$ft['dr_name'].' ('.$ft['dr_phone'].')';?></a></td>
																<?php }else{ ?>
																	<td><?=$ft['rent_drphone'];?></td>
																<?php } ?>
																<td style="display: none;"></td>
																<td>
																	<?php if(!empty($cities))
																	{ 
																		foreach($cities as $ci)
																		{ 
																			if($ci['id']==$ft['in_fromcity'])
																			{
																				echo $ci['city_name'];
																			}
																		}
																	} ?>
																</td>
																<td>
																	<?php if(!empty($cities))
																	{ 
																		foreach($cities as $ci)
																		{ 
																			if($ci['id']==$ft['in_tocity'])
																			{ 
																				echo $ci['city_name'];
																			}
																		}
																	} ?>
																</td>
																<td>
																	<?php if($ft['fl_status']=="0"){ ?>
																		<span class="label label-flat border-primary text-primary-600">Initiated</span>
																	<?php }elseif($ft['fl_status']=="1"){ ?>
																		<span class="label label-flat border-orange text-orange-600">En-route</span>
																	<?php }elseif($ft['fl_status']=="2"){ ?>
																		<span class="label label-flat border-indigo text-indigo-600">In Warehouse</span>
																	<?php }elseif($ft['fl_status']=="3"){ ?>
																		<span class="label label-flat border-teal text-teal-600">Completed</span>
																	<?php }elseif($ft['fl_status']=="4"){ ?>
																		<span class="label label-flat border-danger text-danger-600">Canceled</span>
																	<?php }else{}?>
																</td>
															</tr>
														<?php }} ?>
														<!-- full_load_trips end -->

														<!-- part_load_trips start -->
														<?php if(!empty($trips_partload)){ foreach($trips_partload as $pt){ ?>
															<tr>
																<td><a href='view_one_fullload.php?id=<?=$pt['tp_id'];?>'><?=$pt['tp_id'].'-'.$pt['seq_id'];?></a></td>
																<td>PART LOAD</td>
																<?php if($pt['fl_type']=="1"){ ?>
																	<td><a href="view_one_vehicle.php?id=<?=$pt['vid'];?>"><?=$pt['v_type'].' - '.$pt['lorry_no'];?></a></td>
																<?php }else{ ?>
																	<td><?=$pt['rent_vno'];?></td>
																<?php } ?>
																
																<?php if($pt['fl_type']=="1"){ ?>
																	<td><a href='view_one_driver.php?id=<?=$pt['fl_drid'];?>'><?=$pt['dr_name'].' ('.$pt['dr_phone'].')';?></a></td>
																<?php }else{ ?>
																	<td><?=$pt['rent_drphone'];?></td>
																<?php } ?>
																<td style="display: none;"></td>
																<td>
																	<?php if(!empty($cities))
																	{ 
																		foreach($cities as $ci)
																		{ 
																			if($ci['id']==$pt['in_fromcity'])
																			{
																				echo $ci['city_name'];
																			}
																		}
																	} ?>
																</td>
																<td>
																	<?php if(!empty($cities))
																	{ 
																		foreach($cities as $ci)
																		{ 
																			if($ci['id']==$pt['in_tocity'])
																			{ 
																				echo $ci['city_name'];
																			}
																		}
																	} ?>
																</td>
																<td>
																	<?php if($pt['pl_status']=="0"){ ?>
																		<span class="label label-flat border-primary text-primary-600">Initiated</span>
																	<?php }elseif($pt['pl_status']=="1"){ ?>
																		<span class="label label-flat border-orange text-orange-600">En-route</span>
																	<?php }elseif($pt['pl_status']=="2"){ ?>
																		<span class="label label-flat border-indigo text-indigo-600">In Warehouse</span>
																	<?php }elseif($pt['pl_status']=="3"){ ?>
																		<span class="label label-flat border-teal text-teal-600">Completed</span>
																	<?php }elseif($pt['pl_status']=="4"){ ?>
																		<span class="label label-flat border-danger text-danger-600">Canceled</span>
																	<?php }else{}?>
																</td>
															</tr>
														<?php }} ?>
														<!-- part_load_trips end -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- /tab content -->

							</div>
						</div>
					</div>

				</div>
				<!-- Main content -->
			</div>
		<!-- Page content end-->
		</div>
<!-- Page container end-->	

<script type="text/javascript">   
    $(document).ready(function() {    

     $('#edit_customer_form').on('submit', function (e) {
          e.preventDefault();

           if( $("#cp_name").val()=="" || $("#cp_phone").val()=="" || $("#cp_company").val()=="" || $("#cp_email").val()=="")
          {
          	return false;
          }
          else
          	{
	          $.ajax({
	            	type: 'post',
	            	url: '<?=ROOT_URL;?>models/edit_customer.php',
	            	data: $('#edit_customer_form').serialize(),
	            	dataType:'json',
	            	success: function (response) 
	            	{

	            	if(response.status==true){

	            		$('#edit_customer_form').trigger("reset");
	            		$('#msg').append(response.msg);

	            		setTimeout(function () {
	       					window.location.reload(); 
	    				}, 500);
	            	}
	            	else{
	            		$('#msg').append(response.msg);
	            	}
	            	}
	         	});
	      	}
      });

     $('.datatable-buttons').DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [0] } ],
        autoWidth: true,
        
        buttons: {            
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                {
                extend: 'excel',
                footer: true,
                header: true,
                title: 'Ledger Report - <?php if(!empty($results[0]["com_name"])){ echo $results[0]["cp_name"].' ('.$results[0]["com_name"].')'; }else{echo $results[0]["cp_name"]; } ?>',
               }
            ]
        }
    });
     
 });

</script>				

<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
	</body>

</html>
