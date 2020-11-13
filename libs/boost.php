	<?php
		session_start();
		include("XTemplate.class.php");
		include("Model.class.php");
		include("Func.class.php");
		include("Validate.class.php");
		$db = new Model('admin_project','root',''); //Model: kết nối và tương tác crud với database
		$f = new Func; //Function: Upload ảnh lên database
		$valid = new Validate; //Vaidate: Xác thực thông tin nhập vào trong input
		$salt = sha1("1Q2345@#");
		$baseUrl = "http://".$_SERVER['HTTP_HOST']."/admin_panel";
