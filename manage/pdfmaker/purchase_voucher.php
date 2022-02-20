
<html>

<head>

   <style>

        * { margin: 0; padding: 0; }
        body {
            font: 12px/1.4  dejavusanscondensed;
        }
        #page-wrap { width: 800px; margin: 0 auto; }

        table { border-collapse: collapse; }
        table td, table th { border: 1px solid black; padding: 5px; }


        #customer { overflow: hidden; }

        #logo { text-align: right; float: right; position: relative; margin-top: 5px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }

        #meta { margin-top: 1px; width: 100%; float: right; }
        #meta td { text-align: left;  }
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
        hr{ margin: 5px 0 15px 0; }
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
    <div id="customer">
        <table id="meta">
         <tr>
            <td class="meta-head">Voucher #</td>
            <td><?=$results[0]['id']; ?></td>
        </tr>
        <tr>
            <td class="meta-head">Purchase Date</td>
            <td><?=date('d-m-Y',strtotime($results[0]['txn_date'])); ?></td>
        </tr>
        <tr>
            <td class="meta-head">Vendor Name</td>
            <td>
                <?php 
                    if(!empty($results[0]['com_name']))
                    {
                        echo $results[0]['cp_name']." (".$results[0]['com_name'].")";
                    }
                    else
                    {
                        echo $results[0]['cp_name'];
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td class="meta-head">Expense Category</td>
            <td><?=$results[0]['expcat'];?></td>
        </tr>
        <tr>
            <td class="meta-head">Remark</td>
            <td><?=$results[0]['remark'];?></td>
        </tr>
        </table>
        <br>
        <table id="meta">
        <tr>
            <td class="meta-head">Payment Type</td>
            <td><?=$results[0]['pmethod'];?></td>
        </tr>
        <tr>
            <td class="meta-head">Account</td>
            <td><?=$results[0]['ba_name'];?></td>
        </tr>
        <tr>
            <td class="meta-head">Amount</td>
            <td>
                <?=str_replace('Rs', '₹', $formatter->formatCurrency($results[0]['pv_amount'], 'INR'));?>
            </td>
        </tr>
        <tr>
            <td class="meta-head">GST Rate</td>
             <td>
                <?=$results[0]['pv_gst'];?>
            </td>
        </tr>
        <tr>
            <td class="meta-head">GST Amount</td>
             <td>
                <?=$results[0]['cgst']+$results[0]['sgst']+$results[0]['igst'];?>
            </td>
        </tr>
         <tr>
            <td class="meta-head">Total Amount</td>
             <td>
                <?=str_replace('Rs', '₹', $formatter->formatCurrency($results[0]['txn_amount'], 'INR'));?>
            </td>
        </tr>
        </table>
    </div>
    <table id="items">
            <tr>
                <td class="balance" style="text-align: center; text-transform: uppercase">
                    <?php
                        $number = $results[0]['txn_amount'];
                           $no = round($number);
                           $point = round($number - $no, 2) * 100;
                           $hundred = null;
                           $digits_1 = strlen($no);
                           $i = 0;
                           $str = array();
                           $words = array('0' => '', '1' => 'one', '2' => 'two',
                            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                            '7' => 'seven', '8' => 'eight', '9' => 'nine',
                            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                            '13' => 'thirteen', '14' => 'fourteen',
                            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                            '60' => 'sixty', '70' => 'seventy',
                            '80' => 'eighty', '90' => 'ninety');
                           $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                           while ($i < $digits_1) {
                             $divider = ($i == 2) ? 10 : 100;
                             $number = floor($no % $divider);
                             $no = floor($no / $divider);
                             $i += ($divider == 10) ? 1 : 2;
                             if ($number) {
                                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                $str [] = ($number < 21) ? $words[$number] .
                                    " " . $digits[$counter] . $plural . " " . $hundred
                                    :
                                    $words[floor($number / 10) * 10]
                                    . " " . $words[$number % 10] . " "
                                    . $digits[$counter] . $plural . " " . $hundred;
                             } else $str[] = null;
                          }
                          $str = array_reverse($str);
                          $result = implode('', $str);
                          $points = ($point) ?
                            "." . $words[$point / 10] . " " . 
                                  $words[$point = $point % 10] : '';
                          $newresult = ucwords($result);
                        	echo $newresult . "Rupees Only";
                         ?> 
                </td>
            </tr>
    </table>
</div>
</body>
</html>