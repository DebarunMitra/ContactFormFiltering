<?php
$handle_data= fopen("contact_data.csv","r");
$handle_word= fopen("word_check.csv","r");
$wrow= count(file("word_check.csv"));
$crow= count(file("contact_data.csv"));
$file = "filter_data.csv";
if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
 // echo ("Deleted $file");
  }
$file_open= fopen("filter_data.csv","w+");
$count=0;
$color=array("red","green","yellow","blue","gray","cyan","violet");
if($handle_data!==FALSE && $handle_word!==FALSE)
{
    $data= fgetcsv($handle_data,0);
    $word= fgetcsv($handle_word,0);
    $arrayData[0]=$data;
    $arrayWord[0]=$word;
   // print_r($data);
   // print_r($word);
    while($data!==FALSE)
    {
        $data= fgetcsv($handle_data);
        /*echo '<div>';
        print_r($data);
        echo '</div>';*/
        $arrayData[]=$data;
    }
    while($word!==FALSE)
    {
        $word= fgetcsv($handle_word);
        $arrayWord[]=$word;
    }
}
/*for($i=0;$i<13;$i++)
{
    echo '<div>';
        print_r($arrayData[$i]); echo '<br>';
        print_r($arrayWord[$i]); echo '<br>';
    echo '</div>';
}*/
for($i=0;$i<$wrow;$i++)
{
   /* echo '<div>';
        print_r($arrayWord[$i]);echo '+-----------+<br>';
        echo '</div>';*/
    for($j=0;$j<$crow;$j++)
    {   /* echo '<div>';
        print_r($arrayData[$j]);echo '++++++++++<br>';
        echo '</div>';*/
        if(strstr($arrayData[$j][4], $arrayWord[$i][1])!==FALSE || strstr($arrayData[$j][4], $arrayWord[$i][2])!==FALSE)
        {
            if(strstr($arrayData[$j][4], $arrayWord[$i][2])!==FALSE && strstr($arrayData[$j][4], $arrayWord[$i][1])!==FALSE)
            {
                $count++;
             //   echo '~~~~~~'+($count)+'~~~~~';
            }
            $count++;
            //echo '~~~~~~'+($count)+'~~~~~';
        }
    }
   /* echo '---------------------------------------------------------------';
    echo '<div>';
    print_r($arrayWord[$i][1]);
    print_r($count);
    echo '</div>';
    echo '*****************************************************************';*/
    $no_rows= count(file("filter_data.csv"));
    if($no_rows>1)
    {
	$no_rows=($no_rows - 1) + 1;
    }
    $form_data=array(
	'sl_no' => $no_rows,
	'word'=>$arrayWord[$i][1],
	'count'=>$count
		 );
    fputcsv($file_open, $form_data);
    $count=0;
    /*echo '<div>';
    print_r($arrayData[$i][0]);
    echo '</div>';
     */
}
$handle_result= fopen("filter_data.csv","r");
if($handle_result!==FALSE)
{
    $n=1;
        $result= fgetcsv($handle_result,0);
        $arrayResult[0]=$result;
        while($result!==FALSE)
    {
        $result= fgetcsv($handle_result);
        $arrayResult[]=$result;
       /*
        for($i=0;$i<13;$i++)
        {
         echo '<div>';
        print_r($arrayResult[$n-1]);
        echo '</div>';
        $n++;
        }
                */
    }
}
 else {
    echo 'false';
}
for($i=1;$i<$wrow;$i++)
{
    for($j=$i;$j<$wrow;$j++)
    {
        if($arrayResult[$i-1][2]<=$arrayResult[$j][2])
        {
            $min=$arrayResult[$i-1][2];
            $val=$arrayResult[$i-1][1];
            $arrayResult[$i-1][2]=$arrayResult[$j][2];
            $arrayResult[$i-1][1]=$arrayResult[$j][1];
            $arrayResult[$j][2]=$min;
            $arrayResult[$j][1]=$val;
        }
    }
}

        /*echo '<div>';
        print_r($arrayResult[$i][1]);  echo '<br>';
        print_r($arrayResult[$i][2]);  echo '<br>';
        echo '</div>';  
        echo '***************';*/
fclose($file_open);
?>
<html>
    <head>
        <title>CSV data filtering</title>
    </head>
    <body>
    <center>
        <?php
        $size=300;
        $n=0;
        for($i=0;$i<$wrow;$i++)
        {
        ?>
        <p style="font-size:<?=$size?>%; color:<?=$color[$n]?>;"><?=$arrayResult[$i][1]?> ===> <?=$arrayResult[$i][2]?></p>
        <?php
        $size=$size-12;
        $n++;
        if($n>=6)
        {
            $n=0;
        }
        }
        ?>
    </center>
    </body>
</html>

