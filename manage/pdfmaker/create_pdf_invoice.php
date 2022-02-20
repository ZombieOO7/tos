<?php  if(!isset($_SESSION)) { session_start(); } 
        include_once '../config/master.inc.php';
        require_once ROOT_PATH.'pdfmaker/mpdf/autoload.php';
        include ROOT_PATH."config/connection.php"; 
        $formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

    if(isset($_POST['in_id']) && !empty($_POST['in_id'])){extract($_POST);}else{extract($_GET);}

    $sql="SELECT *,n.id,n.in_status,co.countries_name,s.state_name FROM invoices n
        LEFT JOIN customers c ON n.in_custid=c.id 
        LEFT JOIN countries co ON co.countries_id=c.com_country
        LEFT JOIN states s ON s.id=c.com_state
        LEFT JOIN users u ON n.created_by=u.id WHERE n.id='$in_id';";
    $query_db = $conn->query($sql);
    $results=$query_db->fetchAll(PDO::FETCH_ASSOC); 

    $tds_amt=$results[0]['in_tdsamt'];
    $tds_perc=$results[0]['in_tdsperc'];
    /*print_r($results);*/

    $sqlqi="SELECT * FROM invoice_items WHERE in_id='$in_id';";
    $qi = $conn->query($sqlqi);
    $items=$qi->fetchAll(PDO::FETCH_ASSOC); 
    /*print_r($items);*/

    $sqlo="SELECT *,o.id,c.countries_name,s.state_name FROM organization o 
            LEFT JOIN countries c ON o.org_country=c.countries_id 
            LEFT JOIN states s ON o.org_state=s.id 
            WHERE o.id='".$_SESSION['org_id']."';";
    $queryo = $conn->query($sqlo);
    $orgData=$queryo->fetchAll(PDO::FETCH_ASSOC);   
    /*print_r($results);*/

    $sqlt="SELECT SUM(txn_amount) as paid_amount FROM transactions WHERE in_id='$in_id' AND txn_custid='".$results[0]['in_custid']."';";
    $qtx= $conn->query($sqlt);
    $transactions=$qtx->fetchAll(PDO::FETCH_ASSOC);
    $paid_amount=$transactions[0]['paid_amount'];

    $sqltx="SELECT t.id,t.txn_date,t.txn_amount,CONCAT(sa.bank_name,' (',sa.acc_no,')') as bank_acc,sp.name as pay_mt FROM transactions t 
        LEFT JOIN sys_accounts sa ON t.account=sa.id 
        LEFT JOIN sys_pmethods sp ON t.pay_method=sp.id 
        WHERE in_id='$in_id' AND txn_custid='".$results[0]['in_custid']."' ORDER BY t.id DESC;";
    $qtxn= $conn->query($sqltx);
    $alltxn=$qtxn->fetchAll(PDO::FETCH_ASSOC);

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
        $mpdf->SetTitle($orgData[0]['org_name']."-".$results[0]['id']);

            if($results[0]['in_status']=="0"){
                $status="Unpaid";
            }elseif ($results[0]['in_status']=="1") {
              $status="Partially Paid";
            }elseif ($results[0]['in_status']=="2") {
               $status="Paid";
            }elseif ($results[0]['in_status']=="3") {
               $status="Canceled";
            }else{}

            $mpdf->showWatermarkText = true;
            $mpdf->SetWatermarkText($status);
            
            ob_start();

            require ROOT_PATH.'pdfmaker/invoice.php';

            $html = ob_get_contents();

            ob_end_clean();
            $mpdf->WriteHTML('<watermarktext content="'.$status.'"/>');
            $mpdf->WriteHTML($html);

           if (isset($do) AND ($do == 'download')) 
           {
			   $mpdf->Output("invoice_".$results[0]['i_id'].'.pdf', 'D'); //download
		   } 
           elseif(isset($do) AND ($do == 'view')) 
           {
               $mpdf->Output("invoice_".$results[0]['i_id'].'.pdf', 'I'); //view
		   }
           else
           {
                $mpdf->Output(ROOT_PATH."temp/".$_SESSION['org_id']."/invoice_".$results[0]['i_id'].'.pdf', 'F'); //save
           }

?>