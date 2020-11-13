<?php
    $xtp = new XTemplate("views/users/add.html");
    $do_save=1;
    if($_POST){
        $data['user_name'] = $_POST['txtUser'];
        $data['user_pwd'] = $_POST['txtPwd'];
        $data['user_pwd']  = sha1($data['user_pwd']);
        $data['user_pwd']  = $data['user_pwd'].$salt;
        
        $xtp->assign('ADD',$data);
        if($do_save==1){
            if($db->insert('tblusers',$data)){
                $f->redir("?m=users&a=list");
            }
        }
    }
    $xtp->parse('ADD');
    $acontent = $xtp->text('ADD');
