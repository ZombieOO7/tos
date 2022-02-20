<?php 

    if(!isset($_SESSION)) { session_start(); } 
    include_once '../config/master.inc.php';
    require_once ROOT_PATH.'pdfmaker/mpdf/autoload.php';
    include ROOT_PATH."config/connection.php"; 
    $formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

    if(isset($_POST['po_id']) && !empty($_POST['po_id'])){extract($_POST);}else{extract($_GET);}
        
    $sql="SELECT *,p.id,p.po_status,co.countries_name,s.state_name FROM purchase_orders p 
            LEFT JOIN customers c ON p.po_custid=c.id
            LEFT JOIN countries co ON co.countries_id=c.com_country
            LEFT JOIN states s ON s.id=c.com_state
            LEFT JOIN users u ON p.created_by=u.id WHERE p.id='$po_id';";
    $query_db = $conn->query($sql);
    $results=$query_db->fetchAll(PDO::FETCH_ASSOC); 

    $sqlqi="SELECT * FROM po_items WHERE po_id='$po_id';";
    $qi = $conn->query($sqlqi);
    $items=$qi->fetchAll(PDO::FETCH_ASSOC); 

    $sqlo="SELECT *,o.id,c.countries_name,s.state_name FROM organization o 
            LEFT JOIN countries c ON o.org_country=c.countries_id 
            LEFT JOIN states s ON o.org_state=s.id 
            WHERE o.id='".$_SESSION['org_id']."';";
    $queryo = $conn->query($sqlo);
    $orgData=$queryo->fetchAll(PDO::FETCH_ASSOC);   

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

            if($results[0]['po_status']=="0")
            {
                $status="Draft";
            }
            elseif ($results[0]['po_status']=="1") 
            {
                $status="Approved";
            }
            else{}

            $mpdf->SetWatermarkText($status);
            $mpdf->showWatermarkText = true;
            ob_start();

            require ROOT_PATH.'pdfmaker/purchase_order.php';

            $html = ob_get_contents();

            ob_end_clean();
            $mpdf->WriteHTML($html);

            if (isset($do) AND ($do == 'download'))
            {
			     $mpdf->Output("po_".$results[0]['id'].'.pdf', 'D'); //download
            } 
            elseif(isset($do) AND ($do == 'view')) 
            {
                $mpdf->Output("po_".$results[0]['id'].'.pdf', 'I'); //view
            }
            else
            {
                $mpdf->Output(ROOT_PATH."temp/".$_SESSION['org_id']."/po_".$results[0]['id'].'.pdf', 'F'); //save
            }

?>