<?php
	$xtp = new XTemplate("views/users/list.html");
	$sql = "SELECT * FROM tblusers";
	$rs = $db->fetchAll($sql);
	$nbr=1;
	foreach($rs as $row){
		$row['nbr'] = $nbr++;
		$xtp->assign("LS",$row);
		$xtp->parse("LISTING.LS");
	} 
	$xtp->parse('LISTING');
	$acontent = $xtp->text('LISTING');