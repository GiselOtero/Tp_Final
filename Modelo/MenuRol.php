<?php
class MenuRol{
    private $objMenu; //idmenu;
    private $objRol; //idrol;
    private $mensajeoperacion;

    public function __construct(){
        $this->objMenu=null;
        $this->objRol=null;
        $this->mensajeoperacion="";
    }

    public function setear($menu,$rol){
        $this->setObjMenu($menu);
        $this->setObjRol($rol);
    }

    public function getObjMenu(){
        return $this->objMenu;
    }
    public function setObjMenu($valor){
        $this->objMenu=$valor;
    }


    public function getObjRol(){
        return $this->objRol;
    }
    public function setObjRol($valor){
        $this->objRol=$valor;
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
        $sql="SELECT * FROM menurol WHERE  idmenu= ".$this->getObjMenu()->getIDMenu()." AND idrol=".$this->getObjRol()->getIDRol()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();

                    $unMenu= new Menu();
                    $unMenu->setIDMenu($row['idmenu']);
                    $unMenu->cargar();

                    $unRol=new Rol();
                    $unRol->setIDRol($row['idrol']);
                    $unRol->cargar();

                    $this->setear($unMenu,$unRol);
                    
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
        $sql="INSERT INTO menurol(idmenu,idrol)  VALUES(".$this->getObjMenu()->getIDMenu().",".$this->getObjRol()->getIDRol().");";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("MenuRol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE menurol SET idmenu=".$this->getObjMenu()->getIDMenu().",idrol=".$this->getObjRol()->getIDRol()." WHERE idmenu=".$this->getObjMenu()->getIDMenu()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("MenuRol->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuRol->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM MenuRol WHERE idmenu=".$this->getObjMenu()->getIDMenu()." AND idrol=".$this->getObjRol()->getIDRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("MenuROL->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("MenuROL->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new MenuRol();

                    $unMenu= new Menu();
                    $unMenu->setIDMenu($row['idmenu']);
                    $unMenu->cargar();

                    $unRol=new Rol();
                    $unRol->setIDRol($row['idrol']);
                    $unRol->cargar();

                    $obj->setear($unMenu,$unRol);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

}
?>