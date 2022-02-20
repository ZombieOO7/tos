<?php 

    if(!isset($_SESSION)) { session_start(); } 
    include_once '../config/master.inc.php';
    require_once ROOT_PATH.'pdfmaker/mpdf/autoload.php';
    include ROOT_PATH."config/connection.php"; 
    $formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

    if(!empty($_POST['cmonth']) && !empty($_POST['cyear'])){extract($_POST);}else{extract($_GET);}
        $cmonth=explode(",", $cmonth);
        $cyear=explode(",", $cyear);
        
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
         
        $sqlo="SELECT *,o.id,c.countries_name,s.state_name FROM organization o LEFT JOIN $rootdb.countries c ON o.org_country=c.countries_id LEFT JOIN $rootdb.states s ON o.org_state=s.id WHERE o.id='".$_SESSION['org_id']."';";
        $queryo = $conn->query($sqlo);
        $orgData=$queryo->fetchAll(PDO::FETCH_ASSOC);

       
         $mpdfConfig = array(
            'mode' => 'utf-8', 
            'format' => 'A4-L',    // format - A4, for example, default ''
            'margin_left' => 10,     // 15 margin_left
            'margin_right' => 10,        // 15 margin right
            'margin_top' => 10,     // 16 margin top
            'margin_bottom' => 10,       // margin bottom
        );
        $mpdf = new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetTitle($orgData[0]['org_name']." Report - ".date("M, Y",strtotime($cyear[0]."-".$cmonth[0]))." & ".date("M, Y",strtotime($cyear[1]."-".$cmonth[1])));

        ob_start();

        require ROOT_PATH.'pdfmaker/creports.php';

        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output("Report_".date("Y-m-d").'.pdf', 'I'); //view
       
?>