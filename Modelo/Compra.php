<?php
class Compra{
    private $idcompra;
    private $cofecha; //
    private $objUsuario; //idusuario
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompra="";
        $this->cofecha=null;
        $this->objUsuario=null;
        $this->mensajeoperacion="";
    }


    public function setear($id,$fecha,$unUsuario){
        $this->setIDCompra($id);
        $this->setCoFecha($fecha);
        $this->setObjUsuario($unUsuario);

    }
    
    /**
     * 
     */
    public function getIDCompra(){
        return $this->idcompra;
    }
    public function setIDCompra($valor){
        $this->idcompra=$valor;
    }

    public function getCoFecha(){
        return $this->cofecha;
    }
    public function setCoFecha($valor){
        $this->cofecha=$valor;
    }

    public function getObjUsuario(){
        return $this->objUsuario;
    }
    public function setObjUsuario($valor){
        $this->objUsuario=$valor;
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
        $sql="SELECT * FROM compra WHERE idcompra = ".$this->getIDCompra()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();

                    $unUsuario = new Usuario();
                    $unUsuario->setIDUsuario($row['idusuario']);
                    $unUsuario->cargar();

                    $this->setear($row['idcompra'], $row['cofecha'],$unUsuario);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $resp;
    }


    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compra(idcompra,cofecha,idusuario)  VALUES(".$this->getIDCompra().",'".$this->getCoFecha()."',".$this->getObjUsuario()->getIDUsuario().");";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compra SET cofecha='".$this->getCoFecha()."',idusuario=".$this->getObjUsuario()->getIDUsuario()." WHERE idcompra=".$this->getIDCompra()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compra->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compra WHERE idcompra=".$this->getIDCompra();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Compra->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compra->eliminar: ".$base->getError());
        }
        return $resp;
    }


    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compra ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Compra();

                    $unUsuario= new Usuario();
                    $unUsuario->setIDUsuario($row['idusuario']);
                    $unUsuario->cargar();

                    $obj->setear($row['idcompra'], $row['cofecha'],$unUsuario);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $arreglo;
    }
}
?>