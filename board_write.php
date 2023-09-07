<?php
include $_SERVER['DOCUMENT_ROOT']."/db_conn.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //각 변수에 write.php에서 input name값들을 저장한다
    $writer = $_POST['writer'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $reg_at = date('Y-m-d H:i:s'); // 현재 날짜와 시간을 저장

    if($writer && $title && $content){
        $sql = mq("insert into tbl_board(writer, title, content, reg_at) values('".$writer."','".$title."','".$content."','".$reg_at."')"); 
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='/board_list.php';</script>";
    }else{
        echo "<script>
        alert('글쓰기에 실패했습니다.');
        history.back();</script>";
    }
   
}
?>

<!doctype html>
<head>
<script src="/js/common.js"></script>
<script src="/js/testCommon.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="/css/common.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/board_list.php">자유게시판</a></h1>

        <h4>글을 작성하는 공간입니다.</h4>
        <div id="write_area">
        <!--    <form action="" method="post"> -->
            <form action="" method="post" accept-charset="UTF-8">

                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="200" required  oninput="checkMaxLength(this);"></textarea>
                    <script src="/js/common.js"></script>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="writer" id="uwriter" rows="1" cols="55" placeholder="작성자" maxlength="100" required oninput="checkMaxLength(this);"></textarea>
                    <script src="/js/common.js"></script>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" maxlength= "300" required oninput="checkMaxLength(this);"></textarea>
                    <script src="/js/common.js"></script>
                </div>
                <div class="bt_se">
                    <button type="submit">글 작성</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
