<?php
class CompraItem{
    private $idcompraitem;
    private $objProducto; //idProducto
    private $objCompra; //idCompra
    private $cicantidad;
    

    public function __construct(){
        $this->idcompraitem="";
        $this->objProducto=null;
        $this->objCompra=null;
        $this->cicantidad="";
    }


    public function setear($id,$unProducto,$unaCompra,$cantidad){
        $this->setIDCompraItem($id);
        $this->setObjProducto($unProducto);
        $this->setObjCompra($unaCompra);
        $this->setCiCantidad($cantidad);

    }

    public function getIDCompraItem(){
        return $this->idcompraitem;
    }
    public function setIDCompraItem($valor){
        $this->idcompraitem=$valor;
    }

    public function getObjProducto(){
        return $this->objProducto;
    }
    public function setObjProducto($valor){
        $this->objProducto=$valor;
    }

    public function getObjCompra(){
        return $this->objCompra;
    }
    public function setObjCompra($valor){
        $this->objCompra=$valor;
    }

    public function getCiCantidad(){
        return $this->cicantidad;
    }
    public function setCiCantidad($valor){
        $this->cicantidad=$valor;
    }

    public function getmensajeoperacion(){
        return $this->objProducto;
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
        $sql="SELECT * FROM compraitem WHERE  idcompraitem= ".$this->getIDCompraItem()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $unProducto=new Producto();
                    $unProducto->setIDProducto($row['idproducto']);
                    $unProducto->cargar();

                    $unaCompra=new Compra();
                    $unaCompra->setIDCompra($row['idcompra']);
                    $unaCompra->cargar();

                    $this->setear($row['idcompraitem'], $unProducto,$unaCompra,$row['cicantidad']);
                    
                }
            }
        } else {
            $this->setmensajeoperacion("CompraItem->listar: ".$base->getError());
        }
        return $resp;
    }

    public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraitem(idcompraitem,idproducto,idcompra,cicantidad)  VALUES(".$this->getIDCompraItem().",".$this->getObjProducto()->getIDProducto().",".$this->getObjCompra()->getIDCompra().",".$this->getCiCantidad().");";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraItem->insertar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraItem->insertar: ".$base->getError());
        }
        return $resp;
    }


    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compraitem SET idproducto=".$this->getObjProducto()->getIDProducto().",idcompra=".$this->getObjCompra()->getIDCompra().",cicantidad=".$this->getCiCantidad()." WHERE idcompraitem=".$this->getIDCompraItem()."";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("CompraItem->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraItem->modificar: ".$base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraitem WHERE idcompraitem=".$this->getIDCompraItem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("CompraItem->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("CompraItem->eliminar: ".$base->getError());
        }
        return $resp;
    }


    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new CompraItem();

                    $unProducto= new Producto();
                    $unProducto->setIDProducto($row['idproducto']);
                    $unProducto->cargar();

                    $unaCompra=new Compra();
                    $unaCompra->setIDCompra($row['idcompra']);
                    $unaCompra->cargar();

                    $obj->setear($row['idcompraitem'], $unProducto,$unaCompra,$row['cicantidad']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            //$this->setmensajeoperacion("CompraItem->listar: ".$base->getError());
        }
 
        return $arreglo;
    }
}
?>