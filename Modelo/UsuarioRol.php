<?php
class UsuarioRol{
    private $idusuario;
    private $idrol;
    private $mensajeoperacion;
    

    public function __construct(){
        $this->objUsuario=null;
        $this->objRol=null;
        $this->mensajeoperacion="";
    }

    public function setear($menu,$rol){
        $this->setObjUsuario($menu);
        $this->setObjRol($rol);
    }

    public function getObjUsuario(){
        return $this->objUsuario;
    }
    public function setObjUsuario($valor){
        $this->objUsuario=$valor;
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
        $sql="SELECT * FROM usuariorol WHERE  idusuario= ".$this->getObjUsuario()->getIDUsuario()." AND idrol=".$this->getObjRol()->getIDRol()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();

                    $unUsuario= new Usuario();
                    $unUsuario->setIDUsuario($row['idusuario']);
                    $unUsuario->cargar();

                    $unRol=new Rol();
                    $unRol->setIDRol($row['idrol']);
                    $unRol->cargar();

                    $this->setear($unUsuario,$unRol);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuariorol(idusuario,idrol)  VALUES(".$this->getObjUsuario()->getIDUsuario().",".$this->getObjRol()->getIDRol().");";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE usuariorol SET idusuario=".$this->getObjUsuario()->getIDUsuario().",idrol=".$this->getObjRol()->getIDRol()." WHERE idusuario=".$this->getObjUsuario()->getIDUsuario()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("UsuarioRol->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idusuario=".$this->getObjUsuario()->getIDUsuario()." AND idrol=".$this->getObjRol()->getIDRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("UsuarioROL->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("UsuarioROL->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new UsuarioRol();

                    $unUsuario= new Usuario();
                    $unUsuario->setIDUsuario($row['idusuario']);
                    $unUsuario->cargar();

                    $unRol=new Rol();
                    $unRol->setIDRol($row['idrol']);
                    $unRol->cargar();

                    $obj->setear($unUsuario,$unRol);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
}
?>