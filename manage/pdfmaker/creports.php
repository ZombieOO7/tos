<html>
<head>
	<style>

		* { margin: 0; padding: 0; }
		body {
			font: 12px  dejavusanscondensed;
		}
		#page-wrap { width: 100%; margin: 0 auto; }

		table { border-collapse: collapse; }
		table td  { border: 1px solid black; padding: 2px 5px; font-size: 12px; text-align: center;}
		table th { border: 1px solid black; padding: 2px 5px; font-size: 12px; text-align: center; background: #eee;}

		#customer { overflow: hidden; }

		#logo { text-align: right; float: right; position: relative; margin-top: 5px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }

		#meta { margin-top: 1px; width: 100%; }
		/*#meta td { text-align: left;  }*/
		#meta td.meta-head { text-align: left; background: #eee; }
		#meta td textarea { width: 100%; height: 20px; text-align: right; }

		#items { clear: both; width: 100%; margin: 0 0 0 0; border: 1px solid black; }
		#items th { background: #eee; }
		#items textarea { width: 80px; height: 50px; }
		#items tr.item-row td {  vertical-align: top; }
		#items td.description { width: 300px; }
		#items td.item-name { width: 175px; }
		#items td.description textarea, #items td.item-name textarea { width: 100%; }
		#items td.total-line { border-right: 0; text-align: right; }
		#items td.total-value { border-left: 0; padding: 10px; }
		#items td.total-value textarea { height: 20px; background: none; }
		#items td.balance { background: #eee; }
		#items td.blank { border: 0; }
		#center{
			text-align: center !important;
		}
		#left{
			text-align: left !important;
			float:left;
		}
		a{
			text-decoration: none;
		}
	</style>
</head>
<body style="font-family:dejavusanscondensed">
	<div id="page-wrap">
		<table width="100%">
			<tr>
				<td style="border: 0;  text-align: center" width="100%">
					<div id="logo">
						<img src="<?=ROOT_URL.$orgData[0]['org_logo'];?>" alt="Logo"><br><br>
						<?=$orgData[0]['org_name'];?>
						<?php echo $orgData[0]['org_address'].", ".$orgData[0]['state_name'].", ".$orgData[0]['countries_name'].", ".$orgData[0]['org_pin']."<br>".$orgData[0]['org_pphone']." | ".$orgData[0]['org_pemail']."<br>"; ?>
						<?php if(isset($orgData[0]['org_llpin']) && !empty($orgData[0]['org_llpin'])){ ?>
							<strong>LLPIN</strong> : <?=$orgData[0]['org_llpin'];?> | 
						<?php }else{ ?>
							<strong>CIN</strong> : <?=$orgData[0]['org_cin'];?> | 
						<?php } ?>

						<?php if(isset($orgData[0]['org_gstno']) && !empty($orgData[0]['org_gstno'])){ if(strlen($orgData[0]['org_gstno'])>2){ ?>
							<strong>GSTIN : </strong><?=$orgData[0]['org_gstno'];?> | <strong>PAN : </strong><?=substr(substr($orgData[0]['org_gstno'], -13),0,10);?>
						<?php }} ?>
					</div>
				</td>
			</tr>
		</table>
		<hr>
		<table width="100%">
			<tbody>
				<tr>
					<?php

				if(!empty($cmonth) && !empty($cyear))
				{
					$allDates=$cyear[0]."-".$cmonth[0]."-01"."/".$cyear[0]."-".$cmonth[0].",".$cyear[1]."-".$cmonth[1]."-01"."/".$cyear[1]."-".$cmonth[1];

					$pickDate=explode(",", $allDates);

					foreach ($pickDate as $one_date) 
					{

						$my_dates="";
						$fdate="";
						$tdate="";

						$my_dates=explode("/", $one_date);
						$fdate=$my_dates[0];
						$tdate=date("Y-m-t",strtotime($my_dates[1]));

							//start quotation variables
						$new_cust_qtcount=0;	
						$new_cust_invcount=0;		
						$new_cust_income=0;
						$old_cust_qtcount=0;	
						$old_cust_invcount=0;		
						$old_cust_income=0;
							//end quotation variables	

							//start quotation variables		
						$qt_approved=0;
						$qt_disapproved=0;
						$qt_draft=0;
						$qt_delivered=0;

						$qt_total=0;
						$qt_approved_total=0;
						$qt_disapproved_total=0;
						$qt_draft_total=0;
						$qt_delivered_total=0;
							//end quotation variables

							//start invoice variables
						$unpaid=0;
						$partially_paid=0;
						$paid=0;
						$cancelled=0;

						$in_total=0;
						$unpaid_total=0;
						$partially_paid_total=0;
						$paid_total=0;
						$cancelled_total=0;
							//end invoice variables

							//start income-expense variables
						$income=0;
						$po=0;
						$pv=0;
						$exp=0;

						$income_total=0;
						$po_total=0;
						$pv_total=0;
						$exp_total=0;
							//end income-expense variables	

							//start trip variables
						$enroute=0;
						$warehouse=0;
						$completed=0;
						$cancelled_trip=0;
						$initiated=0;

						$fl_count=0;
						$pl_count=0;
							//end trip variables	

						$from_date=$fdate;
						$to_date=$tdate;

						$quotations="";
						$invoices="";
						$ppaid_income="";
						$paid_income="";
						$purchase_orders="";
						$purchase_vouchers="";
						$expenses="";
						$trips_partload="";
						$new_customers="";
						$new_quotations="";
						$new_invoices="";
						$new_income="";
						$old_customers="";
						$old_quotations="";
						$old_invoices="";
						$old_income="";

							//start quotation reports
						$sqlqt="SELECT qt_grandtotal,qt_status FROM quotations WHERE CAST(qt_date AS DATE) between '$from_date' AND '$to_date';";
						$qqt= $conn->query($sqlqt);
						$quotations=$qqt->fetchAll(PDO::FETCH_ASSOC);

						if(!empty($quotations))
						{ 
							foreach($quotations as $quote)
							{ 
								if($quote['qt_status']==1){
									$qt_delivered++;
									$qt_delivered_total+=$quote['qt_grandtotal'];
								}
								if($quote['qt_status']==2){
									$qt_approved++;
									$qt_approved_total+=$quote['qt_grandtotal'];
								}
								if($quote['qt_status']==3){
									$qt_disapproved++;
									$qt_disapproved_total+=$quote['qt_grandtotal'];
								}
								if($quote['qt_status']==0){
									$qt_draft++;
									$qt_draft_total+=$quote['qt_grandtotal'];
								}

								$qt_total+=$quote['qt_grandtotal'];
							}
						}

							//end quotation reports

							//start invoice reports
						$sqlin="SELECT id,in_grandtotal,in_status FROM invoices WHERE CAST(in_date AS DATE) between '$from_date' AND '$to_date';";
						$qin= $conn->query($sqlin);
						$invoices=$qin->fetchAll(PDO::FETCH_ASSOC);

						if(!empty($invoices))
						{ 
							foreach($invoices as $invoice)
							{ 
								if($invoice['in_status']==1){

									$sqlppaid="SELECT sum(txn_amount) as pin_inc  FROM transactions WHERE in_id='".$invoice['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date');";
									$qppaid= $conn->query($sqlppaid);
									$ppaid_income=$qppaid->fetchAll(PDO::FETCH_ASSOC);

									$partially_paid++;
									$partially_paid_total+=$invoice['in_grandtotal']-$ppaid_income[0]['pin_inc'];
								}
								if($invoice['in_status']==2){
									$sqlpaid="SELECT sum(txn_amount) as in_inc  FROM transactions WHERE in_id='".$invoice['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date');";
									$qpaid= $conn->query($sqlpaid);
									$paid_income=$qpaid->fetchAll(PDO::FETCH_ASSOC);

									$paid++;
									$paid_total+=$paid_income[0]['in_inc'];
								}
								if($invoice['in_status']==3){
									$cancelled++;
									$cancelled_total+=$invoice['in_grandtotal'];
								}
								if($invoice['in_status']==0){
									$unpaid++;
									$unpaid_total+=$invoice['in_grandtotal'];
								}
								$in_total+=$invoice['in_grandtotal'];
							}
						}
							//end invoice reports

							//start income-expense reports
						$sqltxn="SELECT count(*) as income_count,sum(txn_amount) as total_income FROM transactions WHERE CAST(created_at AS DATE) between '$from_date' AND '$to_date';";
						$qtxn= $conn->query($sqltxn);
						$transactions=$qtxn->fetchAll(PDO::FETCH_ASSOC);
						$income_total=$transactions[0]['total_income'];
						$income=$transactions[0]['income_count'];

						$sqlpo="SELECT count(*) as po_count,sum(po_grandtot) as total_po FROM purchase_orders WHERE CAST(po_date AS DATE) between '$from_date' AND '$to_date';";
						$qpo= $conn->query($sqlpo);
						$purchase_orders=$qpo->fetchAll(PDO::FETCH_ASSOC);
						$po_total=$purchase_orders[0]['total_po'];
						$po=$purchase_orders[0]['po_count'];

						$sqlpv="SELECT count(*) as pv_count,sum(pos_totamt) as total_pv FROM purchase_vouchers WHERE CAST(pos_date AS DATE) between '$from_date' AND '$to_date';";
						$qpv= $conn->query($sqlpv);
						$purchase_vouchers=$qpv->fetchAll(PDO::FETCH_ASSOC);
						$pv_total=$purchase_vouchers[0]['total_pv'];
						$pv=$purchase_vouchers[0]['pv_count'];

						$sqle="SELECT count(*) as exp_count,sum(ex_amount) as total_exp FROM expenses WHERE CAST(ex_date AS DATE) between '$from_date' AND '$to_date';";
						$qe= $conn->query($sqle);
						$expenses=$qe->fetchAll(PDO::FETCH_ASSOC);
						$exp_total=$expenses[0]['total_exp'];
						$exp=$expenses[0]['exp_count'];
							//end income-expense reports

							//start trip reports
						$sqlt="SELECT id,trip_type,fl_status,fpod_status FROM trips_fullload WHERE CAST(created_at AS DATE) between '$from_date' AND '$to_date';";
						$qt= $conn->query($sqlt);
						$trips_fullload=$qt->fetchAll(PDO::FETCH_ASSOC);

						if(!empty($trips_fullload))
						{ 
							foreach($trips_fullload as $tf)
							{ 
								if($tf['trip_type']=="1")
								{
									if($tf['fl_status']==1){
										$enroute++;
									}
									if($tf['fl_status']==2){
										$warehouse++;
									}
									if($tf['fl_status']==3){
										$completed++;
									}
									if($tf['fl_status']==4){
										$cancelled_trip++;
									}
									if($tf['fl_status']==0){
										$initiated++;
									}

									$fl_count++;
								}
								elseif($tf['trip_type']=="2")
								{
									$sqlpl="SELECT pl_status,ppod_status FROM trips_partload WHERE tp_id='".$tf['id']."';";
									$qpl= $conn->query($sqlpl);
									$trips_partload=$qpl->fetchAll(PDO::FETCH_ASSOC);

									if(!empty($trips_partload))
									{ 
										foreach($trips_partload as $tp)
										{ 

											if($tp['pl_status']==1){
												$enroute++;
											}
											if($tp['pl_status']==2){
												$warehouse++;
											}
											if($tp['pl_status']==3){
												$completed++;
											}
											if($tp['pl_status']==4){
												$cancelled_trip++;
											}
											if($tp['pl_status']==0){
												$initiated++;
											}

											$pl_count++;
										}	
									}

								}
								else{}
							}

					}
						//end trip reports	


						//start cutomer report
					$sqlcn="SELECT id FROM customers WHERE CAST(created_at AS DATE) between '$from_date' AND '$to_date';";
					$qcn= $conn->query($sqlcn);
					$new_customers=$qcn->fetchAll(PDO::FETCH_ASSOC);
					$new_cust_count=count($new_customers);

					foreach ($new_customers as $new_cust) 
					{	
						$sqlqt_new="SELECT count(*) as cust_qt_count FROM quotations WHERE qt_custid='".$new_cust['id']."' AND (CAST(qt_date AS DATE) between '$from_date' AND '$to_date');";
						$qqtnew= $conn->query($sqlqt_new);
						$new_quotations=$qqtnew->fetchAll(PDO::FETCH_ASSOC);

						$sqlin_new="SELECT count(*) as cust_in_count  FROM invoices WHERE in_custid='".$new_cust['id']."' AND (CAST(in_date AS DATE) between '$from_date' AND '$to_date');";
						$qinnew= $conn->query($sqlin_new);
						$new_invoices=$qinnew->fetchAll(PDO::FETCH_ASSOC);

						$sqltxn_new="SELECT sum(txn_amount) as cust_in_inc  FROM transactions WHERE txn_custid='".$new_cust['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date');";
						$qtxnnew= $conn->query($sqltxn_new);
						$new_income=$qtxnnew->fetchAll(PDO::FETCH_ASSOC);

						$new_cust_qtcount+=$new_quotations[0]['cust_qt_count'];
						$new_cust_invcount+=$new_invoices[0]['cust_in_count'];

						if(!empty($new_income))
						{
							$new_cust_income+=$new_income[0]['cust_in_inc'];
						}
					}	

					$sqlco="SELECT id FROM customers WHERE CAST(created_at AS DATE)<'$from_date';";
					$qco= $conn->query($sqlco);
					$old_customers=$qco->fetchAll(PDO::FETCH_ASSOC);
					$old_cust_count=count($old_customers);	

					foreach ($old_customers as $old_cust) 
					{
						$sqlqt_old="SELECT count(*) as cust_qt_count ,sum(qt_grandtotal) as cust_qt_inc FROM quotations WHERE qt_custid='".$old_cust['id']."' AND (CAST(qt_date AS DATE) between '$from_date' AND '$to_date');";
						$qqtold= $conn->query($sqlqt_old);
						$old_quotations=$qqtold->fetchAll(PDO::FETCH_ASSOC);

						$sqlin_old="SELECT count(*) as cust_in_count ,sum(in_grandtotal) as cust_in_inc FROM invoices WHERE in_custid='".$old_cust['id']."' AND (CAST(in_date AS DATE) between '$from_date' AND '$to_date');";
						$qinold= $conn->query($sqlin_old);
						$old_invoices=$qinold->fetchAll(PDO::FETCH_ASSOC);

						$sqltxn_old="SELECT sum(txn_amount) as cust_in_inc  FROM transactions WHERE txn_custid='".$old_cust['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date');";
						$qtxnold= $conn->query($sqltxn_old);
						$old_income=$qtxnold->fetchAll(PDO::FETCH_ASSOC);

						$old_cust_qtcount+=$old_quotations[0]['cust_qt_count'];
						$old_cust_invcount+=$old_invoices[0]['cust_in_count'];

						if(!empty($old_income))
						{
							$old_cust_income+=$old_income[0]['cust_in_inc'];
						}
					}	
						//end customer report	
					?>  
					<td style="border:0;" align="left">
						<h4 align="center">REPORT FROM <?=date("d-m-Y",strtotime($from_date)); ?> TO <?=date("d-m-Y",strtotime($to_date)); ?></h4>
						<hr>
						<br>					      
						<h5>CUSTOMERS REPORT :</h5>
						<table align="center" width="100%">
							<thead>
								<tr>
									<th>Type</th>
									<th>Customer</th>
									<th>Quotation</th>
									<th>Invoice</th>
									<th>Income</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>New</td>
									<td>
										<?php 
										if(!empty($new_customers))
										{
											echo count($new_customers);
										}
										else
										{
											echo '0';
										}
										?>
									</td>
									<td><?=$new_cust_qtcount; ?></td>
									<td><?=$new_cust_invcount; ?></td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($new_cust_income,'INR')); ?>
									</td>
								</tr>
								<tr>
									<td>Old</td>
									<td>
										<?php 
										if(!empty($old_customers))
										{
											echo count($old_customers);
										}
										else
										{
											echo '0';
										}
										?>
									</td>
									<td><?=$old_cust_qtcount; ?></td>
									<td><?=$old_cust_invcount; ?></td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($old_cust_income,'INR')); ?>
									</td>
								</tr>
							</tbody>
						</table>
						<br>
						<h5>QUOTATIONS REPORT :</h5>
						<table align="center" width="100%">
							<thead>
								<tr>    
									<th>Created</th>
									<th>Delivered</th>
									<th>Approved</th>
									<th>Disapproved</th>
									<th>Drafted</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php 
										if(!empty($quotations))
										{
											echo count($quotations);
										}
										else
										{
											echo '0';
										}
										?>
									</td>
									<td><?=$qt_delivered; ?></td>
									<td><?=$qt_approved; ?></td>
									<td><?=$qt_disapproved; ?></td>
									<td><?=$qt_draft; ?></td>
								</tr>
								<tr>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($qt_total, 'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($qt_delivered_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($qt_approved_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($qt_disapproved_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($qt_draft_total,'INR')); ?>
									</td>
								</tr>
							</tbody>
						</table>
						<br>
						<h5>INVOICES REPORT :</h5>
						<table align="center" width="100%">
							<thead>
								<tr>    
									<th>Created</th>
									<th>Unpaid</th>
									<th>Partially Paid</th>
									<th>Paid</th>
									<th>Cancelled</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php 
										if(!empty($invoices))
										{
											echo count($invoices);
										}
										else
										{
											echo '0';
										}
										?>
									</td>
									<td><?=$unpaid; ?></td>
									<td><?=$partially_paid; ?></td>
									<td><?=$paid; ?></td>
									<td><?=$cancelled; ?></td>
								</tr>
								<tr>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($in_total, 'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($unpaid_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($partially_paid_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($paid_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($cancelled_total,'INR')); ?>
									</td>
								</tr>
							</tbody>
						</table>
						<br>
						<h5>INCOMES & EXPENSES REPORT :</h5>
						<table align="center" width="100%">
							<thead>
								<tr>    
									<th>Total Income</th>
									<th>Purchase Orders</th>
									<th>Purchase Vouchers</th>
									<th>Expenses</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php 
										if(!empty($income))
										{
											echo $income;
										}
										else
										{
											echo "0";
										}
										?>
									</td>
									<td><?=$po; ?></td>
									<td><?=$pv; ?></td>
									<td><?=$exp; ?></td>
								</tr>
								<tr>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($income_total, 'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($po_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($pv_total,'INR')); ?>
									</td>
									<td>
										<?=str_replace('Rs','₹',$formatter->formatCurrency($exp_total,'INR')); ?>
									</td>
								</tr>
							</tbody>
						</table>
						<br>
						<h5>TRIPS REPORT :</h5>
						<table align="center" width="100%">
							<thead>
								<tr>
									<th>Created</th>
									<th>Full Load</th>
									<th>Part Load</th>
									<th>Completed</th>
									<th>En-routed</th>
									<th>In Warehouse</th>
									<th>Cancelled</th>
									<th>Initiated</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php
										if(!empty($fl_count) && !empty($pl_count))
										{
											echo ($fl_count+$pl_count);
										}
										else
										{
											echo '0';
										}
										?>
									</td>
									<td>
										<?php 
										if(!empty($fl_count))
										{
											echo $fl_count;
										}
										else
										{
											echo '0';
										}
										?>
									</td>
									<td>
										<?php 
										if(!empty($pl_count))
										{
											echo $pl_count;
										}
										else
										{
											echo '0';
										}
										?>
									</td>
									<td><?=$completed; ?></td>
									<td><?=$enroute; ?></td>
									<td><?=$warehouse; ?></a></td>
									<td><?=$cancelled_trip; ?></td>
									<td><?=$initiated; ?></td>
								</tr>
							</tbody>
						</table>
					</td>
					<?php }} ?>
				</tr>
			</tbody>
		</table>
</div>
</body>
</html>