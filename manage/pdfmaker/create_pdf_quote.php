<?php if(!isset($_SESSION['user_id'])) { session_start(); }

    include_once '../config/master.inc.php';
    require_once ROOT_PATH.'pdfmaker/mpdf/autoload.php';
    include ROOT_PATH."config/connection.php"; 
    $formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

    if(isset($_POST['qt_id']) && !empty($_POST['qt_id'])){extract($_POST);}else{extract($_GET);}
        
    $sql="SELECT *,q.id,q.qt_status,co.countries_name,s.state_name FROM quotations q
        LEFT JOIN customers c ON q.qt_custid=c.id 
        LEFT JOIN $rootdb.countries co ON co.countries_id=c.com_country
        LEFT JOIN $rootdb.states s ON s.id=c.com_state
        LEFT JOIN users u ON q.created_by=u.id WHERE q.id='$qt_id';";
    $query_db = $conn->query($sql);
    $results=$query_db->fetchAll(PDO::FETCH_ASSOC); 

    $sqlqi="SELECT * FROM quotation_items WHERE qt_id='$qt_id';";
    $qi = $conn->query($sqlqi);
    $items=$qi->fetchAll(PDO::FETCH_ASSOC); 

    $sqlo="SELECT *,o.id,c.countries_name,s.state_name FROM organization o LEFT JOIN $rootdb.countries c ON o.org_country=c.countries_id LEFT JOIN $rootdb.states s ON o.org_state=s.id WHERE o.id='".$_SESSION['org_id']."';";
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
    $mpdf->SetTitle($orgData[0]['org_name']."-".$results[0]['q_id']);

            if($results[0]['qt_status']=="0"){
                $status="Draft";
            }elseif ($results[0]['qt_status']=="1") {
              $status="Delivered";
            }elseif ($results[0]['qt_status']=="2") {
               $status="Approved";
            }elseif ($results[0]['qt_status']=="3") {
               $status="Disapproved";
            }elseif ($results[0]['qt_status']=="4") {
               $status="Accepted";
            }else{}

            $mpdf->showWatermarkText = false;
            $mpdf->SetWatermarkText($status);

            ob_start();

            require ROOT_PATH.'pdfmaker/quote.php';

            $html = ob_get_contents();

            ob_end_clean();
            $mpdf->WriteHTML('<watermarktext content="'.$status.'"/>');
            $mpdf->WriteHTML($html);

            if (isset($do) AND ($do == 'download'))
            {
			   $mpdf->Output("quote_".$results[0]['q_id'].'.pdf', 'D'); //download
            } 
            elseif(isset($do) AND ($do == 'view')) 
            {
               $mpdf->Output("quote_".$results[0]['q_id'].'.pdf', 'I'); //view
            }
            else
            {
                $mpdf->Output(ROOT_PATH."temp/".$_SESSION['org_id']."/quote_".$results[0]['q_id'].'.pdf', 'F'); //save
            }

?>