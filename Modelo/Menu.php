<?php
class Menu{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $objPadre; //idpadre;
    private $medeshabilitado;
    private $mensajeoperacion;

    public function __construct(){
        $this->idmenu="";
        $this->menombre="";
        $this->medescripcion="";
        $this->objPadre="";//idpadre;
        $this->medeshabilitado="";
        $this->mensajeoperacion="";

    }
    public function setear($id,$nombre,$descripcion,$padre,$desahibilitar){
        $this->setIDMenu($id);
        $this->setMeNombre($nombre);
        $this->setMeDescripcion($descripcion);
        $this->setPadre();
        $this->setMeDeshabilitado($desahibilitar);
    }

    /**
     * 
     */

    public function getIDMenu(){
        return $this->idmenu;
    }
    public function setIDMenu($valor){
        $this->idmenu=$valor;
    }

    public function getMeNombre(){
        return $this->menombre;
    }
    public function setMeNombre($valor){
        $this->menombre=$valor;
    }

    public function getMeDescripcion(){
        return $this->medescripcion;
    }
    public function setMeDescripcion($valor){
        $this->medescripcion=$valor;
    }

    public function getPadre(){
        return $this->objPadre;
    }
    public function setPadre($valor){
        $this->objPadre=$valor;//idpadre
    }

    public function getMeDeshabilitado(){
        return $this->medeshabilitado;
    }
    public function setMeDeshabilitado($valor){
        $this->medeshabilitado=$valor;
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
        $sql="SELECT * FROM menu WHERE  idmenu= ".$this->getIDMenu()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $this->setear($row['idmenu'],$row['menombre'],$row['medescripcion'],$row['idpadre'],$row['mesahabilitado']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Menu->listar: ".$base->getError());
        }
        return $resp;
    }


    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO menu(idmenu,menombre,medescripcion,idpadre,medeshabilitado)  VALUES(".$this->getIDMenu().",'".$this->getMeNombre()."','".$this->getMeDescripcion()."',".$this->getPadre()->getIDMenu().",'".$this->getMeDeshabilitado()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->insertar: ".$base->getError());
        }
        return $resp;
    }


    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE menu SET menombre='".$this->getMeNombre()."',medescripcion='".$this->getMeDescripcion()."',idpadre=".$this->getPadre().",medeshabilitado='".$this->getMeDeshabilitado()."' WHERE idmenu=".$this->getIDMenu()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menu WHERE idmenu=".$this->getIDMenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Menu->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menu ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Menu();

                    $unObjPadre=new Menu();
                    $unObjPadre->setIDMenu($row['idpadre']);
                    $unObjPadre->cargar();

                    $obj->setear($row['idmenu'],$row['menombre'],$row['medescripcion'],$unObjPadre,$row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("Menu->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
}
?>