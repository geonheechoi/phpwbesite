<?php
	include $_SERVER['DOCUMENT_ROOT']."/db_conn.php"; 
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/common.css" />
</head>
<body>
	<?php
		$seq = mysqli_real_escape_string($db, $_GET['seq']);

		// 조회수 증가
		$sql = "UPDATE tbl_board SET view_count = view_count + 1 WHERE seq = '$seq'";
		mysqli_query($db, $sql);

		// 게시물 정보 가져오기
		$sql = "SELECT * FROM tbl_board WHERE seq='$seq'";
		$result = mysqli_query($db, $sql);
		$board = mysqli_fetch_array($result);
	?>
<div id="board_read">
	<h2><?php echo htmlspecialchars($board['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
	<div id="user_info">
		<?php 
		echo htmlspecialchars($board['writer'], ENT_QUOTES, 'UTF-8')." ";
		echo htmlspecialchars($board['reg_at'], ENT_QUOTES, 'UTF-8')." 조회:";
		echo htmlspecialchars($board['view_count'], ENT_QUOTES, 'UTF-8'); 
		?>
		<div id="bo_line"></div>
	</div>
	<div id="bo_content">
		<?php echo nl2br(htmlspecialchars($board['content'], ENT_QUOTES, 'UTF-8')); ?>
	</div>
	<div id="bo_ser">
		<ul>
			<li><a href="/board_list.php">[목록으로]</a></li>
			<li><a href="board_edit.php?seq=<?php echo htmlspecialchars($board['seq'], ENT_QUOTES, 'UTF-8'); ?>">[수정]</a></li>
			<li><a href="board_delete.php?seq=<?php echo htmlspecialchars($board['seq'], ENT_QUOTES, 'UTF-8'); ?>">[삭제]</a></li>
		</ul>
	</div>
</div>
</body>
