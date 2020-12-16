<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AutoloadModel;

class FrontendController extends Controller
{

	protected $helpers = ['mystring'];
	public $currentTime;
	public $AutoloadModel;
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);
		$this->AutoloadModel = new AutoloadModel();
		$this->currentTime =  gmdate('Y-m-d H:i:s', time() + 7*3600);
		helper($this->helpers);
	}
}
