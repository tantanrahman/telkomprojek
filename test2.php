<?php

$start_date = "01-11-2016"; 
$start_day = date('z', strtotime($start_date)); 
$days_in_a_year = date('z', strtotime("30-11-2016")); 

$number_of_days = ($days_in_a_year - $start_day) +1 ; 
for ($i = 0; $i < $number_of_days; $i++) {
    $date = strtotime(date("d-m-Y", strtotime($start_date)) . " +$i day");
    $tampiltanggal = date("d-m-Y",$date);
    

$tanggal1 = $tampiltanggal;
$date = explode("-", $tanggal1);
$arr = array("$date[2]","$date[1]","$date[0]");
$tampil_dates = $tampil_dates2 = implode("-", $arr);



}

?>