<?php 

class AdminView{
    public static function showAdminView(){
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Admin</title>
             <link rel="stylesheet" href="admin.css">
        </head>
        <body>';
         include('../common/topClient.php'); 
           echo ' <link rel="stylesheet" href="../client/client.css">
            <div>
                <ul>
                    <li><a href="controls/adaugaPiesaController.php" >Adauga Piesa</a></li>
                    <br/>
                    <li><a href = "controls/adaugaMasinaController.php">Adauga Masina</a></li>
                    <br/>
                    <li><a href="controls/editeazaMasiniController.php">Editeaza Masini</a></li>
                    <br/>
                    <li><a href="controls/editeazaPieseController.php">Editeaza Piese</a></li>
                    <br/>
                    <li><a href="controls/stergeMasinaController.php">Sterge Masina</a></li>
                    <br/>
                    <li><a href="controls/stergePiesaController.php">Sterge Piese</a></li>
                </ul>
            </div>';
            include('../common/bottomClient.php'); 
       echo'
        </body>
        </html>
        ';
    }
}
?>