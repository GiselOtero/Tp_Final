<?php
class AbmProducto{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Producto
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idproducto',$param) and array_key_exists('pronombre',$param) and array_key_exists('prodetalle',$param) and array_key_exists('procantstock',$param)){
            //echo "Crear Obj";
            $obj = new Producto();
            $obj->setear($param['idproducto'], $param['pronombre'],$param['prodetalle'],$param['procantstock']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Producto
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo "cargarConClave";
        print_r($param); */
        if(isset($param['idproducto']) ){
            $obj = new Producto();
            $obj->setear($param['idproducto'],null, null,null);
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
        if (isset($param['idproducto']))
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
        //$param['idproducto'] =null;
        $unObjProducto = $this->cargarObjeto($param);
        /* echo "\nAlta";
        verEstructura($unObjProducto); */
        if ($unObjProducto!=null and $unObjProducto->insertar()){
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
            $unObjProducto = $this->cargarObjeto($param);
            //verEstructura($unObjProducto);
            if($unObjProducto!=null and $unObjProducto->modificar()){
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
            if  (isset($param['idproducto']))
                $where.=" and idproducto ='".$param['idproducto']."'";
            /* if  (isset($param['pronombre']))
                 $where.=" and pronombre ='".$param['pronombre']."'";
            if  (isset($param['prodetalle']))
                 $where.=" and prodetalle ='".$param['prodetalle']."'";
                 if  (isset($param['procantstock']))
                 $where.=" and procantstock ='".$param['procantstock']."'"; */
        }
        $arreglo = Producto::listar($where);  
        return $arreglo; 
    }
}
?>