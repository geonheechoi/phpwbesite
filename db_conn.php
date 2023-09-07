<?php
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

	// localhost = DB주소, root=DB계정아이디, apmsetup=DB계정비밀번호, db_article="DB이름"
	$db = new mysqli("localhost", "root", "apmsetup", "db_article"); 
	if ($db->connect_error) {
		die("데이터베이스 연결 실패: " . $db->connect_error);
	}

	$db->set_charset("utf8");

	function mq($sql, $params = array()) {
		global $db;
		$stmt = $db->prepare($sql);
		if($params && is_array($params)) {
			$types = '';
			$bind_names[] = &$types;
			foreach($params as $key => $value) {
				$types .= 's'; // 문자열로 간주
				$bind_name = 'bind' . $key;
				$$bind_name = $value;
				$bind_names[] = &$$bind_name;
			}
			call_user_func_array(array($stmt, 'bind_param'), $bind_names);
		}
		$stmt->execute();
		return $stmt;
	}
?>
