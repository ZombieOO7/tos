<?php

function pagination($conn,$table,$per_page,$page,$url='?')
{
    $query="SELECT COUNT(*) as 'num' FROM $table WHERE publish='1';";
    $qrow= $conn->query($query);
    $row = $qrow->fetchAll(PDO::FETCH_ASSOC);
    $total = $row[0]['num'];

    $adjacents = "2";  
     
    $prevlabel = "&lsaquo;";
    $nextlabel = "&rsaquo;";
    $lastlabel = "&rsaquo;&rsaquo;";
    $firstlabel = "&lsaquo;&lsaquo;";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";

    if($lastpage > 1)
    {   
        $pagination .="<ul class='inline-flex flex-middle pagination-2  pagination-sm mt-10'>";

        if ($page==$lastpage)
        {
            $pagination.="<li><a href='{$url}page=1'>{$firstlabel}</a></li>";
        }

        if ($page > 1)
        {
            $pagination.="<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
        }
             
        if ($lastpage < 7 + ($adjacents * 2))
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                {
                    $pagination.="<li><a class='active'>{$counter}</a></li>";
                }
                else
                {
                    $pagination.="<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
            }
         
        } 
        elseif($lastpage > 5 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2)) 
            {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                    {
                        $pagination.="<li><a class='active'>{$counter}</a></li>";
                    }
                    else
                    {
                        $pagination.="<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                    }
                }

                $pagination.="<li>...</li>";
                $pagination.="<li><a href='{$url}page={$lpm1}'><span>{$lpm1}</span</a></li>";
                $pagination.="<li><a href='{$url}page={$lastpage}'><span>{$lastpage}</span></a></li>";  
                     
            }
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) 
            {
                 
                $pagination.="<li><a href='{$url}page=1'>1</a></li>";
                $pagination.="<li><a href='{$url}page=2'>2</a></li>";
                $pagination.="<li>...</li>";

                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) 
                {
                    if ($counter == $page)
                    {
                        $pagination.="<li><a class='active'>{$counter}</a></li>";
                    }
                    else
                    {
                        $pagination.="<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                    }
                }

                $pagination.="<li>..</li>";
                $pagination.="<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.="<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
                 
            } 
            else 
            {
                 
                $pagination.="<li><a href='{$url}page=1'>1</a></li>";
                $pagination.="<li><a href='{$url}page=2'>2</a></li>";
                $pagination.="<li>..</li>";

                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) 
                {
                    if ($counter == $page)
                    {
                        $pagination.="<li><a class='active'>{$counter}</a></li>";
                    }
                    else
                    {
                        $pagination.="<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                    }
                }
            }
        }
         
        if ($page < $counter - 1) 
        {
            $pagination.="<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
            $pagination.="<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
        }
         
        $pagination.= "</ul>\n";        
    }
     
    return $pagination;
}

function news_pagination($conn,$table,$catid,$per_page,$page,$url='?',$n_cat)
{
    $query="SELECT COUNT(*) as 'num' FROM $table WHERE publish='1' AND $catid='$n_cat';";
    $qrow= $conn->query($query);
    $row = $qrow->fetchAll(PDO::FETCH_ASSOC);
    $total = $row[0]['num'];

    $adjacents = "2";  
     
    $prevlabel = "&lsaquo;";
    $nextlabel = "&rsaquo;";
    $lastlabel = "&rsaquo;&rsaquo;";
    $firstlabel = "&lsaquo;&lsaquo;";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";

    if($lastpage > 1)
    {   
        $pagination .="<ul class='inline-flex flex-middle pagination-2  pagination-sm mt-10'>";

        if ($page==$lastpage)
        {
            $pagination.="<li><a href='{$url}&page=1'>{$firstlabel}</a></li>";
        }

        if ($page > 1)
        {
            $pagination.="<li><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";
        }
             
        if ($lastpage < 7 + ($adjacents * 2))
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                {
                    $pagination.="<li><a class='active'>{$counter}</a></li>";
                }
                else
                {
                    $pagination.="<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
                }
            }
         
        } 
        elseif($lastpage > 5 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2)) 
            {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                    {
                        $pagination.="<li><a class='active'>{$counter}</a></li>";
                    }
                    else
                    {
                        $pagination.="<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
                    }
                }

                $pagination.="<li>...</li>";
                $pagination.="<li><a href='{$url}&page={$lpm1}'><span>{$lpm1}</span</a></li>";
                $pagination.="<li><a href='{$url}&page={$lastpage}'><span>{$lastpage}</span></a></li>";  
                     
            }
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) 
            {
                 
                $pagination.="<li><a href='{$url}&page=1'>1</a></li>";
                $pagination.="<li><a href='{$url}&page=2'>2</a></li>";
                $pagination.="<li>...</li>";

                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) 
                {
                    if ($counter == $page)
                    {
                        $pagination.="<li><a class='active'>{$counter}</a></li>";
                    }
                    else
                    {
                        $pagination.="<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
                    }
                }

                $pagination.="<li>..</li>";
                $pagination.="<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.="<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";      
                 
            } 
            else 
            {
                 
                $pagination.="<li><a href='{$url}&page=1'>1</a></li>";
                $pagination.="<li><a href='{$url}&page=2'>2</a></li>";
                $pagination.="<li>..</li>";

                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) 
                {
                    if ($counter == $page)
                    {
                        $pagination.="<li><a class='active'>{$counter}</a></li>";
                    }
                    else
                    {
                        $pagination.="<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
                    }
                }
            }
        }
         
        if ($page < $counter - 1) 
        {
            $pagination.="<li><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";
            $pagination.="<li><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
        }
         
        $pagination.= "</ul>\n";        
    }
     
    return $pagination;
}

?>