<?php 
include $_SERVER['DOCUMENT_ROOT']."/db_conn.php"; 

$searchValue = isset($_GET['search']) ? $_GET['search'] : '';

$stmt = $db->prepare("SELECT seq, title, writer, view_count, reg_at FROM tbl_board WHERE title LIKE ? OR content LIKE ? OR writer LIKE ?");
$searchParam = '%' . $searchValue . '%';
$stmt->bind_param('sss', $searchParam, $searchParam, $searchParam);
$stmt->execute();

$stmt->bind_result($seq, $title, $writer, $view_count, $reg_at);
$boards = array();
while($stmt->fetch()){
    $boards[] = array(
        'seq' => $seq,
        'title' => $title,
        'writer' => $writer,
        'view_count' => $view_count,
        'reg_at' => $reg_at
    );
}
$stmt->close();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>검색 결과</title>
    <link rel="stylesheet" type="text/css" href="/css/common.css" />
</head>
<body>
<div id="board_area"> 
    <h1>"<?php echo $searchValue; ?>"에 대한 검색 결과</h1>
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
        <h1><a href="/board_list.php">자유게시판으로 돌아가기</a></h1>
        
<tbody>
    <?php 
    foreach($boards as $board){
        echo "<tr>";
        echo "<td><a href='/board_view.php?seq=".htmlspecialchars($board["seq"], ENT_QUOTES, 'UTF-8')."'>".htmlspecialchars($board['seq'], ENT_QUOTES, 'UTF-8')."</a></td>";
        echo "<td><a href='/board_view.php?seq=".htmlspecialchars($board["seq"], ENT_QUOTES, 'UTF-8')."'>".htmlspecialchars($board['title'], ENT_QUOTES, 'UTF-8')."</a></td>";
        echo "<td><a href='/board_view.php?seq=".htmlspecialchars($board["seq"], ENT_QUOTES, 'UTF-8')."'>".htmlspecialchars($board['writer'], ENT_QUOTES, 'UTF-8')."</a></td>";
        echo "<td><a href='/board_view.php?seq=".htmlspecialchars($board["seq"], ENT_QUOTES, 'UTF-8')."'>".htmlspecialchars($board['view_count'], ENT_QUOTES, 'UTF-8')."</a></td>";
        echo "<td><a href='/board_view.php?seq=".htmlspecialchars($board["seq"], ENT_QUOTES, 'UTF-8')."'>".htmlspecialchars($board['reg_at'], ENT_QUOTES, 'UTF-8')."</a></td>";
        echo "</tr>";
    }
    ?>
</tbody>
    </table>
</div>
</body>
</html>
