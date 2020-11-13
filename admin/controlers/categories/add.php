<?php
    $xtp = new XTemplate("views/categories/add.html");
    $do_save=1;
    if($_POST){
        $data['cat_name'] = $_POST['txtCatName'];
        $xtp->assign('ADD',$data);
        if($do_save==1){
            if($db->insert('tblcategories',$data)){
                $f->redir("?m=categories&a=list");
            }
        }
    }
    $xtp->parse('ADD');
    $acontent = $xtp->text('ADD');
