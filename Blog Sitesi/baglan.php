<?php 
$db_servername="localhost";
$db_username="root";
$db_password="";
$db_name="blog";

try{
$baglan=new PDO("mysql:host=$db_servername;dbname=$db_name",$db_username,$db_password);
$baglan ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   echo"";
}
catch(PDOException $e){
echo"Hata Olustu:".$e->getMessage();
}

?>