<?php

namespace Hcode;

use Rain\tpl;

class Page{

private $tpl;
private $options = [];
private $defausts = [
    "data"=>[]
];

    public function __construct($opts = array(), $tpl_dir = "/views/"){
        $this->option = array_merge($this->defausts, $opts);

        // config
	$config = array(
        "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
        "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
        "debug"         => false // set to false to improve the speed
       );

        Tpl::configure( $config );
        $this->tpl = new Tpl;
        $this->setData($this->options["data"]);
        $this->tpl->draw("header");

        foreach($this->options["data"] as $key => $value){
            $this->tpl->assign($key, $value);
        }

        $this->tpl->draw("header");
    }

    private function setData($data = array()){
        foreach($data as $key => $value){
            $this->tpl->assign($key, $value);
    }
}

    public function setTpl($name, $data = array(), $returnHTML = false){

       $this->setData($data);
       return $this->tpl->draw($name, $returnHTML);
        }

    
    public function __destruct(){
        $this->tpl->draw("footers");
    }
}
