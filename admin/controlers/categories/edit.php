<?php
    $xtp = new XTemplate("views/categories/edit.html");
    $id = $_GET['id'];
    if(isset($id)){
		$rs = $db->getOne('tblcategories',"id={$id}");
		$xtp->assign("EDT",$rs);
        $do_save=1;
        if($_POST){
            $data['cat_name'] = $_POST['txtCatName'];
            $xtp->assign('EDT',$data);
            if($do_save==1){
                if($db->update('tblcategories',$data, "id={$id}")){
                    $f->redir("?m=categories&a=list");
                }
            }
        }
    }
    $xtp->parse('EDT');
    $acontent = $xtp->text('EDT');
