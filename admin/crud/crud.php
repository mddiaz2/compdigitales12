<?php
<<<<<<< HEAD
require_once "Conexion.php";
    class Crud extends Conexion{
=======

require_once "Conexion.php";
    class Crud extends Conexion{


>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
        //DATOS ADMINISTRADORES
        public function mostrarDatos(){
            $sql="SELECT id,
                        email,
                        password
                from tb_usuarios";
<<<<<<< HEAD
=======

>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
            $query=Conexion::conectar()->prepare($sql);
            $query->execute();
            return $query->fetchAll();
            $query->close();
        }
        public function insertarDatos($datos){ //enviar arreglo $datos
<<<<<<< HEAD
            $sql="INSERT into tb_usuarios (email, password)
                         values (:email, :password)";
            $query= Conexion::conectar()->prepare($sql);
            $query->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $query->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            return $query->execute();
            $query->close();
=======
            
            $sql="INSERT into tb_usuarios (email, password)
                         values (:email, :password)";

            $query= Conexion::conectar()->prepare($sql);
            $query->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $query->bindParam(":password", $datos["password"], PDO::PARAM_STR);

       

            return $query->execute();
            $query->close();

           

>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
        }
        public function obtenerDatos($id){
            $sql="SELECT id,
            email,
            password
            from tb_usuarios where id=:id";
            $query=Conexion::conectar()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
            $query->close();
        }
        public function actualizarDatos($datos){
            $sql= "UPDATE tb_usuarios set email= :email,
                                          password= :password
                                where id=:id";
                $query=Conexion::conectar()->prepare($sql);
             $query->bindParam(":email", $datos["email"], PDO::PARAM_STR);
             $query->bindParam(":password", $datos["password"], PDO::PARAM_STR);
             $query->bindParam(":id", $datos["id"], PDO::PARAM_INT);

             return $query->execute();

             $query->close();
<<<<<<< HEAD
=======

>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
        }
        public function eliminarDatos($id){
            $sql= "DELETE from tb_usuarios where id=:id";
            $query=Conexion::conectar()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            return $query->execute();
            $query->close();
        }
        //DATOS ADMINISTRADORES
        public function mostrarDatosP(){
            $sql="SELECT id,
                        email,
                        password
                
                from tb_personas";

            $query=Conexion::conectar()->prepare($sql);
            $query->execute();
            return $query->fetchAll();
            $query->close();
        }
        public function obtenerDatosP($id){
            $sql="SELECT id,
            email,
            password
            from tb_personas where id=:id";
            $query=Conexion::conectar()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
            $query->close();
        }
    
        public function actualizarDatosP($datos){
            $sql= "UPDATE tb_personas set email= :email,
                                          password= :password
                                       
                                         where id=:id";
            $query=Conexion::conectar()->prepare($sql);
             $query->bindParam(":email", $datos["email"], PDO::PARAM_STR);
             $query->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            
             $query->bindParam(":id", $datos["id"], PDO::PARAM_INT);

             return $query->execute();

             $query->close();
<<<<<<< HEAD
=======

>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
        }
        public function insertarDatosP($datos){ //enviar arreglo $datos
            
            $sql="INSERT into tb_personas (email, password)
                         values (:email, :password)";

            $query= Conexion::conectar()->prepare($sql);
            $query->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $query->bindParam(":password", $datos["password"], PDO::PARAM_STR);
           

       

            return $query->execute();
            $query->close();

        }
    
        public function eliminarDatosP($id){
        $sql= "DELETE from tb_personas where id=:id";
        $query=Conexion::conectar()->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        return $query->execute();
        $query->close();
    }
    //datos areas
    public function mostrarDatosA(){
        $sql="SELECT id_area,
<<<<<<< HEAD
                    area   
=======
                    area
                    
>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
            from tb_area";

        $query=Conexion::conectar()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
        $query->close();
    }
    public function insertarDatosA($datos){ //enviar arreglo $datos
            
        $sql="INSERT into tb_area (area)
                     values (:area)";

        $query= Conexion::conectar()->prepare($sql);
        $query->bindParam(":area", $datos["area"], PDO::PARAM_STR);

        return $query->execute();
        $query->close();

    }
    public function obtenerDatosA($id_area){
        $sql="SELECT id_area,
        area
       
        from tb_area where id_area=:id_area";
        $query=Conexion::conectar()->prepare($sql);
        $query->bindParam(":id_area", $id_area, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
        $query->close();
    }
    public function actualizarDatosA($datos){
        $sql= "UPDATE tb_area set area= :area
                                      
                            where id_area=:id_area";
            $query=Conexion::conectar()->prepare($sql);
         $query->bindParam(":area", $datos["area"], PDO::PARAM_STR);
         
         $query->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);

         return $query->execute();

         $query->close();

    }
    public function eliminarDatosA($id_area){
        $sql= "DELETE from tb_area where id_area=:id_area";
        $query=Conexion::conectar()->prepare($sql);
        $query->bindParam(":id_area", $id_area, PDO::PARAM_INT);
        return $query->execute();
        $query->close();
    }
    


    //DATOS Niveles
    public function mostrarDatosN(){
        $sql="SELECT id,
                    nombre
            from tb_niveles";

        $query=Conexion::conectar()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
        $query->close();
    }

    ////Competencias
    public function mostrarDatosC(){
        $sql="SELECT tb_competencias.id,  
        tb_competencias.competencia, tb_area.area 
        FROM tb_competencias 
        inner join tb_area on tb_competencias.id_area=tb_area.id_area";

        $query=Conexion::conectar()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
        $query->close();
    }
    public function insertarDatosC($datos){ //enviar arreglo $datos
            
        $sql="INSERT into tb_competencias (competencia, id_area)
                     values (:competencia, :id_area)";

        $query= Conexion::conectar()->prepare($sql);
        $query->bindParam(":competencia", $datos["competencia"], PDO::PARAM_STR);
        $query->bindParam(":id_area", $datos["id_area"], PDO::PARAM_STR);

   

        return $query->execute();
        $query->close();
    }

    public function eliminarDatosC($id){
        $sql= "DELETE from tb_competencias where id=:id";
        $query=Conexion::conectar()->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        return $query->execute();
        $query->close();
    }
    public function obtenerDatosC($id){
        $sql="SELECT id,
        competencia
        
        from tb_competencias where id=:id";
        $query=Conexion::conectar()->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
        $query->close();
    }
    public function actualizarDatosC($datos){
        $sql= "UPDATE tb_competencias set competencia= :competencia
                                      
                            where id=:id";
            $query=Conexion::conectar()->prepare($sql);
         $query->bindParam(":competencia", $datos["competencia"], PDO::PARAM_STR);
         
         $query->bindParam(":id", $datos["id"], PDO::PARAM_INT);

         return $query->execute();

         $query->close();

    }
    public function mostrarDatosCu(){
        $sql="SELECT tb_cuestionario.id_Cuestionario, tb_cuestionario.id_Areas, tb_cuestionario.id_Competencias, tb_cuestionario.id_Niveles, tb_cuestionario.Preguntas, tb_cuestionario.Nivel, tb_cuestionario.ValorVerdadero, tb_cuestionario.ValorFalso, tb_cuestionario.Numero, tb_competencias.competencia, tb_area.area FROM tb_cuestionario inner join tb_competencias on tb_cuestionario.id_Competencias=tb_competencias.id inner join tb_area on tb_area.id_area=tb_cuestionario.id_Areas order by tb_cuestionario.Numero asc";

        $query=Conexion::conectar()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
        $query->close();
    }
    public function eliminarDatosCu($id_Cuestionario){
        $sql= "DELETE from tb_cuestionario where id_Cuestionario=:id_Cuestionario";
        $query=Conexion::conectar()->prepare($sql);
        $query->bindParam(":id_Cuestionario", $id_Cuestionario, PDO::PARAM_INT);
        return $query->execute();
        $query->close();
    }
    public function obtenerDatosCu($id_Cuestionario){
        $sql="SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel, ValorVerdadero, ValorFalso, Numero
        
        
        from tb_cuestionario where id_Cuestionario=:id_Cuestionario";
        $query=Conexion::conectar()->prepare($sql);
        $query->bindParam(":id_Cuestionario", $id_Cuestionario, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch();
        $query->close();
    }
    public function actualizarDatosCu($datos){
        $sql= "UPDATE tb_cuestionario set id_Areas=:id_Areas, id_Competencias=:id_Competencias, id_Niveles=:id_Niveles, Preguntas=:Preguntas,Nivel=:Nivel, ValorVerdadero=:ValorVerdadero, ValorFalso=:ValorFalso, Numero=:Numero
        WHERE id_Cuestionario=:id_Cuestionario";
            $query=Conexion::conectar()->prepare($sql);
         $query->bindParam(":id_Areas", $datos["id_Areas"], PDO::PARAM_STR);
         $query->bindParam(":id_Competencias", $datos["id_Competencias"], PDO::PARAM_STR);
         $query->bindParam(":id_Niveles", $datos["id_Niveles"], PDO::PARAM_STR);
         $query->bindParam(":Preguntas", $datos["Preguntas"], PDO::PARAM_STR);
         $query->bindParam(":Nivel", $datos["Nivel"], PDO::PARAM_STR);
         $query->bindParam(":ValorVerdadero", $datos["ValorVerdadero"], PDO::PARAM_STR);
         $query->bindParam(":ValorFalso", $datos["ValorFalso"], PDO::PARAM_STR);
         $query->bindParam(":Numero", $datos["Numero"], PDO::PARAM_STR);
         $query->bindParam(":id_Cuestionario", $datos["id_Cuestionario"], PDO::PARAM_INT);

         return $query->execute();

         $query->close();

    }

    }

?>