<?php
  //$img=$_GET['img'];
  //echo file_get_contents($img);
  //http://www.111cn.net/phper/php-cy/48682.htm
  //http://www.iippcc.com/ru-he-po-jie-tu-pian-fang-dao-lian.html
  //http://www.cnblogs.com/hooray/archive/2011/05/12/2044744.html
  
?>


 <?php
$p=$_GET['img'];
$pics=file($p);
for($i=0;$i< count($pics);$i++)
{
echo $pics[$i];
}
?>