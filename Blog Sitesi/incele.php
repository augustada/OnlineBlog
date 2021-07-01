<?php
include "baglan.php";
session_start();
ob_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id where icerik_id=?");
$sonuc = $sorgu->execute([$_GET['icerik_id']]);

while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['icerik_id'] = $_GET['icerik_id'];
}
$icerik_id = $_SESSION['icerik_id'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog - BLOG</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
    <main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Blog Post List</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
                </div>
                <div class="block-content">
                    <?php
                    include "baglan.php";
                    $username = $_SESSION['username'];


                    $sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id where icerik_id=?");
                    $sonuc = $sorgu->execute([$_GET['icerik_id']]);

                    $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
                    if ($username == $sonuc['username']) {

                    ?>
                        <div class="clean-blog-post">
                            <div class="row">
                                <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/scenery/<?php echo $sonuc['resim']; ?>"></div>
                                <div class="col-lg-7">
                                    <h3><?php echo $sonuc['konu_ad']; ?></h3>
                                    <div class="info"><span class="text-muted"><?php echo $sonuc['created_at']; ?> by&nbsp;<a href="#"><?php echo $sonuc['username']; ?></a></span></div>
                                    <p><?php echo $sonuc['icerik']; ?></p><a href="blog-post-list.php"><button class="btn btn-outline-primary btn-sm" id="back" type="button">Back</button></a>
                                    <hr>
                                    <button class="btn btn-outline-success btn-sm" type="button" data-toggle="modal" data-target="#duzenle<?= $sonuc['icerik_id'] ?>">Düzenle</button>
                                    <button class="btn btn-outline-danger btn-sm" type="button" data-toggle="modal" data-target="#sil<?= $sonuc['icerik_id'] ?>">Sil</button>
                                </div>
                            </div>
                        </div>
                    <?php } else {
                        $sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id where icerik_id=?");
                        $sonuc = $sorgu->execute([$_GET['icerik_id']]);
                        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)


                    ?>
                        <?php

                        $conn = new mysqli('localhost', 'root', '', 'blog');

                        if (isset($_POST['save'])) {
                            $uID = $conn->real_escape_string($_POST['uID']);
                            $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
                            $ratedIndex++;
                            $sorgula = $conn->query("SELECT rate_id FROM oylama where icerik_id='$icerik_id' and user_id='$user_id'");
                            $numara = $sorgula->num_rows;
                            if ($numara<=0) {
                                if (!$uID) {
                                    $conn->query("INSERT INTO oylama (user_id,icerik_id,rateIndex) VALUES ('$user_id','" . $icerik_id . "','$ratedIndex')");
                                    $sql = $conn->query("SELECT rate_id FROM oylama where icerik_id='$icerik_id'");
                                    $uData = $sql->fetch_assoc();
                                    $uID = $uData['id'];
                                } else
                                    $conn->query("UPDATE oylama SET rateIndex='$ratedIndex' WHERE id='$uID'");

                                exit(json_encode(array('id' => $uID)));
                            } else {
                            }
                        }
                        $sql = $conn->query("SELECT rate_id FROM oylama where icerik_id='$icerik_id'");
                        $numR = $sql->num_rows;
                        if ($numR > 0) {
                            $sql = $conn->query("SELECT SUM(rateIndex) AS total FROM oylama where icerik_id='$icerik_id'");
                            $rData = $sql->fetch_array();
                            $total = $rData['total'];

                            $avg = $total / $numR;
                        } else {
                            $avg = 0;
                        }
                        ?>
                        <div class="clean-blog-post">
                            <div class="row">
                                <div class="col-lg-5"><img class="rounded img-fluid" src="assets/img/scenery/<?php echo $sonuc['resim']; ?>"></div>
                                <div class="col-lg-7">
                                    <h3><?php echo $sonuc['konu_ad']; ?></h3>
                                    <div class="info"><span class="text-muted"><?php echo $sonuc['created_at']; ?> by&nbsp;<a href="#"><?php echo $sonuc['username']; ?></a></span></div>
                                    <p><?php echo $sonuc['icerik']; ?></p><a href="blog-post-list.php"><button class="btn btn-outline-primary btn-sm" id="back" type="button">Back</button></a>
                                    <hr>
                                    <div align="center" style="padding: 50px;color:black; width:<?php echo (round($avg, 2)/5)*100; ?>">
                                        <i class="fa fa-star fa-2x" data-index="0"></i>
                                        <i class="fa fa-star fa-2x" data-index="1"></i>
                                        <i class="fa fa-star fa-2x" data-index="2"></i>
                                        <i class="fa fa-star fa-2x" data-index="3"></i>
                                        <i class="fa fa-star fa-2x" data-index="4"></i>
                                        <br><br>
                                        <span id='avg'>
                                        <?php 
                                        $conn = new mysqli('localhost', 'root', '', 'blog');
                                        $sorgula = $conn->query("SELECT rate_id FROM oylama where icerik_id='$icerik_id' and user_id='$user_id'");
                                        $numara = $sorgula->num_rows;
                                        echo "Ortalama: " . round($avg, 2);
                                        if($numara>0){
                                            
                                            echo "<br>Zaten oy verdiniz!"; 

                                        }
                                        ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            include "baglan.php";
            $sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id ");
            $sorgu->execute();
            while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <!-- DÜZENLE Modal -->
                <div class="modal fade" id="duzenle<?= $sonuc['icerik_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Düzenle</h4>
                            </div>
                            <div class="modal-body">
                                <form action="system.php?icerik_id=<?= $sonuc["icerik_id"] ?>" method="POST" enctype="multipart/form-data">
                                    <label>İsim:</label>
                                    <input class="form-control" type="text" class="field left" value="<?php echo $sonuc['username']; ?>" name="username" readonly>
                                    <br>
                                    <label>Subject</label>
                                    <select name="konu_ad" class="form-control" required>
                                        <option selected value="<?php echo $sonuc['konu_id']; ?>"><?php echo $sonuc['konu_ad']; ?></option>
                                        <?php
                                        include "baglan.php";
                                        $sorgula = $baglan->prepare("SELECT * FROM konu");
                                        $sorgula->execute();
                                        while ($son = $sorgula->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <option value="<?php echo $son['konu_id']; ?>"><?php echo $son['konu_ad']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <br>
                                    <label>Mesaj:</label>
                                    <textarea class="form-control" minlength="200" type="text" name="icerik" required><?php echo $sonuc['icerik']; ?></textarea>
                                    <br>
                                    <label>Dosya:</label>
                                    <input class="form-control" type="file" name="resim" required>
                                    <br>

                                    <a href="system.php?icerik_id=<?= $sonuc["icerik_id"] ?>"><button type="submit" name="duzenle" class="btn btn-success ">Düzenle</button></a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <!-- Sil Modal-->
            <?php
            include "baglan.php";
            $sorgu = $baglan->prepare("SELECT * FROM icerik JOIN konu ON icerik.konu_id=konu.konu_id");
            $sorgu->execute();
            while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {

            ?>
                <div class="modal fade" id="sil<?= $sonuc['icerik_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                            </div>
                            <div class="modal-body"> <b><?= $sonuc['konu_ad'] ?></b> ' başlıklı yorumunuzu silmek istediğinizden emin misiniz?</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary pull-left mx-4" type="button" data-dismiss="modal">İptal
                                </button>
                                <form action="system.php?icerik_id=<?= $sonuc["icerik_id"] ?>" method="post">
                                    <a href="system.php?icerik_id=<?= $sonuc["icerik_id"] ?>"><button class="btn btn-danger pull-right mx-4" name="sil" type="submit">Sil</button></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </section>
    </main>
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script>

    
        var ratedIndex = -1,
            uID = 0;


        $(document).ready(function() {
            resetStarColors();

            if (localStorage.getItem('ratedIndex') != null) {
                setStars(parseInt(localStorage.getItem('ratedIndex')));
                uID = localStorage.getItem('uID');
            }

            $('.fa-star').on('click', function() {
                ratedIndex = parseInt($(this).data('index'));
                localStorage.setItem('ratedIndex', ratedIndex);
                saveToTheDB();

            });

            $('.fa-star').mouseover(function() {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);
            });

            
        });

        function saveToTheDB() {
            $.ajax({
                url: "incele.php",
                method: "POST",
                dataType: 'json',
                data: {
                    save: 1,
                    uID: uID,
                    ratedIndex: ratedIndex
                },
                success: function(r) {
                    uID = r.id;
                    localStorage.setItem('uID', uID);
                }
            });
        }
        function setStars(max) {
            for (var i = 0; i <= max; i++)
                $('.fa-star:eq(' + i + ')').css('color', 'gold');
        }

        function resetStarColors() {
            $('.fa-star').css('color', 'gainsboro');
        }
    </script>
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
    <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>