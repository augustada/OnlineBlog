<?php 
include "baglan.php";
session_start();
ob_start();

if (isset($_POST['signup'])) {

    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if (empty($email) || empty($password) || empty($username)) {
            echo "<script type='text/javascript'>alert('Lütfen Formu Eksiksiz Doldurun!');</script>";
            Header("Refresh: 0.1; url=registration.php");
        } else {
            $username = $_POST['username'];
            $sorgu = $baglan->prepare('SELECT user_id FROM kullanici WHERE username = ?');
            $sonuc = array($username);
            $sorgu->execute($sonuc);
            if ($sorgu->rowCount()) {
                echo ("<script type='text/javascript'>alert('Zaten kayitli bir kullanıcı adı girdiniz!');</script>");
                header("Refresh: 0.1; url=registration.php");
            } else {
                $sorgu = $baglan->prepare("INSERT INTO kullanici(username, password, email) VALUES(:username, :password, :email)");
                $sonuc = $sorgu->execute(array(
                    'username' =>  $_POST['username'],
                    'password' => $_POST['password'],
                    'email' => $_POST['email']
                ));
       
            if ($sonuc) {

                echo "<script type='text/javascript'>alert('Kayıt Başarılı!');</script>";
                Header("Refresh: 0.1; url=registration.php");
            } else {

                echo "<script type='text/javascript'>alert('Hata Oluştu!');</script>";
                Header("Refresh: 0.1; url=registration.php");
            }
        }
    }
}

    
if (isset($_POST['login'])) {

    
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
    $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
    $sorgula = $baglan->prepare('SELECT * FROM kullanici where password=:password and email=:email ');
    $sorgula->execute(array(
        'password' => $password,
        'email' => $email
    ));

    $islem_ok = $sorgula->rowCount();
    $kisi = $sorgula->fetch();
    if ($islem_ok <= 0) {
        echo "<script type='text/javascript'>alert('Bu isimde bir kullanıcı bulunmamaktadır!');</script>";
        Header("Refresh: 0.1; url=login.php");
    }
    if ($islem_ok == 1) {

        $_SESSION['username'] = $kisi['username'];
        $_SESSION['user_id'] = $kisi["user_id"];
        header("location:blog-post.php");
    }else {
        echo "<script type='text/javascript'>alert('Please try again!');</script>";
        Header("Refresh: 0.1; url=login.php");
    }
}

if (isset($_POST['konu_giris'])) {

    if (empty($_POST['konu_ad'])) {
        echo "<script type='text/javascript'>alert('Lütfen Formu Eksiksiz Doldurun!');</script>";
        Header("Refresh: 0.1; url=contact-us.php");
    }  else {
            $sorgu = $baglan->prepare("INSERT INTO konu(konu_ad) VALUES(:konu_ad)");
            $sonuc = $sorgu->execute(array(
                'konu_ad' => $_POST['konu_ad']
            ));

            if ($sonuc) {

                echo "<script type='text/javascript'>alert('Kayıt Başarılı!');</script>";
                Header("Refresh: 0.1; url=contact-us.php");
            } else {

                echo "<script type='text/javascript'>alert('Hata Oluştu!');</script>";
                Header("Refresh: 0.1; url=contact-us.php");
            }
        }
    }

if (isset($_POST['yorum_send'])) {
    $dizin = "C:\\xampp\\htdocs\\2\\assets\\img\\scenery\\" ;
    $yuklenenresim = $dizin.$_FILES["resim"]["name"];
    move_uploaded_file($_FILES["resim"]["tmp_name"], $yuklenenresim);
    $eklenenresim=$_FILES["resim"]["name"];
    //$resimExt=strtolower(pathinfo($yuklenenresim,PATHINFO_EXTENSION));
    //$son_resim=rand(1000,1000000).".".$resimExt;
    $sorgu = $baglan->prepare("INSERT INTO icerik(username,konu_id,icerik,resim) VALUES(:username, :konu_id, :icerik, :resim)");
    $sonuc = $sorgu->execute(array(
        'username' => $_POST['username'],
        'konu_id' => $_POST['konu_ad'],
        'icerik' => $_POST['message'],
        'resim' => $eklenenresim
    ));

    if ($sonuc) {
        
        echo "<script type='text/javascript'>alert('Kayıt Başarılı!');</script>";
        Header("Refresh: 0.1; url=contact-us.php");
    } else {

        echo "<script type='text/javascript'>alert('Hata Oluştu!');</script>";
        Header("Refresh: 0.1; url=contact-us.php");
    }
}
        
if (isset($_POST['p_update'])& isset($_GET['user_id'])) {
 
  $sorgu=$baglan->prepare("UPDATE kullanici set username=:username , email=:email , password=:password where user_id=:user_id");
  $sonuc=$sorgu->execute(array(
    'user_id' => $_GET['user_id'],
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password'=> $_POST['password']
  ));
  $sonuc = $sorgu->rowCount();
  $kisi = $sorgu->fetch();
  if ($sonuc) {
    $_SESSION['username'] = $kisi['username'];
    echo "<script type='text/javascript'>alert('Kayıt Başarılı!');</script>";
    header("Refresh: 0.1; url=profile.php");    

  } else {
    echo "<script type='text/javascript'>alert('Try Again!');</script>"; 
    header("Refresh: 0.1; url=profile.php");   
  }
}
?>
<?php
if(isset($_POST['sil'])& isset($_GET['icerik_id']))
{
	$sorgu=$baglan->prepare('DELETE FROM icerik WHERE icerik_id=?');
	$sonuc=$sorgu->execute([$_GET['icerik_id']]);
	if($sonuc){
                echo " <script type='text/javascript'>
        alert('Veri basariyla silindi');
        </script>";
		header("refresh:0.1; url=blog-post-list.php"); 
	}
	else
    echo "<script type='text/javascript'>alert('Kayıt Silinemedi!');</script>"; 
    header("Refresh: 0.1; url=blog-post-list.php");   
}

?>

<?php

if(isset($_POST['duzenle'])& isset($_GET['icerik_id']))
{
    $dizin = "C:\\xampp\\htdocs\\2\\assets\\img\\scenery\\" ;
    $yuklenenresim = $dizin.$_FILES["resim"]["name"];
    move_uploaded_file($_FILES["resim"]["tmp_name"], $yuklenenresim);
    $eklenenresim=$_FILES["resim"]["name"];
	$sorgu=$baglan->prepare('UPDATE icerik set username=:username , konu_id=:konu_id , icerik=:icerik , resim=:resim where icerik_id=:icerik_id');
	$sonuc=$sorgu->execute(array(
        'icerik_id' => $_GET['icerik_id'],
        'username' => $_POST['username'],
        'konu_id' => $_POST['konu_ad'],
        'icerik' => $_POST['icerik'],
        'resim' => $eklenenresim
    ));
	if($sonuc){
                echo " <script type='text/javascript'>
        alert('Kayıt Başarılı!');
        </script>";
		header("refresh:0.1; url=blog-post-list.php"); 
	}
	else
    echo "<script type='text/javascript'>alert('Try Again!');</script>"; 
    header("Refresh: 0.1; url=blog-post-list.php");   
}

?>