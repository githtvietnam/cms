<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AutoloadModel;
use App\Libraries\Authentication;
use App\Libraries\Pagination;

class FrontendController extends Controller
{

	protected $helpers = ['form','url','myauthentication','mystring','mydata','nestedtset', 'myurl', 'myinsert'];
	public $currentTime;
	public $AutoloadModel;
	protected $auth;
	public $request;
	protected $pagination;
	public $authentication;
	public $defaulLanguage;
	public $currentLanguage;
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->AutoloadModel = new AutoloadModel();
		$this->authentication = new Authentication();
		$this->pagination = new Pagination();
		// E.g.:
		// $this->session = \Config\Services::session();
		// $this->db = \Config\Database::connect();
		$this->request = \Config\Services::request();

		//
		$this->currentTime =  gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->auth = $this->authentication->check_auth();
		$this->currentLanguage = $this->AutoloadModel->_get_where([
			'select' => 'canonical',
			'table' => 'language',
			'where' => ['default' => 1]
		]);
		helper($this->helpers);
	}

	//--------------------------------------------------------------------
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
