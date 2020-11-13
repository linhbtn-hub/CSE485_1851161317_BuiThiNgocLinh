<?php
	$id = $_GET['id'];
	if(isset($id)){
		if($db->delete('tblcategories',"id={$id}")){
			$f->redir("?m=categories&a=list");
		}
	}