<?php 
    
    include_once ('../common/config.php');

    include "loginView.php";
    session_start();


if (isset($_GET['contNouR'])){
    LoginView::showContNouR();
    }
    
    if(isset($_POST['login']))
    {
        $login_par = $_POST['login'];
        LoginView::executeLogin($login_par);
    }
    if (isset($_POST['register'])) {
       
        LoginView::executeRegister($_POST['username'], $_POST['password'], $_POST['email']);
       
    }else{
        LoginView::showLogin();
    
    }


?>