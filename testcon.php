<?php
echo "connect<br>";
mysql_connect("180.183.246.189:8306","root","888ehong") or die(mysql_error());
echo "select db<br>";
mysql_select_db("repair");  
echo "set utf8<br>";
mysql_query("set names utf8");
echo "select count<br>";
$objrp=mysql_query("select count(*) as branch from branch group by br_id");
$rsrp=mysql_fetch_assoc($objrp);
mysql_close();
echo $rsrp['branch'];
?>
