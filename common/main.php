 <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/css/slide.css' ?>">
 <script src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/js/main.js' ?>"></script>
 <div id="main_content">
   <div id="announce">
     <h4>&nbsp;공지사항</h4>
     <?php
      if (!isset($conn)) {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/project_php/common/db_connect.php";
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
         <ul>
           <li>
             <span><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/php_source/project/board/board_view.php?num=<?= $row['num'] ?>"><?= $row["subject"] ?></a></span>
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
       <img style="width: 300px; height: 300px;" src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/go_1.png" ' ?>" alt="1">
       <!-- <iframe width="520" height="309" src="https://www.youtube.com/embed//eeHdw6aKFRI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
     </div>
   </div>
   <div class="separator"></div>
   <div id="main_slide">
     <div class="image-slider">
       <div class="slide-wrapper">
         <div class="slide">
           <img src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/001.jpg" ' ?>" alt="1">
         </div>
         <div class="slide">
           <img src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/002.jpg" ' ?>" alt="1">
         </div>
         <div class="slide">
           <img src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/003.jpg" ' ?>" alt="1">
         </div>
         <div class="slide">
           <img src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/004.jpg" ' ?>" alt="1">
         </div>
         <div class="slide">
           <img src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/005.jpg" ' ?>" alt="1">
         </div>
         <div class="slide">
           <img src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/006.jpg" ' ?>" alt="1">
         </div>
         <div class="slide">
           <img src="http://<?= $_SERVER['HTTP_HOST'] . '/project_php/img/007.jpg" ' ?>" alt="1">
         </div>
       </div>
       <button class="prev-btn">Previous</button>
       <button class="next-btn">Next</button>
     </div>
     <!-- <div id="rorem">
      <ul>
        <li>
          <h2>6월 박물관 문화행사: 옛날 이야기와 함께하는 여름</h2>
        </li>
        <br>
        <br>
        <li>
          <p>올 6월, 박물관에서 여름을 맞이하는 특별한 문화행사에 참여하세요! 우리 역사의 소중한 상징물들과 다양한 프로그램 및 체험을 통해 더욱 풍성한 여름을 만끽해 보세요.</p>
        </li>
      </ul> -->
   </div>
 </div>