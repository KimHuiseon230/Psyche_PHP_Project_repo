   <script src="https://kit.fontawesome.com/6a2bc27371.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/css/slide.css' ?>">
   <script src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/js/main.js' ?>"></script>
   <div id="main_content">
     <div id="announce">
       <h4>&nbsp;공지사항</h4>
       <?php
        if (!isset($conn)) {
          include_once $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/db_connect.php";
        }
        $sql = "SELECT * FROM event WHERE id = 'admin' ORDER BY num DESC LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
          print "아직 공지사항이 없습니다.";
        } else {
          foreach ($result as $row) {
        ?>
           <ul class="container">
             <li>
               <span><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/Psyche_PHP_Project/event/event_view.php?num=<?= $row['num'] ?>"><?= $row["subject"] ?></a></span>
               <span><?= substr($row["regist_day"], 0, 10) ?></span>
             </li>
           </ul>
       <?php
          }
        }
        ?>
     </div>
     <div id="ad">
       <div>
         <img style="width: 300px; height: 300px;" src="http://<?= $_SERVER['HTTP_HOST'] . '/Psyche_PHP_Project/img/main_ad_img.jpg" ' ?>" alt="1">
         <!-- <iframe width="520" height="309" src="https://www.youtube.com/embed//eeHdw6aKFRI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
       </div>
     </div>

     <div class="separator"></div>
     <div id="main_slide">
       <div class="title container-center">
       </div>
       <?php include $_SERVER['DOCUMENT_ROOT'] . "/Psyche_PHP_Project/common/slide2.php";  ?>
     </div>
   </div>