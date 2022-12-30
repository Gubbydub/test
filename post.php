<?php
 include_once __DIR__ . '/config/db_connect.php';
 //Получаем параметр GET = id
 $postId = $_GET['id'];
// Подготавливаем запрос в базу данных
 $articleSelect = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
// Выполняем запрос , где подставляем полученый GET id в подготовленый запрос, точнее указываем параметру ':id'
//параметр из полученного GET id
 $articleSelect->execute([
         ':id'=> $postId
        ]);
 //Преобразовываем полученые данные из таблицы 'posts' в асоциативный массив
 $article = $articleSelect->fetch(PDO::FETCH_ASSOC);
//print_r($article);
$commentSelect = $pdo->prepare("SELECT * FROM comments WHERE post_id = :id");
$commentSelect->execute([
        ':id' => $postId,
]);
$comments = $commentSelect->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR__ . '/parts/head.php' ?>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
          <?php include_once __DIR__ . '/parts/header.php' ?>
         <!-- end header inner -->
      </header>
      <!-- end header -->
      <!-- our blog -->
      <div id="blog" class="blog">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2><?= $article['title']?></h2>
                     <figure>
                        <span><?= $article['created_at']?></span>
                        <span>Post  By:  <?= $article['author']?></span>
                     </figure>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                  <div class="blog-box">
                     <figure><img class="posted" src="<?= $article['image']?>" alt="#"/>
                        
                     </figure>
                     <div class="travel">
                     </div>
                     <?= $article['post_content']?>
                  </div>
               </div>
            </div>
             <hr>
<!--  All comment-->
             <?php

             foreach ($comments as $comment) {
                 ?>
                 <div class="travel">
                 </div>
                 <h3><?= $comment['author']?></h3>
                 <p><?= $comment['comment_text']?></p>
             <?php
             }
             ?>

<!-- form -->
             <hr>
             <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                 <div class="Follow">
                     <h3> Add comment</h3>
                     <div class="row">
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                             <form action="actions/addComment.php" method="post">
                                 <input type="hidden" name="post_id" value="<?= $postId?>">
                                 <input class="Newsletter" name="name" placeholder="Name" type="text">
                                 <textarea class="textarea"name="message" placeholder="comment" type="text">Comment</textarea>
                                 <button class="Subscribe" type="submit">Submit</button>
                             </form>
                     </div>
                 </div>
             </div>
             </div>
<!--end form-->
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