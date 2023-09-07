<?php
	include $_SERVER['DOCUMENT_ROOT']."/db_conn.php"; 
	
	$seq = mysqli_real_escape_string($db, $_GET['seq']); 

	if(is_numeric($seq)) {
		// 사용자 권한 확인 로직 추가 (예: 로그인한 사용자가 해당 게시물의 작성자인지 확인)
		$sql = mq("delete from tbl_board where seq='$seq';"); 
		echo "<script>alert('삭제되었습니다.');</script>";
	} else {
		echo "<script>alert('잘못된 접근입니다.');</script>";
	}
?>
<meta http-equiv="refresh" content="0 url=/board_list.php" />
