<?php
include "baglan.php";
session_start();
ob_start();
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Writing - BLOG</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#"><?php echo $username ?>' BLOG</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="blog-post.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog-post-list.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.php">Writing</a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Profile Page</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
                </div>
                <?php
                    include "baglan.php";
                    $user_id=$_SESSION['user_id'];
                    $sorgu = $baglan->prepare("SELECT * FROM kullanici where user_id=? ");
                    $sorgu->execute(array($user_id));

                    $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)
                    
                    ?>
                <form action="system.php?user_id=<?= $sonuc["user_id"] ?>" method="POST">
                    
                    <div class="mb-3"><label class="form-label" for="username">Name</label><input class="form-control" type="text" value="<?php echo $sonuc["username"]; ?>" id="username" name="username" readonly></div>
                    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" type="email" value="<?php echo $sonuc["email"]; ?>" id="email" name="email" required></div>
                    <div class="mb-3"><label class="form-label" for="message">Password</label><input class="form-control" type="password" value="<?php echo $sonuc["password"]; ?>" id="password" minlength="6" name="password" required></div>
                    <div class="mb-3"><a href="system.php?user_id=<?= $sonuc["user_id"] ?>"><button class="btn btn-primary" name="p_update" type="submit">Update</button></a></div>
                </form>
            </div>
        </section>
    </main>
    <footer class="page-footer dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Sign up</a></li>
                        <li><a href="#">Downloads</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="#">Company Information</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Reviews</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help desk</a></li>
                        <li><a href="#">Forums</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© 2021 Copyright Text</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
<?php
if (isset($_POST['p_update'])& isset($_GET['user_id'])) {
 
 $sorgu=$baglan->prepare("UPDATE kullanici set username=:username , email=:email , password=:password where user_id=:user_id");
 $sonuc=$sorgu->execute(array(
   'user_id' => $_GET['user_id'],
   'username' => $_POST['username'],
   'email' => $_POST['email'],
   'password'=> $_POST['password']
 ));
 if ($sonuc) {

   echo "<script type='text/javascript'>alert('Kayıt Başarılı!');</script>";
   header("location:profile.php");    

 } else {
   echo "<script type='text/javascript'>alert('Try Again!');</script>"; 
   header("location:profile.php");   
 }
}
?>