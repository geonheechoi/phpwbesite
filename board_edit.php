<?php
include $_SERVER['DOCUMENT_ROOT']."/db_conn.php"; // DB 연결 파일

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seq = $_POST['seq'];
    $writer = $_POST['writer'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $up_at = date('Y-m-d H:i:s'); // 현재 날짜와 시간을 저장

    // Prepared Statement를 사용하여 SQL Injection 방지
    $stmt = $db->prepare("UPDATE tbl_board SET writer=?, title=?, content=?, up_at=? WHERE seq=?");
    $stmt->bind_param('ssssi', $writer, $title, $content, $up_at, $seq);
    if ($stmt->execute()) {
        echo "<script>alert('수정되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0; url=/board_view.php?seq=" . $seq . "'>";
        exit;
    }
}

$seq = $_GET['seq'];
$sql = mq("SELECT * FROM tbl_board WHERE seq='$seq'");
$sql->store_result();
//$sql->bind_result($seq, $writer, $title, $content, $up_at, $view_count); // 필드 변수 바인딩
$sql->fetch();
?>
<!doctype html>
<html>
<head>
    <script src="/js/common.js"></script>
    <script src="/js/testCommon.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <meta charset="UTF-8">
    <title>게시판 수정</title>
    <link rel="stylesheet" href="/css/common.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/board_list.php">자유게시판</a></h1>
        <h4>글을 수정합니다.</h4>
        <div id="write_area">
            <form action="board_edit.php" method="post">
                <input type="hidden" name="seq" value="<?php echo $seq; ?>">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo htmlspecialchars($title); ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="writer" id="uwriter" rows="1" cols="55" placeholder="작성자" maxlength="100" required><?php echo htmlspecialchars($writer); ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required><?php echo htmlspecialchars($content); ?></textarea>
                </div>
                <div class="bt_se">
                    <button type="submit" id="editBtn">글 수정</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
