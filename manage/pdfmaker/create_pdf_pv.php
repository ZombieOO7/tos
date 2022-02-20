<?php  if(!isset($_SESSION)) { session_start(); } 
 include_once '../config/master.inc.php';
 require_once ROOT_PATH.'pdfmaker/mpdf/autoload.php';
 include ROOT_PATH."config/connection.php"; 
 $formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

 if(isset($_POST['pv_id']) && !empty($_POST['pv_id'])){extract($_POST);}else{extract($_GET);}

    $sql="SELECT p.*,c.com_name,c.cp_name,CONCAT(sa.bank_name,' (',sa.acc_no,')') as ba_name,si.name as expcat,pm.name as pmethod FROM transactions p 
            LEFT JOIN customers c ON p.txn_custid=c.id
            LEFT JOIN sys_accounts sa ON sa.id=p.account
            LEFT JOIN sys_incategory si ON si.id=p.in_category 
            LEFT JOIN sys_pmethods pm ON pm.id=p.pay_method WHERE p.id='$pv_id' AND p.txn_type='3';";
    $qa= $conn->query($sql);
    $results=$qa->fetchAll(PDO::FETCH_ASSOC);

    $sqlo="SELECT *,o.id,c.countries_name,s.state_name FROM organization o LEFT JOIN $rootdb.countries c ON o.org_country=c.countries_id LEFT JOIN $rootdb.states s ON o.org_state=s.id WHERE o.id='".$_SESSION['org_id']."';";
    $queryo = $conn->query($sqlo);
    $orgData=$queryo->fetchAll(PDO::FETCH_ASSOC);

if(!empty($results))
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
    $mpdf->SetTitle("Purchase Voucher -".$pv_id);

    ob_start();

    require ROOT_PATH.'pdfmaker/purchase_voucher.php';

    $html = ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML($html);

    if (isset($do) AND ($do == 'download')) 
    {
	    $mpdf->Output("pv_".$results[0]['id'].'.pdf', 'D'); //download
    } 
    elseif(isset($do) AND ($do == 'view')) 
    {
        $mpdf->Output("pv_".$results[0]['id'].'.pdf', 'I'); //view
    }
    else
    {
        $path=ROOT_PATH."purchase_vouchers/".$_SESSION['org_id']."/";
        if (!file_exists($path))
        {
            mkdir($path,0777,true);  
        }
        
        $mpdf->Output($path."pv_".$results[0]['id'].'.pdf', 'F'); //save
    }
}

?>