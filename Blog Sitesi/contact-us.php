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
                    <h2 class="text-info">Writing</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
                </div>
                <div class="row">
                <div class="col">
                <form action="system.php" method="POST" enctype="multipart/form-data">
                    <?php
                    include "baglan.php";
                    $user_id=$_SESSION['user_id'];
                    $sorgu = $baglan->prepare("SELECT * FROM kullanici where user_id=?");
                    $sorgu->execute(array($user_id));

                    $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)
                    ?>
                    <div class="mb-3"><label class="form-label" for="username">Name</label><input class="form-control" type="text" value="<?php echo $sonuc['username']; ?>" id="username" name="username" readonly></div>
                    <div class="mb-3"><label class="form-label" for="subject">Subject</label>
                        <select name="konu_ad" class="form-control" required>
                            <?php
                            $sorgu = $baglan->prepare("SELECT * FROM konu");
                            $sorgu->execute();
                            while ($son = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $son['konu_id']; ?>"><?php echo $son['konu_ad']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" type="email" value="<?php echo $sonuc['email']; ?>" id="email" name="email" readonly></div>
                    <div class="mb-3"><label class="form-label" for="message">Message</label><textarea class="form-control" id="message" name="message" minlength="200"></textarea></div>
                    <div class="mb-3"><label class="form-label" for="file">File</label><input class="form-control" type="file" id="resim" name="resim" required></div>
                    <div class="mb-3"><button class="btn btn-primary" name="yorum_send" type="submit">Send</button></div>
                </form>
                </div>
                <div class="col">
                <form action="system.php" method="POST">
                <h4 class="text-info">Yeni Konu Girişi</h4>
                <br>
                    <div class="mb-3"><label class="form-label" for="konu_ad">Subject</label><input class="form-control" type="text" id="konu_ad" name="konu_ad" required></div>
                    <div class="mb-3"><button class="btn btn-primary" name="konu_giris" type="submit">Send</button></div>
                </form>
                </div>
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