<html>
<head>
    <style>

        * { margin: 0; padding: 0; }
        body {
            font: 14px/1.4  dejavusanscondensed;
        }
        #page-wrap { width: 100%; margin: 0 auto; }

        table { border-collapse: collapse; }
        table td  { border: 1px solid black; padding: 2px 2px; font-size: 12px; text-align: center;}
        table th { border: 1px solid black; padding: 2px 2px; font-size: 12px; text-align: center; background: #eee;}

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
        <h4 align="center">REPORTS  FROM <?=$fdate; ?> TO <?=$tdate; ?></h4>
        <hr>
        <br>
        <h5>CUSTOMERS REPORT :</h5>
        <table width="100%" align="center">
            <thead>
                <tr>
                    <th width="20%">Type</th>
                    <th width="20%">Customer</th>
                    <th width="20%">Quotation</th>
                    <th width="20%">Invoice</th>
                    <th width="20%">Income</th>
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
        <table width="100%" align="center">
            <thead>
                <tr>    
                    <th width="20%">Created</th>
                    <th width="20%">Delivered</th>
                    <th width="20%">Approved</th>
                    <th width="20%">Disapproved</th>
                    <th width="20%">Drafted</th>
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
        <table width="100%" align="center">
            <thead>
                <tr>    
                    <th width="20%">Created</th>
                    <th width="20%">Unpaid</th>
                    <th width="20%">Partially Paid</th>
                    <th width="20%">Paid</th>
                    <th width="20%">Cancelled</th>
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
        <table width="100%" align="center">
            <thead>
                <tr>    
                    <th width="25%">Total Income</th>
                    <th width="25%">Purchase Orders</th>
                    <th width="25%">Expenses</th>
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
                        <?=str_replace('Rs','₹',$formatter->formatCurrency($exp_total,'INR')); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

