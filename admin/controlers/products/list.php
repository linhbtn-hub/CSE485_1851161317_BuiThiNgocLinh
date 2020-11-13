<?php
	$xtp = new XTemplate("views/products/list.html");
	$sql = "SELECT P.id, P.pro_name, P.pro_price, P.pro_img, P.pro_code, C.cat_name FROM tblproducts P INNER JOIN tblcategories C ON P.cat_id = C.id WHERE 1=1";
	$rs = $db->fetchAll($sql);
	$nbr=1;
	foreach($rs as $row){
		$row['nbr'] = $nbr++;
		$xtp->assign("LS",$row);
		$xtp->parse("LISTING.LS");
	} 
	$xtp->parse('LISTING');
	$acontent = $xtp->text('LISTING');