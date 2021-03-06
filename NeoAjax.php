<?php
/**
 * Created by JetBrains PhpStorm.
 * User: eyapici
 * Date: 09.07.2013
 * Time: 10:04
 * To change this template use File | Settings | File Templates.
 */

class NeoAjax {
    public $js = "";
    public $a = array();
    public $reload = '';

    public function getParam($key){
        $val = isset($_POST[$key]) ? $_POST[$key] : FALSE;
        return $val;
    }
    /**
     * @param $str
     * @return string
     */
    public function strip($str){
        return addcslashes(preg_replace('!\s+!u', ' ',$str),"'");
    }

    /**
     * @param bool $forceGet
     */
    public function reload($forceGet = true){
        $this->reload = $forceGet;
    }
    /**
     * @param $js
     */
    public function script($js){
        $js = str_replace("\r\n" , "" , $js);
        $js = str_replace("\n" , "" , $js);
        $js = trim($js);

        $this->js.= $js;
    }

    /**
     * Set Alert message
     * @param $str
     */
    public function alert($str){
        $this->a[] = $str;
    }

    /**
     * Jquery html function
     * @param $selector
     * @param $html
     */
    public function html($selector, $html){
        $this->js.="$('$selector').html('$html');";
    }
    /**
     * Jquery assignVal function
     * @param $selector
     * @param $html
     */
    public function assignVal($selector, $html){
        $this->js.="$('$selector').val('$html');";
    }
    /**
     *
     * @param $selector
     */
    public function showModal($selector){
        $this->js.="$('$selector').modal('show');";
    }
    /**
     *
     * @param $selector
     */
    public function  hideModal($selector){
        $this->js.="$('$selector').modal('hide').html('');";
    }
    /**
     * Run script
     */
    public function run(){
        header('Content-Type: application/json');
        exit(json_encode(array('s'=>$this->js,'a'=>$this->a,'r'=>$this->reload)));
    }

    /**
     * @return array
     */
    public function getResult(){
        return array('s'=>$this->js,'a'=>$this->a,'r'=>$this->reload);
    }
}