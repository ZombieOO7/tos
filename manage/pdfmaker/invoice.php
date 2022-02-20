<html>
<head>
     <style>
        * { margin: 0; padding: 0; }
        body 
        {
            font: 12px  dejavusanscondensed;
        }

        #page-wrap { width: 800px; margin: 0 auto; }

        table { border-collapse: collapse; }
        table td, table th { border: 1px solid black; padding: 3px 5px; }
        #customer { overflow: hidden; }
        #logo { text-align: right; float: right; position: relative; margin-top: 5px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }
        #meta { margin-top: 1px; width: 100%; float: right; }
        #meta td { text-align: right;}
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
        #items td.total-value { border-left: 0; padding: 3px 5px; }
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
                    <td rowspan="7" style="border: 1px solid white; border-right: 1px solid black; text-align: left" width="62%"> 
                        <strong>To : </strong><br>
                        <strong>Attn </strong> <?=$results[0]['cp_name'];?> <br>
                        <?=$results[0]['com_name'];?> <br>
                        <?=$results[0]['com_address']?> <br>
                        <?=$results[0]['state_name']?>, <?=$results[0]['countries_name']?>, <?=$results[0]['com_pin']?> <br>
                        <?=$results[0]['cp_pphone'];?><br>
                        <?=$results[0]['cp_pemail'];?><br><br>

                        <?php if(isset($results[0]['com_gstno']) && !empty($results[0]['com_gstno'])){ if(strlen($results[0]['com_gstno'])>2){ ?>
                            <strong>GSTIN : </strong><?=$results[0]['com_gstno'];?> <br>
                        <?php }} ?>
                         
                    </td>
                    <td class="meta-head">Invoice #</td>
                    <td><?=$results[0]['i_id'];?></td>
                </tr>
                <tr>
                    <td class="meta-head"><?php echo 'Status'; ?></td>
                    <td>
                        <?php
                        if($results[0]['in_status']=="0"){
                         echo  $status="Unpaid";
                        }elseif ($results[0]['in_status']=="1") {
                         echo $status="Partially Paid";
                        }elseif ($results[0]['in_status']=="2") {
                         echo $status="Paid";
                        }elseif ($results[0]['in_status']=="3") {
                         echo  $status="Canceled";
                        }else{}
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Date Created</td>
                    <td><?=date('d-m-Y',strtotime($results[0]['in_date'])); ?></td>
                </tr>
                <tr>

                    <td class="meta-head">Due Date</td>
                    <td><?=date('d-m-Y',strtotime($results[0]['in_expdate'])); ?></td>
                </tr>
                 <tr>
            </tr>
            <tr>
                <td class="meta-head">Grand Total</td>
                <td>
                    <div class="due">
                         <?=str_replace('Rs', '₹', $formatter->formatCurrency($results[0]['in_grandtotal'], 'INR'));?>
                    </div>
                 </td>
            </tr>
        </table>
        </div>

        <?php if($results[0]['in_discussion']!== ''){ ?>
            <hr>
            <div>
                <?php echo $results[0]['in_discussion']; ?>
            </div>
            <hr>
        <?php } ?>

        <table id="items">
            <tr>
                <th width="10%">Item #</th>
                <th width="50%">Item</th>
            <!-- <th align="right">Price</th>
                <th align="right">Qty</th> -->
                <th align="right">SAC #</th>
                <th align="right">Total</th>
            </tr>




            <?php
            $sr=0;
            foreach ($items as $item){$sr++;
                echo'<tr class="item-row">
                <td>'.$sr.'</td>
                <td class="description">'.$item['i_name'].'</td>
                <td align="right">'.$item['i_sac'].'</td>
                <td align="right"><span class="price">'.str_replace( 'Rs', '₹', $formatter->formatCurrency($item['i_total'], 'INR')).'</span></td>
                </tr>';
            }

            ?>

            <tr><td class="blank" colspan="4"></td></tr>
            <tr>
                <td class="blank"> </td>
                <td class="blank"> </td>
                <td>Sub Total</td>
                <td><div id="subtotal"><?php echo str_replace( 'Rs', '₹', $formatter->formatCurrency($results[0]['in_subtotal'], 'INR')); ?></div></td>
            </tr>
            <?php
            if(($results[0]['in_discountamt']) !=='0'){ ?>
                <tr>
                    <td class="blank"> </td>
                    <td class="blank"> </td>
                    <td>Discount <?=strpos($results[0]['in_disctype'], '%') ? "(".$results[0]['in_disctype'].")":'' ;?></td>
                    <td><div id="subtotal"><?php echo str_replace( 'Rs', '₹', $formatter->formatCurrency($results[0]['in_discountamt'], 'INR')); ?></div></td>
                </tr>
                <?php
            }
            ?>

            <?php $gst_states=json_decode($results[0]['in_states']); if($gst_states[0]!==$gst_states[1]) { ?>
                <tr>
                    <td class="blank"> </td>
                    <td class="blank"> </td>
                    <td>IGST (<?=$results[0]['in_taxrate'];?>)</td>
                    <td><div id="total">
                        <?=str_replace( 'Rs', '₹', $formatter->formatCurrency($results[0]['in_igst'], 'INR') );?></div>
                    </td>
                </tr>
            <?php } else{ if($results[0]['in_taxrate']!=="0%"){ 
                $csgst_p=str_replace("%", "", $results[0]['in_taxrate']);
            ?>
                <tr>
                    <td class="blank"> </td>
                    <td class="blank"> </td>
                    <td>CGST (<?=($csgst_p/2)."%";?>)</td>
                    <td><div id="total">
                        <?=str_replace( 'Rs', '₹', $formatter->formatCurrency($results[0]['in_cgst'], 'INR') );?></div>
                    </td>
                </tr>
                <tr>
                    <td class="blank"> </td>
                    <td class="blank"> </td>
                    <td>SGST (<?=($csgst_p/2)."%";?>)</td>
                    <td><div id="total">
                        <?=str_replace( 'Rs', '₹', $formatter->formatCurrency($results[0]['in_sgst'], 'INR') );?></div>
                    </td>
                </tr>
            <?php }} ?>
            <?php if($tds_amt!=="0"){?>
                <tr>
                    <td class="blank"> </td>
                    <td class="blank"> </td>
                    <td>TDS (<?=$tds_perc;?>)</td>
                    <td><div class="due"><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($tds_amt, 'INR') ); ?></div></td>
                </tr>
            <?php } ?>
            <tr>
                <td class="blank"> </td>
                <td class="blank"> </td>
                <td class="total-line balance">Grand Total</td>
                <td class="total-value balance"><div class="due"><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($results[0]['in_grandtotal'], 'INR') ); ?></div></td>
            </tr>
            <?php if(!empty($paid_amount)){ ?>
            <tr>
                <td class="blank"> </td>
                <td class="blank"> </td>
                <td class="total-line balance">Amount Paid</td>
                <td class="total-value balance"><div class="due"><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($paid_amount, 'INR') ); ?></div></td>
            </tr>
            <?php } ?>
            <?php if(($results[0]['in_grandtotal']-($paid_amount+$tds_amt))!==0){ ?>
            <tr>
                <td class="blank"> </td>
                <td class="blank"> </td>
                <td class="total-line balance">Amount Due</td>
                <td class="total-value balance"><div class="due"><?=str_replace( 'Rs', '₹', $formatter->formatCurrency($results[0]['in_grandtotal']-($paid_amount+$tds_amt), 'INR') ); ?></div></td>
            </tr>
            <?php } ?>
            <tr><td class="blank" colspan="4"></td></tr>
            
        </table>
        <table id="items">
            <tr>
                <td class="balance" style="text-align: center; text-transform: uppercase">
                    <?php
                    $number = $results[0]['in_grandtotal'];
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
<br>
    <table width="100%">
        <tbody>
            <tr>
                <td> 
                    <?php
                        if($results[0]['in_notes'] !== '')
                        {
                            echo $results[0]['in_notes'];  
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>