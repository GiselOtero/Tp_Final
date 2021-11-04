<?php
class AbmCompraItem{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idcompraitem',$param) and array_key_exists('idproducto',$param) and array_key_exists('idcompra',$param) and array_key_exists('cicantidad',$param)){
            //echo "Crear Obj";
            $obj = new CompraItem();

            
            $objAbmProducto=new AbmProducto();
            $listaProducto=$objAbmProducto->buscar($param['idproducto']);
             
            $objAbmCompra=new AbmCompra();
            $listaCompra=$objAbmCompra->buscar($param['idcompra']);
            
            

            $obj->setear($param['idcompraitem'],$listaProducto[0],$listaCompra[0],$param['cicantidad']);
            /* $obj->setear($param['idcompraitem'], $param['idproducto'],$param['idcompra'],$param['cicantidad']); */
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return CompraItem
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idcompraitem']) ){
            $obj = new CompraItem();
            $obj->setear($param['idcompraitem'],null, null,null);
            //verEstructura($obj);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        /* echo "seteandoClaves";
        print_r($param); */
        $resp = false;
        if (isset($param['idcompraitem']))
            $resp = true;
        return $resp;
    }


    /* **** */

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        //$param['idcompraitem'] =null;
        $unObjCompraItem = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjCompraItem); */
        if ($unObjCompraItem!=null and $unObjCompraItem->insertar()){
            $resp = true;
        }
        return $resp;
        
    }


     /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        /* print_r($param);
        echo " Modificacion()"; */
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraItem = $this->cargarObjeto($param);
            //verEstructura($unObjCompraItem);
            if($unObjCompraItem!=null and $unObjCompraItem->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        //print_r($param);
        if ($param<>NULL){
            if  (isset($param['idcompraitem']))
                $where.=" and idcompraitem ='".$param['idcompraitem']."'";
            /* if  (isset($param['idproducto']))
                 $where.=" and idproducto ='".$param['idproducto']."'";
            if  (isset($param['idcompra']))
                 $where.=" and idcompra ='".$param['idcompra']."'"; */
        }
        $arreglo = CompraItem::listar($where);  
        return $arreglo; 
    }
}
?>