<?php
abstract class Kgi_App{
    public $input = null;
    public $output = null;
    public $doc = null;
    public $name = '';
    //public $runtimeLog = null;
    //public $actionLog = null;
    public $tpl = null;
    public $outputFormat = null;
    public $code = 0;

    public function setOutputFormat($of){
        $this->outputFormat = strtolower($of);
    }

    public function getOutputFormat(){
        if(isset($this->outputFormat))
            return $this->outputFormat;

        $of = $this->input->get('of');

        if(is_null($of))
            $of = 'htm';
        else
            $of = strtolower($of);

        return $of;
    }

    protected function preExecute(){

        //step 0. initialize log component && doc
        $this->doc = new Kgi_Document();

        //step 1. initialize input component from request method
        
        if(!isset($_SERVER['REQUEST_METHOD']))
            $_SERVER['REQUEST_METHOD'] = 'CONSOLE';

        $_SERVER['REQUEST_METHOD'] = strtoupper($_SERVER['REQUEST_METHOD']);

        switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            $this->input = Kgi_Helper_Factory::create(Kgi_Helper_Factory::INPUT_GET);
            break;
        case 'POST':
            if(strcasecmp($_SERVER['CONTENT_TYPE'], 'application/x-amf') == 0)
                $this->input = Kgi_Helper_Factory::create(Kgi_Helper_Factory::INPUT_POST_IN_AMF);
            else
                $this->input = Kgi_Helper_Factory::create(Kgi_Helper_Factory::INPUT_POST);
            break;
        default:
            $this->input = Kgi_Helper_Factory::create(Kgi_Helper_Factory::INPUT_CONSOLE);
            break;
        }


        $outputFormat = $this->getOutputFormat();

        
        switch($outputFormat){
        case 'json':
            $this->output = Kgi_Helper_Factory::create(Kgi_Helper_Factory::OUTPUT_JSON);
            break;
        // case 'xml':
        //     $this->output = Kgi_Helper_Factory::create(Kgi_Helper_Factory::OUTPUT_XML);
        //     break;
        // case 'amf':
        //     $this->output = Kgi_Helper_Factory::create(Kgi_Helper_Factory::OUTPUT_AMF);
        //     break;
        // case 'img':
        //     $this->output = Kgi_Helper_Factory::create(Kgi_Helper_Factory::OUTPUT_IMG);
        //     break;
        default:
            $this->output = Kgi_Helper_Factory::create(Kgi_Helper_Factory::OUTPUT_HTML);
            break;
        }

        $this->tpl = str_replace('.', '/', $this->name);

        switch($outputFormat){
        case 'json':
            break;
        // case 'xml':
        //     $this->tpl .= '.xml';
        //     break;
        default:
            $this->tpl .= '.php';
            break;
        }
    }

    protected function postExecute(){
    }

    protected abstract function execute();

    public function run(){
        $this->preExecute();
        $this->execute();
        $this->postExecute();
    }
}
