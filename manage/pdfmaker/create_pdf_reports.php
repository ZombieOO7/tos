<?php 

    if(!isset($_SESSION)) { session_start(); } 
    include_once '../config/master.inc.php';
    require_once ROOT_PATH.'pdfmaker/mpdf/autoload.php';
    include ROOT_PATH."config/connection.php"; 
    $formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

    if(!empty($_POST['fdate']) && !empty($_POST['tdate'])){extract($_POST);}else{extract($_GET);}
         
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

        if(!empty($fdate) && !empty($tdate))
        {
            $from_date=date("Y-m-d",strtotime($fdate));
            $to_date=date("Y-m-d",strtotime($tdate));

            //start quotation reports
            $sqlqt="SELECT qt_grandtotal,qt_status FROM quotations WHERE (CAST(qt_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
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
            $sqlin="SELECT id,in_grandtotal,in_status FROM invoices WHERE (CAST(in_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
            $qin= $conn->query($sqlin);
            $invoices=$qin->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($invoices))
            { 
                foreach($invoices as $invoice)
                { 
                    if($invoice['in_status']==1){

                        $sqlppaid="SELECT sum(txn_amount) as pin_inc  FROM transactions WHERE in_id='".$invoice['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
                        $qppaid= $conn->query($sqlppaid);
                        $ppaid_income=$qppaid->fetchAll(PDO::FETCH_ASSOC);

                        $partially_paid++;
                        $partially_paid_total+=$invoice['in_grandtotal']-$ppaid_income[0]['pin_inc'];
                    }
                    if($invoice['in_status']==2){
                        $sqlpaid="SELECT sum(txn_amount) as in_inc  FROM transactions WHERE in_id='".$invoice['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
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
            $sqltxn="SELECT count(*) as income_count,sum(txn_amount) as total_income FROM transactions WHERE (CAST(created_at AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
            $qtxn= $conn->query($sqltxn);
            $transactions=$qtxn->fetchAll(PDO::FETCH_ASSOC);
            $income_total=$transactions[0]['total_income'];
            $income=$transactions[0]['income_count'];
        
            $sqlpo="SELECT count(*) as po_count,sum(po_grandtot) as total_po FROM purchase_orders WHERE (CAST(po_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
            $qpo= $conn->query($sqlpo);
            $purchase_orders=$qpo->fetchAll(PDO::FETCH_ASSOC);
            $po_total=$purchase_orders[0]['total_po'];
            $po=$purchase_orders[0]['po_count'];
        
            $sqle="SELECT count(*) as exp_count,sum(txn_amount) as total_exp FROM transactions WHERE (txn_type='2' OR txn_type='3') AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date') AND  org_id='".$_SESSION['org_id']."';";
            $qe= $conn->query($sqle);
            $expenses=$qe->fetchAll(PDO::FETCH_ASSOC);
            $exp_total=$expenses[0]['total_exp'];
            $exp=$expenses[0]['exp_count'];
            //end income-expense reports

            //start cutomer report
            $sqlcn="SELECT id FROM customers WHERE (CAST(created_at AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
            $qcn= $conn->query($sqlcn);
            $new_customers=$qcn->fetchAll(PDO::FETCH_ASSOC);

            foreach ($new_customers as $new_cust) 
            {   
                $sqlqt_new="SELECT count(*) as cust_qt_count FROM quotations WHERE qt_custid='".$new_cust['id']."' AND (CAST(qt_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
                $qqtnew= $conn->query($sqlqt_new);
                $new_quotations=$qqtnew->fetchAll(PDO::FETCH_ASSOC);

                $sqlin_new="SELECT count(*) as cust_in_count  FROM invoices WHERE in_custid='".$new_cust['id']."' AND (CAST(in_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
                $qinnew= $conn->query($sqlin_new);
                $new_invoices=$qinnew->fetchAll(PDO::FETCH_ASSOC);

                $sqltxn_new="SELECT sum(txn_amount) as cust_in_inc  FROM transactions WHERE txn_custid='".$new_cust['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
                $qtxnnew= $conn->query($sqltxn_new);
                $new_income=$qtxnnew->fetchAll(PDO::FETCH_ASSOC);

                $new_cust_qtcount+=$new_quotations[0]['cust_qt_count'];
                $new_cust_invcount+=$new_invoices[0]['cust_in_count'];

                if(!empty($new_income))
                {
                    $new_cust_income+=$new_income[0]['cust_in_inc'];
                }
            }   

            $sqlco="SELECT id FROM customers WHERE (CAST(created_at AS DATE)<'$from_date') AND org_id='".$_SESSION['org_id']."';";
            $qco= $conn->query($sqlco);
            $old_customers=$qco->fetchAll(PDO::FETCH_ASSOC);    
            
            foreach ($old_customers as $old_cust) 
            {
                $sqlqt_old="SELECT count(*) as cust_qt_count ,sum(qt_grandtotal) as cust_qt_inc FROM quotations WHERE qt_custid='".$old_cust['id']."' AND (CAST(qt_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
                $qqtold= $conn->query($sqlqt_old);
                $old_quotations=$qqtold->fetchAll(PDO::FETCH_ASSOC);

                $sqlin_old="SELECT count(*) as cust_in_count ,sum(in_grandtotal) as cust_in_inc FROM invoices WHERE in_custid='".$old_cust['id']."' AND (CAST(in_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
                $qinold= $conn->query($sqlin_old);
                $old_invoices=$qinold->fetchAll(PDO::FETCH_ASSOC);

                $sqltxn_old="SELECT sum(txn_amount) as cust_in_inc  FROM transactions WHERE txn_custid='".$old_cust['id']."' AND (CAST(txn_date AS DATE) between '$from_date' AND '$to_date') AND org_id='".$_SESSION['org_id']."';";
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
        }
         
        $sqlo="SELECT *,o.id,c.countries_name,s.state_name FROM organization o LEFT JOIN countries c ON o.org_country=c.countries_id LEFT JOIN states s ON o.org_state=s.id WHERE o.id='".$_SESSION['org_id']."';";
        $queryo = $conn->query($sqlo);
        $orgData=$queryo->fetchAll(PDO::FETCH_ASSOC);   

        if(!empty($fdate) && !empty($tdate))
        {
            $mpdfConfig = array(
            'mode' => 'utf-8', 
            //'default_font'=>'',
            'format' => 'A4',    // format - A4, for example, default ''
            'margin_left' => 10,     // 15 margin_left
            'margin_right' => 10,        // 15 margin right
            'margin_top' => 10,     // 16 margin top
            'margin_bottom' => 10,       // margin bottom
            );
            $mpdf = new \Mpdf\Mpdf($mpdfConfig);
            $mpdf->SetTitle($orgData[0]['org_name']."- Report");

            ob_start();

            require ROOT_PATH.'pdfmaker/reports.php';

            $html = ob_get_contents();
            ob_end_clean();
            
            $mpdf->WriteHTML($html);
            $mpdf->Output("Report_".$fdate."_to_".$tdate.'.pdf', 'I'); //view
        }
        else
        {
            $_SESSION['i']="NO DATA";
            echo "<script>history.go(-1);</script>";
        }
?>