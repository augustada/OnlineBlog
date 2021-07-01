<?php
include "baglan.php";
session_start();
ob_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog - BLOG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    
</head>

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
<body>
        
    <main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Blog Post List</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
                    
                </div>
                
                <div class="text-center">
                <form action="" method="post">
                
                <button class="btn btn-outline-secondary btn-sm" name="yukari" type="submit">UP<i class="fa fa-arrow-up"></i></button>
                <button class="btn btn-outline-secondary btn-sm" name="asagi" type="submit">DOWN<i class="fa fa-arrow-down"></i></button>
                <button class="btn btn-outline-secondary btn-sm" name="messages" type="submit">Messages<i class="fa fa-arrow-down"></i></button>
                </form>
                </div>
                <br>
                <div class="block-content">
                    <?php
                    include "baglan.php";
                    $user_id=$_SESSION['user_id'];
                    if(isset($_POST['yukari'])){
                    $sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id order by icerik_id desc ");
                    $sorgu->execute();
                    while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                        
                    ?>
                        <div class="clean-blog-post">
                            <div class="row">
                                <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/scenery/<?php echo $sonuc['resim']; ?>"></div>
                                <div class="col-lg-7">
                                    <h3><?php echo $sonuc['konu_ad']; ?> 
                                    <div id="rating_div">
			
                                </h3>
                                
                                    <div class="info"><span class="text-muted"><?php echo $sonuc['created_at']; ?> by&nbsp;<a href="#"><?php echo $sonuc['username']; ?></a></span></div>
                                    <p><?php  echo substr($sonuc['icerik'], 0, 150); ?>...</p><a href="incele.php?icerik_id=<?php echo $sonuc['icerik_id'] ?>"><button class="btn btn-outline-primary btn-sm" id="read" type="button">Devamı</button></a>
                                </div>
                            </div>
                        </div>
                    <?php }}else if(isset($_POST['asagi'])){
$sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id order by icerik_id asc");
$sorgu->execute();
while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                    
                    
                    ?>
                    <div class="clean-blog-post">
                            <div class="row">
                                <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/scenery/<?php echo $sonuc['resim']; ?>"></div>
                                <div class="col-lg-7">
                                
                                    <h3><?php echo $sonuc['konu_ad']; ?></h3>
                                    <div class="info"><span class="text-muted"><?php echo $sonuc['created_at']; ?> by&nbsp;<a href="#"><?php echo $sonuc['username']; ?></a></span></div>
                                    <p><?php  echo substr($sonuc['icerik'], 0, 150); ?>...</p><a href="incele.php?icerik_id=<?php echo $sonuc['icerik_id'] ?>"><button class="btn btn-outline-primary btn-sm" id="read" type="button">Devamı</button></a>
                                </div>
                            </div>
                        </div>
                        <?php }}else if(isset($_POST['messages'])){
                            $sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id where username=? order by icerik_id desc");
                            $sorgu->execute(array($username));
                            while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="clean-blog-post">
                            <div class="row">
                                
                                <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/scenery/<?php echo $sonuc['resim']; ?>"></div>
                                <div class="col-lg-7">
                                    <h3><?php echo $sonuc['konu_ad']; ?></h3>
                                    <div class="info"><span class="text-muted"><?php echo $sonuc['created_at']; ?> by&nbsp;<a href="#"><?php echo $sonuc['username']; ?></a></span></div>
                                    <p><?php  echo substr($sonuc['icerik'], 0, 150); ?>...</p><a href="incele.php?icerik_id=<?php echo $sonuc['icerik_id'] ?>"><button class="btn btn-outline-primary btn-sm" id="read" type="button">Devamı</button></a>
                                </div>
                            </div>
                        </div>
                        <?php }}else{
                            $sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id order by icerik_id desc");
                            $sorgu->execute();
                            while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                             
                            ?>
                            <div class="clean-blog-post">
                            <div class="row">
                                <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/scenery/<?php echo $sonuc['resim']; ?>"></div>
                                <div class="col-lg-7">
                                    <h3><?php echo $sonuc['konu_ad']; ?></h3>
                                    <div class="info"><span class="text-muted"><?php echo $sonuc['created_at']; ?> by&nbsp;<a href="#"><?php echo $sonuc['username']; ?></a></span></div>
                                    <p><?php  echo substr($sonuc['icerik'], 0, 150); ?>...</p><a href="incele.php?icerik_id=<?php echo $sonuc['icerik_id'] ?>"><button class="btn btn-outline-primary btn-sm" id="read" type="button">Devamı</button></a>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                </div>
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