<?php
	class Validate{
		public function isString($str){
			$reg = "/^[A-Za-z0-9 ]+$/";
			return preg_match($reg,$str);
		}
		public function isNumeric($str){
			$reg = "/^\d+$/";
			return preg_match($reg,$str);
		}
		public function isNull($str){
			$reg = "/^$/";
			return preg_match($reg,$str);
		}
	}