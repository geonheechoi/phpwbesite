<?php

	header('Content-Type: text/html; charset=utf-8'); // utf-8 인코딩

	// localhost = DB주소, web=DB계정아이디, 1234=DB계정비밀번호, post_board="DB이름"
	$db = new mysqli("localhost","root","apmsetup","db_article"); 
	if ($db->connect_error) {
		die("데이터베이스 연결 실패: " . $db->connect_error);
	}

	$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}

	// 데이터베이스 연결 종료
	$db->close();

?>
