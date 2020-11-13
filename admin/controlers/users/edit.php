<?php
	$xtp = new XTemplate("views/users/edit.html");
	$id = $_GET['id'];
	if(isset($id)){
		$rs = $db->getOne('tblusers',"id={$id}");
		$xtp->assign("EDT",$rs);
		$do_save=1;
		if($_POST){			
			$data['user_name'] = $_POST['txtUser'];
			$data['user_pwd'] = $_POST['txtPwd'];
			$data['user_pwd']  = sha1($data['user_pwd']);
			$data['user_pwd']  = $data['user_pwd'].$salt;
			
			if($do_save==1){
				if($db->update('tblusers',$data,"id={$id}")){
					$f->redir("?m=users&a=list");
				}
			}
		}
	}
	$xtp->parse("EDT");
	$acontent = $xtp->text("EDT");
