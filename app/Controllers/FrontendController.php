<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AutoloadModel;
use App\Libraries\Pagination;


class FrontendController extends Controller
{

	protected $helpers = ['mystring','mydatafrontend','renderdata'];
	public $currentTime;
	public $AutoloadModel;
	public $client;
	protected $pagination;
	public $general;
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		$this->AutoloadModel = new AutoloadModel();
		$this->pagination = new Pagination();
		$this->currentTime =  gmdate('Y-m-d H:i:s', time() + 7*3600);

		helper($this->helpers);

		$this->general = get_general();
	}

	public function change_language(){
	}

	public function currentLanguage(){
		$language = (isset($this->general['website_language']) ? $this->general['website_language'] : 'vi');
		if(!isset($_COOKIE['language']) || $_COOKIE['language'] == ''){
			setcookie('language', $language,  8*3600, "/");
		}

		return $language;
		

	}
}
