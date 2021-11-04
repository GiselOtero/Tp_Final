<?php
class CompraEstadoTipo{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompraestadotipo="";
        $this->cetdescripcion="";
        $this->cetdetalle="";
        $this->mensajeoperacion="";
    }

    public function setear($id,$descripcion,$detalle){
        $this->setIDCompraEstadoTipo($id);
        $this->setCETDescripcion($descripcion);
        $this->setCETDetalle($detalle);
    }

    public function getIDCompraEstadoTipo(){
        return $this->idcompraestadotipo;
    }
    public function setIDCompraEstadoTipo($valor){
        $this->idcompraestadotipo=$valor;
    }

    public function getCETDescripcion(){
        return $this->cetdescripcion;
    }
    public function setCETDescripcion($valor){
        $this->cetdescripcion=$valor;
    }

    public function getCETDetalle(){
        return $this->cetdetalle;
    }
    public function setCETDetalle($valor){
        $this->cetdetalle=$valor;
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
        $sql="SELECT * FROM compraestadotipo WHERE  idcompraestadotipo= ".$this->getIDCompraEstadoTipo()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $this->setear($row['idcompraestadotipo'],$row['cetdescripcion'],$row['cetdetalle']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("CompraEstadoTipo->listar: ".$base->getError());
        }
        return $resp;
    }


    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestadotipo(idcompraestadotipo,cetdescripcion,cetdetalle)  VALUES(".$this->getIDCompraEstadoTipo().",'".$this->getCETDescripcion()."','".$this->getCETDetalle()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraEstadoTipo->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstadoTipo->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compraestadotipo SET cetdescripcion='".$this->getCETDescripcion()."',cetdetalle='".$this->getCETDetalle()."' WHERE idcompraestadotipo=".$this->getIDCompraEstadoTipo()."";
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
        $sql="DELETE FROM compraestadotipo WHERE idcompraestadotipo=".$this->getIDCompraEstadoTipo();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("CompraEstadoTipo->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstadoTipo->eliminar: ".$base->getError());
        }
        return $resp;
    }


    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestadotipo ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new CompraEstadoTipo();


                    $obj->setear($row['idcompraestadotipo'],$row['cetdescripcion'],$row['cetdetalle']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("CompraEstadoTIpo->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
}
?>