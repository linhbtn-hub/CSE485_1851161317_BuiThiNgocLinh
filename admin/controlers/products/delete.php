<?php
	$id = $_GET['id'];
	if(isset($id)){
		if($db->delete('tblproducts',"id={$id}")){
			$f->redir("?m=products&a=list");
		}
	}