<?php
    include("../libs/boost.php");
    $_SESSION['admin_panel']='';
    session_destroy();
    $f->redir("{$baseUrl}/admin/login.php");