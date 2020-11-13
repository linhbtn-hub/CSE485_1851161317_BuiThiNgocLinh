<?php
    include("../libs/boost.php");
    $xtp = new XTemplate("views/signin/signup.html");
    $do_save=1;
    if($_POST){
        $data['user_name'] = $_POST['txtUsersName'];
        $data['user_pwd']  = $_POST['pwd'];
        $data['user_pwd']  = sha1($data['user_pwd']);
        $data['user_pwd']  = $data['user_pwd'].$salt;
        if(!$valid->isString($_POST['txtUsersName'])){
            $er_1 = "SAI";
            $xtp->assign('er_1',$er_1);
            $do_save=-1;
        }
        if(!$valid->isString($_POST['pwd'])){
            $er = "SAI";
            $xtp->assign('er',$er);
            $do_save=-1;
        }
        if($do_save==1){
            if($db->insert('tblusers',$data)){
                $f->redir("{$baseUrl}/admin/login.php");
            }
        }
    }
    $xtp->assign('baseUrl',$baseUrl);
    $xtp->parse('SIGNUP');
    $xtp->out('SIGNUP');