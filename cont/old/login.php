<?php
include_once ('../common/config.php');
session_start();
$semn = "'";
$form_log = '
	<form id="formlogare" action = "" method = "post">
                  <img src="../images/turbina.png" class="avatar"><br>
                  <label id="test">Username</label><br>
                  <input id="username" type = "text" name = "username" class = "box" placeholder="Introdu username" /><br><br>
                  <label>Parola</label><br>
                  <input id="password" type = "password" name = "password" class = "box" placeholder="Introdu parola" /><br><br>
                  <input class = "Butonel1" onmouseover="validateLogin();" type = "submit" name = "login" value = " Logare "/><br />
                  <input class = "Butonel1" type="button" name="newacc" value=" Cont nou " onclick=cont_nou();>
               </form>
';
$only = str_replace('"', "'", $form_log);
$form_log_complet = $only;
$cont_nouJS = '';

if (isset($_GET['contNouR'])){
echo '
    <script>
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             //    document.getElementById("formlogare").remove();
                document.getElementById("paddingLogin").innerHTML = this.responseText;
            }
        };
        var str = "0";
        xmlhttp.open("GET", "cont_nou.php?coin=0", true);
        xmlhttp.send()
     </script>
';
}

if(isset($_POST['login']))
{
   echo "nu are cum";
   $uname=$_POST['username'];
   $password=($_POST['password']);
   $sql ="SELECT username, password FROM user WHERE username=:uname";
   $query= $dbh -> prepare($sql);
   $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
   //$query-> bindParam(':password', $password, PDO::PARAM_STR);
   $query-> execute();
   $results=$query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount() > 0)
   {
	  if($uname == 'admin'){
		 //echo $uname;
		 $_SESSION['admin'] = "admin";
		 echo "<script type='text/javascript'> document.location = 'admin.php'; </script>";
	  } else {
		
		 $_SESSION['admin'] = null;
         	$conn = mysqli_connect('localhost','root','');
         mysqli_select_db($conn,'PieseAutoDB');

          $check= mysqli_query($conn,"SELECT * from user where username='".$uname."'");
            $res = mysqli_fetch_array($check);
            if ($res[0] != NULL) {
              //
              $check1= mysqli_query($conn,"SELECT password from user where username='".$uname."'");
               $res1 = mysqli_fetch_array($check1);

               if ($res1[0] == $password){
                echo "<script> alert('".$password."')</script>";
                 
              echo "<script type='text/javascript'> document.location = 'client.php'; </script>";
               header("location: client.php");

              } else {
                 $error1 = "Parola invalida.";
              //   echo "<script type='text/javascript'> document.location = 'client.php'; </script>";
               //header("location: client.php");
                   echo "<script> alert('".$error1."')</script>";
              }

            } else {
             // echo "<script type='text/javascript'> document.location = 'client.php'; </script>";
              // header("location: client.php");
              $error = "Username invalidaa.";
              echo "<script> alert('".$error."')</script>";
            }
           // echo "SELECT * from user where username='".$uname."'";
           $_SESSION['id_user'] = $uname;

       
	}

	
   } else {
	   $error = "Username invalidass.";
      echo "<script> alert('".$error."')</script>";
	}
}
if (isset($_POST['register'])) {
   
    $username    = $_POST['username'];
    $password    = $_POST['password'];
    $email       = $_POST['email'];
   echo "
      <div id='teset'></div>
      <script> 
      
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
               
               if(this.responseText !== ''){
                window.location = 'login.php?contNouR=1';
                  alert(this.responseText);
               }
            };
        xmlhttp.open('GET', 'cont_nou.php?coin=1&username=".$username."&password=".$password."&email=".$email."', true);
        xmlhttp.send();
      </script>
   ";
 
   
}else{
   echo '
<html>  
   <head>
      <title>Pagina de logare</title>
      <link rel="stylesheet" href="login.css">
   </head>  
   <body>  
      <h1 id = "headerMic" >MotoShop</h1>
      <div class = "center" >
         <div id="ecranlog" class = "login" >
            <div id = "headerMic">
               <b>Logare</b></div>
            <div id = "paddingLogin">
               '.$form_log.'
               <div ></div>
            </div>         
         </div>      
         <h1 id = "headerMic1" >By Georgian Florin Nastase</h1>
      </div>
      <script type="text/javascript">
      	function validateLogin(){

        	var username = document.getElementById("username").value;
        	var pass = document.getElementById("password").value;

        	if(username.length == 0){
                  alert("Lipseste username");	
            } else{
            	if (pass.length == 0){
            	   alert("Lipseste parola");
            }
            }
        }
         function anulare(){
         	var form = '; echo json_encode($form_log); echo ';
         	document.getElementById("paddingLogin").innerHTML = form;
         }

         function cont_nou(){

            var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             //    document.getElementById("formlogare").remove();
                document.getElementById("paddingLogin").innerHTML = this.responseText;
            }
        };
        var str = "0";
        xmlhttp.open("GET", "cont_nou.php?coin=0", true);
        xmlhttp.send();

         }

        function validateEmail(email) {

           var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\       .[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
           return re.test(email);
          
        }

          function validate() {
           
           var email = document.getElementById("email").value;

        
           if (validateEmail(email)) {

           } else {
             alert("Email invalid");
          }

                var username = document.getElementById("usernameField").value;
                if(username.length == 0){
                  alert("Username invalid");
                }

           }


         function test_str() { 
            var res; 
            var str = 
                document.getElementById("password").value; 
            if (str.match(/[a-z]/g) && str.match( 
                    /[A-Z]/g) && str.match( 
                    /[0-9]/g) && str.match( 
                    /[^a-zA-Z\d]/g) && str.length >= 8) 
                res = "TRUE"; 
            else 
                res = "FALSE"; 
            
            return res;
          
        } 


         '."
        var check = function() {
          if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {

            if (test_str() == 'TRUE'){
                 
                 
                  document.getElementById('message').innerHTML = 'Correct';
              
              }else {

                  
                  document.getElementById('message').innerHTML = 'Parola nu este conforma';
              
              }

          } else {
           
            document.getElementById('message').innerHTML = 'Nu sunt lafel';
          }
        }
        ".'
      </script>
   </body>
</html>

   ';
}
?>



