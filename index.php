<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__ . '/parts/head.php' ?>

<!-- body -->
<body class="main-layout">

<!-- header -->
<header>
    <!-- header inner -->
    <?php include_once __DIR__ . '/parts/header.php' ?>
    <!-- end header inner -->
</header>
<!-- end header -->
<section>
    <div class="banner-main">
        <img src="images/banner.jpg" alt="#"/>
        <div class="container">
            <div class="text-bg">
                <h1>WAYUP<br><strong class="white">freelance tips</strong></h1>
            </div>
        </div>
    </div>
</section>
<!-- our blog -->
<div id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Последние новости</h2>
                    <span>Читайте и охуевайте с последних новостей</span>
                </div>
            </div>
        </div>
        <div class="row">

            <?php
            include_once __DIR__ . '/config/db_connect.php';
            $posts = $pdo->query("SELECT id, title, sub_title, author, created_at, image FROM posts ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

            foreach ($posts as $post) {
                ?>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="blog-box">
                        <figure><img src="<?= $post['image'] ?>" alt="#"/>
                            <span><?= $post['created_at'] ?></span>
                        </figure>
                        <div class="travel">
                            <span>Post  By: <?= $post['author'] ?></span>
                        </div>
                        <h3><?= $post['title'] ?></h3>
                        <p><?= $post['sub_title'] ?></p>
                        <a href="post.php?id=<?= $post['id']?>"> Read more</a>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</div>
<!-- end our blog -->
<!-- footer -->
<?php include_once __DIR__ . '/parts/footer.php' ?>
<!-- end footer -->
<!-- Javascript files-->
<?php include_once __DIR__ . '/parts/scripts.php' ?>
<!-- javascript -->

</body>
</html>