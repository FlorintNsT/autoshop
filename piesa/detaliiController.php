<?php 
    include "detaliiView.php";
    include "../common/PiesaModel.php";
    DetaliiController::startController();
    

    class DetaliiController{

       public static function startController(){
        session_start();
        $id_user = $_SESSION['id_user'];
        $conn = mysqli_connect('localhost','root','');
        mysqli_select_db($conn,'PieseAutoDB');
            
        if(isset($_POST['id_piesa'])){
            $check= mysqli_query($conn,"SELECT * from piesa where id_piesa='".$_POST['id_piesa']."'");
            $res = mysqli_fetch_array($check);
            
            $obj = new Piesa($res['id_piesa']
                            ,$res['id_masina']
                            ,$res['pret']
                            ,$res['denumire']
                            ,$res['img']
                            ,$res['sters']);
            
           
            DetaliiView::showDetaliiView($obj);
            
            }
        
        }
    }
?>