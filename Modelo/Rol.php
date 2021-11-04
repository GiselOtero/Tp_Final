<?php
class Rol{
    private $idrol;
    private $roldescripcion;
    private $mensajeoperacion;
    //
    
    public function __construct(){
        $this->idrol="";
        $this->roldescripcion="";
        $this->mensajeoperacion="";
    }

    public function setear($id,$descripcion){
        $this->setIDRol($id);
        $this->setRolDescripcion($descripcion);
    }


    /**
     * 
     */

    public function getIDRol(){
        return $this->idrol;
    }
    public function setIDRol($valor){
        $this->idrol=$valor;
    }

    public function getRolDescripcion(){
        return $this->roldescripcion;
    }
    public function setRolDescripcion($valor){
        $this->roldescripcion=$valor;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion=$valor;
    }

    /**
     * 
     */

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM rol WHERE  idrol= ".$this->getIDRol()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $this->setear($row['idrol'],$row['rodescripcion']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Rol->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol(idrol,cetdescripcion,cetdetalle)  VALUES(".$this->getIDRol().",'".$this->getRolDescripcion()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Rol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE rol SET rodescripcion='".$this->getRolDescripcion()."' WHERE idrol=".$this->getIDRol()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Rol->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->modificar: ".$base->getError());
        }
        return $resp;
    }


    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE idrol=".$this->getIDRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Rol->eliminar: ".$base->getError());
        }
        return $resp;
    }


    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Rol();


                    $obj->setear($row['idrol'],$row['roldescripcion']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("Rol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
}
?>