<?php
    class Func{
        public function uploadFile($file,$sUrl,$arFileType,$maxSize){
            $fileName = $file['name'];
            $fileSize = $file['size']; //tra ve byte = 8 bits
            $tmpFileName = $file['tmp_name'];
            $errCode = '';
            $ext = $this->getExtension($fileName); //getExtension: lấy đuôi file (jpg, png, gif, jpeg, ...)
            if(!in_array($ext,$arFileType)){
                $errCode = '101';//khong dung type file;
            }
            if($fileSize>$maxSize){
                $errCode = '102'; //vuot qua file cho phep;
            }
            if($errCode==''){
                $newFileName = time().'_'.$fileName;
                $new_sUrl = $sUrl.'/'.$newFileName;
                if(move_uploaded_file($tmpFileName,$new_sUrl)){
                    $errCode = $new_sUrl;
                }
                else{
                    $errCode = '303'; //khong len toi server;
                }
                return $errCode;
            }
        }
        public function getExtension($str){
            $arExt = explode('.',$str); //explode: ép từ chuỗi sang mảng
            $ext = end($arExt); //end: lấy phần tử cuối cùng
            return strtolower($ext); //strtoLower: chuyển từ chữ hoa sang chữ thường
        }
        //redir: redirect: chuyển trang
        public function redir($url){
            header("Location: $url");
        }
    }