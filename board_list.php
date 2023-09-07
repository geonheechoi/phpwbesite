<?php 
include $_SERVER['DOCUMENT_ROOT']."/db_conn.php"; 
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/common.css" />
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/testCommon.js"></script>
</head>
<body>

<div id="board_area"> 
  <h1>자유게시판</h1>
  <div id="search_box">
    <form action="board_process.php" method="get">
        <input type="text" name="search" placeholder="검색어를 입력하세요">
        <button type="submit">검색</button>
    </form>
    <div id="write_btn">
      <a href="/board_write.php"><button>글쓰기</button></a>
    </div>
  </div>
  <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">게시물번호</th>
              <th width="200">제목</th>
              <th width="120">작성자</th>
              <th width="100">조회수</th>
              <th width="100">등록일자</th>
          </tr>
      </thead>
      <?php
      $page = 1;
      if(isset($_GET['page']) && is_numeric($_GET['page'])){ 
          $page = intval($_GET['page']);
      }

      $stmt = $db->prepare("SELECT count(*) FROM tbl_board");
      $stmt->execute();
      $stmt->bind_result($total_count);
      $stmt->fetch();
      $stmt->close();

      $list = 5;
      $block_ct = 5;
      $block_num = ceil($page/$block_ct);
      $block_start = (($block_num - 1) * $block_ct) + 1;
      $block_end = $block_start + $block_ct - 1;
      $total_page = ceil($total_count / $list);
      if($block_end > $total_page) $block_end = $total_page;
      $start_num = ($page-1) * $list;

      $stmt2 = $db->prepare("SELECT seq, title, writer, view_count, reg_at FROM tbl_board ORDER BY seq DESC LIMIT ?, ?");
      $stmt2->bind_param('ii', $start_num, $list);
      $stmt2->execute();
      $stmt2->bind_result($seq, $title, $writer, $view_count, $reg_at);

      while($stmt2->fetch()){
          if(mb_strlen($title, "utf-8") > 30){
              $title = mb_substr($title, 0, 30, "utf-8")."...";
          }
      ?>
      <tbody>
      <tr>
      <td width="70"><a href="/board_view.php?seq=<?php echo $seq; ?>"><?php echo $seq; ?></a></td>
      <td width="200"><a href="/board_view.php?seq=<?php echo $seq; ?>"><?php echo $title; ?></a></td>
      <td width="120"><a href="/board_view.php?seq=<?php echo $seq; ?>"><?php echo $writer; ?></a></td>
      <td width="100"><a href="/board_view.php?seq=<?php echo $seq; ?>"><?php echo $view_count; ?></a></td>
      <td width="100"><a href="/board_view.php?seq=<?php echo $seq; ?>"><?php echo $reg_at; ?></a></td>
      </tr>
      </tbody>
      <?php } 
      $stmt2->close();
      ?>
    </table>
    <div id="page_num">
      <ul>
        <?php
        if($page <= 1){
            echo "<li class='fo_re'>처음</li>";
        }else{
            echo "<li><a href='?page=1'>처음</a></li>";
        }
        if($page <= 1){
        }else{
            $pre = $page-1;
            echo "<li><a href='?page=$pre'>이전</a></li>";
        }
        for($i=$block_start; $i<=$block_end; $i++){
            if($page == $i){
                echo "<li class='fo_re'>[$i]</li>";
            }else{
                echo "<li><a href='?page=$i'>[$i]</a></li>";
            }
        }
        if($block_num >= ceil($total_count/$block_ct)){
        }else{
            $next = $page + 1;
            echo "<li><a href='?page=$next'>다음</a></li>";
        }
        if($page >= $total_page){
            echo "<li class='fo_re'>마지막</li>";
        }else{
            echo "<li><a href='?page=$total_page'>마지막</a></li>";
        }
        ?>
      </ul>
    </div>
  </div>
</body>
</html>
