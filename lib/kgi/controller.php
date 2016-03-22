<?php
namespace Kgi;
abstract class Controller{
    protected $input = null;
    protected $output = null;
    protected $doc = null;
    protected $name = '';
    //protected $runtimeLog = null;
    //protected $actionLog = null;
    protected $tpl = null;
    protected $outputFormat = null;
    protected $code = 0;

	
	public function __construct(){
	}

	public function getInput($key,$regex = null, $default = null, $filtType = Helper\Input\Abs::TYPE_FILT_VALIDATE){
		return $this->input->get($key, $regex, $default, $filtType);
	}

	public function getCookie($key, $regex = null, $default = null){
		if( !isset($_COOKIE[$key]) )
			return isset($default) ? $default : null;
		if( isset($regex)){
			preg_match($regex, $_COOKIE[$key], $matches);
			if(! isset($matches[0]))
				return $default;
			return $matches[0];			
		}
			
		return $_COOKIE[$key];
	}

	protected function isPost() {
		return strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0;
	}
	
	public function assign($varName,$value){		
		$this->doc->data[$varName] = $value;
	}

	public function setSwap($key, $data){
		$this->doc->swapData[$key] = $data;
	}

	public function getSwap($key){
		return isset($this->doc->swapData[$key]) ? $this->_app->doc->swapData[$key] : null;
	}
	
	public function getTpl(){
		return APP_ROOT.'/tpl/'.$this->tpl;
	}

	public function setTpl($tpl){
		return $this->tpl = $tpl;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		return $this->name = $name;
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

	public function setOutputFormat($of){
        $this->outputFormat = strtolower($of);
    }

	public function code($code){
		return $this->code = $code;
	}

    public function render(){
        if($this->getOutputFormat() == 'json'){
            $output = array_merge(array('code' => $this->code), $this->doc->toArray());
            echo json_encode($output);
        }else{
            $this->_renderTpl();
        }
    }

    protected function _renderTpl(){
        foreach($this->doc->data as $var => $value){
            $$var = $value;
        }
        $tpl = array('path' => $this->getTpl());
        require  APP_ROOT.'/tpl/include/body.php';
    }	

    protected function beforeActionExecute(){
        //step 0. initialize log component && doc
        $this->doc = new Document();

        //step 1. initialize input component from request method
        
        if(!isset($_SERVER['REQUEST_METHOD']))
            $_SERVER['REQUEST_METHOD'] = 'CONSOLE';

        $_SERVER['REQUEST_METHOD'] = strtoupper($_SERVER['REQUEST_METHOD']);

        switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            $this->input = Helper\Factory::create(Helper\Factory::INPUT_GET);
            break;
        case 'POST':
            if(strcasecmp($_SERVER['CONTENT_TYPE'], 'application/x-amf') == 0)
                $this->input = Helper\Factory::create(Helper\Factory::INPUT_POST_IN_AMF);
            else
                $this->input = Helper\Factory::create(Helper\Factory::INPUT_POST);
            break;
        default:
            $this->input = Helper\Factory::create(Helper\Factory::INPUT_CONSOLE);
            break;
        }


        $outputFormat = $this->getOutputFormat();

        
        switch($outputFormat){
        case 'json':
            $this->output = Helper\Factory::create(Helper\Factory::OUTPUT_JSON);
            break;
        // case 'xml':
        //     $this->output = Helper\Factory::create(Helper\Factory::OUTPUT_XML);
        //     break;
        // case 'amf':
        //     $this->output = Helper\Factory::create(Helper\Factory::OUTPUT_AMF);
        //     break;
        // case 'img':
        //     $this->output = Helper\Factory::create(Helper\Factory::OUTPUT_IMG);
        //     break;
        default:
            $this->output = Helper\Factory::create(Helper\Factory::OUTPUT_HTML);
            break;
        }

		switch($outputFormat){
			case 'json':
				break;
				// case 'xml':
				//     $this->tpl .= '.xml';
				//     break;
			default:
				$this->tpl .= str_replace('.', '/', $this->name) . '.php';
				break;
		}
    }

    protected function afterActionExecute(){
    }


	public function run($action = ''){
		$this->beforeActionExecute();	
		if(!$action){
			$action = 'index';
		}
		$this->$action();
		$this->afterActionExecute();	
		$this->render();
	}
}
