<?php
 include('../database.php');
    
//Codigo para crear el cuestionario del modelo o instrumento

//informacion importante en las preguntas aqui debemos aplicarle un methodo para que ya no se repitan las preguntas osea el numero de pregunta para poder aplicar el codigo for 
  require '../database.php';
  $message = '';

	
//if (!empty($_POST['id_Areas']) && !empty($_POST['id_Competencias'])&& !empty($_POST['id_Niveles']) && !empty($_POST['Preguntas']) && !empty($_POST['Nivel'])&& !empty($_POST['ValorVerdadero'])&& !empty($_POST['ValorFalso']) && !empty($_POST['Numero']) ) {
    if (!empty($_POST['id_Areas']) && !empty($_POST['id_Competencias'])&& !empty($_POST['id_Niveles']) && !empty($_POST['Preguntas']) && !empty($_POST['Nivel'])&& !empty($_POST['ValorVerdadero'])&& !empty($_POST['Numero']) ) {

        $id_Areas=$_POST['id_Areas'];
        $id_Competencias=$_POST['id_Competencias'];
        $id_Niveles=$_POST['id_Niveles'];
        //$Codigo_Indicador=$_POST['Codigo_Indicador'];
        $Preguntas=$_POST['Preguntas'];
        $Nivel=$_POST['Nivel'];
        $ValorPorcentaje=$_POST['ValorPorcentaje'];	
        $ValorVerdadero=$_POST['ValorVerdadero'];
        $Numero=$_POST['Numero'];
        $ValorFinal=$ValorVerdadero*$ValorPorcentaje/100;
        
        $sql = "INSERT INTO tb_cuestionario (id_Areas, id_Competencias, id_Niveles, preguntas, Nivel, ValorVerdadero, ValorFalso, Numero) VALUES ('$id_Areas', '$id_Competencias', '$id_Niveles', '$Preguntas', '$Nivel', '$ValorVerdadero', '$ValorFinal', '$Numero')";
            
            //$sql = 'INSERT INTO tb_cuestionario (id_Areas, id_Competencias, id_Niveles, Codigo_Indicador, preguntas, Nivel, ValorVerdadero, ValorFalso, Numero) VALUES (:id_Areas, :id_Competencias, :id_Niveles, :Codigo_Indicador, :Preguntas, :Nivel, :ValorVerdadero, :ValorFinal, :Numero)';
            $stmt = $conn->prepare($sql);
             $stmt->bindParam(':id_Areas', $_POST['id_Areas']);
             $stmt->bindParam(':id_Competencias', $_POST['id_Competencias']);
              $stmt->bindParam(':id_Niveles', $_POST['id_Niveles']);
            // $stmt->bindParam(':Codigo_Indicador', $_POST['Codigo_Indicador']);
              $stmt->bindParam(':Preguntas', $_POST['Preguntas']);
            $stmt->bindParam(':Nivel', $_POST['Nivel']);
            $stmt->bindParam(':ValorVerdadero', $_POST['ValorVerdadero']);
            $stmt->bindParam(':ValorFalso', $_POST['ValorFalso']);
            $stmt->bindParam(':Numero', $_POST['Numero']);
            echo $stmt->execute();
           // if ($stmt->execute()) {
            
            //echo "Se guardo correctamente el cuestionario";
           // header ('Location: Cuestionario_Listar_frm.php');
             
            //} else {
        //echo "Error de sevidor 404...!";
        
            //}
            }
        ?>
        
        