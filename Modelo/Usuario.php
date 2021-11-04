<?php
class Usuario{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensajeoperacion;


    public function __construct(){
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->usdeshabilitado = null;
        $this->mensajeoperacion = "";
    }

    public function setear(){

    }

    public function getIDUsuario(){
        return $this->idusuario;
    }
    public function setIDUsuario($valor){
        $this->idusuario=$valor;
    }

    public function getUsNombre(){
        return $this->usnombre;
    }
    public function setUsNombre($valor){
        $this->usnombre=$valor;
    }

    public function getUsPass(){
        return $this->uspass;
    }
    public function setUsPass($valor){
        $this->uspass=$valor;
    }

    public function getUsMail(){
        return $this->usmail;
    }
    public function setUsMail($valor){
        $this->usmail=$valor;
    }

    public function getUsDeshabilitado(){
        return $this->usdeshabilitado;
    }
    public function setUsDeshabilitado($valor){
        $this->usdeshabilitado=$valor;
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
        $sql="SELECT * FROM usuario WHERE  idusuario= ".$this->getIDUsuario()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $this->setear($row['idusuario'],$row['usnombre'],$row['uspass'],$row['usmail'],$row['usdeshabilitado']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Usuario->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuario(idusuario,usnombre,uspass,usmail,usdeshabilitado)  VALUES(".$this->getIDUsuario().",'".$this->getUsNombre()."','".$this->getUsPass()."','".$this->getUsMail()."','".$this->getUsDeshabilitado()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE usuario SET usnombre='".$this->getUsNombre()."',uspass='".$this->getUsPass()."', usmail='".$this->getUsMail()."', usdeshabilitado='".$this->getUsDeshabilitado()."' WHERE idusuario=".$this->getIDUsuario()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraEstadoTipo->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstadoTipo->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuario WHERE idusuario=".$this->getIDUsuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }

    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Usuario();


                    $obj->setear($row['idusuario'],$row['usnombre'],$row['uspass'],$row['usmail'],$row['usdeshabilitado']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("Usuario->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
}
?>