<?php
class CompraEstado{
    private $idcompraestado;
    private $ObjCompra; //idcompra
    private $ObjCompraEstadoTipo; //idcompraestadotipo
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;


    public function __construct(){
        $this->idcompraestado="";
        $this->ObjCompra=null;
        $this->ObjCompraEstadoTipo=null;
        $this->cefechaini="";
        $this->cefechafin="";
        $this->mensajeoperacion="";
    }

    public function setear($id,$unaCompra,$unEstadoTipo,$fechaIni,$fechaFin){
        $this->setIDCompraEstado($id);
        $this->setObjCompra($unaCompra);
        $this->setObjCompraEstadoTipo($unEstadoTipo);
        $this->setCEFechaIni($fechaIni);
        $this->setCEFechaFin($fechaFin);
    }
    /**
     * 
     */
    public function getIDCompraEstado(){
        return $this->idcompraestado;
    }
    public function setIDCompraEstado($valor){
        $this->idcompraestado=$valor;
    }

    public function getObjCompra(){
        return $this->ObjCompra;
    }
    public function setObjCompra($valor){
        $this->ObjCompra=$valor;
    }

    public function getObjCompraEstadoTipo(){
        return $this->ObjCompraEstadoTipo;
    }
    public function setObjCompraEstadoTipo($valor){
        $this->ObjCompraEstadoTipo=$valor;
    }

    public function getCEFechaIni(){
        return $this->cefechaini;
    }
    public function setCEFechaIni($valor){
        $this->cefechaini=$valor;
    }

    public function getCEFechaFin(){
        return $this->cefechafin;
    }
    public function setCEFechaFin($valor){
        $this->cefechafin=$valor;
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
        $sql="SELECT * FROM compraestado WHERE  idcompraestado= ".$this->getIDCompraEstado()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $unaCompra=new Compra();
                    $unaCompra->setIDCompra($row['idcompra']);
                    $unaCompra->cargar();
                    
                    $unEstadoTipo=new CompraEstadoTipo();
                    $unEstadoTipo->setIDCompraEstadoTipo($row['idcompraestadotipo']);
                    $unEstadoTipo->cargar();
                    
                    $this->setear($row['idcompraitem'],$unaCompra,$unEstadoTipo,$row['cefachaini'],$row['cefechafin']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->listar: ".$base->getError());
        }
        return $resp;
    }


    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestado(idcompraestado,idcompra,idcompraestadotipo,cefechaini,cefechafin)  VALUES(".$this->getIDCompraEstado().",".$this->getObjCompra()->getIDCompra().",".$this->getObjCompraEstadoTipo()->getIDCompraEstadoTipo().",'".$this->getCEFechaIni()."','".$this->getCEFechaFin()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraEstado->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compraestado SET idcompra=".$this->getObjCompra()->getIDCompra().",idcompraestadotipo=".$this->getObjCompraEstadoTipo()->getIDCompraEstadoTipo().",cefechaini='".$this->getCEFechaIni()."',cefechafin='".$this->getCEFechaFin()."' WHERE idcompraestado=".$this->getIDCompraEstado()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraEstado->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestado WHERE idcompraestado=".$this->getIDCompraEstado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("CompraEstado->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->eliminar: ".$base->getError());
        }
        return $resp;
    }


    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new CompraEstado();

                    $unaCompra= new Compra();
                    $unaCompra->setIDProducto($row['idcompra']);
                    $unaCompra->cargar();

                    $unEstadoTipo=new CompraEstadoTipo();
                    $unEstadoTipo->setIDCompraEstadoTipo($row['idcompraestadotipo']);
                    $unEstadoTipo->cargar();

                    $obj->setear($row['idcompraestado'], $unaCompra,$unEstadoTipo,$row['cefechaini'],$row['cefechafin']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("CompraEstado->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

}
?>