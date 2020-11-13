<?php
	$xtp = new XTemplate("views/products/edit.html");
	$id = $_GET['id'];
	if(isset($id)){
		$rs = $db->getOne('tblproducts',"id={$id}");
		$xtp->assign("EDT",$rs);
		$vFocus = $rs['cat_id'];
		$lsCategory = $db->getSelect('tblcategories','id','cat_name','txtCatName','Please select one',$vFocus);
		$do_save=1;
		if($_POST){
			$data['cat_id'] = $_POST['txtCatName'];
			$data['pro_name'] = $_POST['txtProName'];
			$data['pro_price'] = $_POST['txtProPrice'];
			$file = $_FILES['txtProFile'];
			$arFileType = array('jpg','png');
			$sUrl = "./img/products";
			$maxFileSize = 5000000;
			$data['pro_img'] = $f->uploadFile($file,$sUrl,$arFileType,$maxFileSize);
			if($data['cat_id']==-1){
				$do_save=-1;
				$mess_cat = "Please choose one Category";
				$xtp->assign('mes2',$mess_cat);
			}
			if(!$valid->isString($data['pro_name'])){
				$do_save=-1;
				$mess_proName = "Product Name must be String";
				$xtp->assign('mess_proName',$mess_proName);
			}
			if(!$valid->isNumeric($data['pro_price'])){
				$do_save=-1;
				$mess_proPrice = "Product Price must be Number";
				$xtp->assign('mess_proPrice',$mess_proPrice);
			}
			if($do_save==1){
				if($db->update('tblproducts',$data,"id={$id}")){
					$f->redir("?m=products&a=list");
				}
			}
		}
	}
	$xtp->assign("listCategory",$lsCategory);
	$xtp->parse("EDT");
	$acontent = $xtp->text("EDT");
