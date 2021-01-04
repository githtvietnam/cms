<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AutoloadModel;

class FrontendController extends Controller
{

	protected $helpers = ['mystring','mydatafrontend','renderdata'];
	public $currentTime;
	public $AutoloadModel;
	public $client;
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		$this->AutoloadModel = new AutoloadModel();
		$this->currentTime =  gmdate('Y-m-d H:i:s', time() + 7*3600);
		
		helper($this->helpers);
	}

	public function currentLanguage(){
		$this->AutoloadModel = new AutoloadModel();
		$this->defaulLanguage = $this->AutoloadModel->_get_where([
			'select' => 'canonical',
			'table' => 'language',
			'where' => ['default' => 1]
		]);
		return $this->defaulLanguage['canonical'];
	}
}
