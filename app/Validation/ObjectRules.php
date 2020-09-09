<?php 
namespace App\Validation;
use App\Models\AutoloadModel;
use CodeIgniter\HTTP\RequestInterface;

class ObjectRules {

	protected $AutoloadModel;
	protected $helper = ['mystring'];
	protected $request;

	public function __construct(){
		$this->AutoloadModel = new AutoloadModel();
		$this->request = \Config\Services::request();
		helper($this->helper);

	}

	public function check_canonical(string $canonical = '', string $module = ''): bool{
		$originalCanonical = $this->request->getPost('original_canonical');
		$modulExtract = explode('_', $module);
		$count = 0;
		if($originalCanonical != $canonical){
			$count = $this->AutoloadModel->_get_where([
				'select' => 'objectid',
				'table' => $modulExtract[0].'_translate',
				'where' => ['canonical' => $canonical],
				'count' => TRUE
			]);
		}

		
		if($count > 0){
			return false;
		}
		return true;
 	}

}

