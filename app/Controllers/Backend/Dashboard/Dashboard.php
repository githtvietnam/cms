<?php 
namespace App\Controllers\Backend\Dashboard;
use App\Controllers\BaseController;

class Dashboard extends BaseController{

	protected $data;

	public function __construct(){
		$this->data = [];
	}

	

	public function index($id = 0, $page = 0){
		$this->data['articleList'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb1.viewed,  tb2.title , tb1.image',
			'table' => 'article as tb1',
			'where' => [
				'tb1.deleted_at' => 0,
				'tb1.publish' => 1
			],
			'join' => [
				[
					'article_translate as tb2','tb1.id = tb2.objectid AND tb2.module="article" AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
				],
			],
			'limit' => 10,
			'order_by'=> 'tb1.created_at desc',
			'group_by' => 'tb1.id'
		], TRUE);
		$this->data['tourList'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb1.viewed,  tb2.title, tb1.price, tb1.price_promotion , tb1.album',
			'table' => 'tour as tb1',
			'where' => [
				'tb1.deleted_at' => 0,
				'tb1.publish' => 1
			],
			'join' => [
				[
					'tour_translate as tb2','tb1.id = tb2.objectid AND tb2.module="tour" AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
				],
			],
			'limit' => 10,
			'order_by'=> 'tb1.created_at desc',
			'group_by' => 'tb1.id'
		], TRUE);
		$this->data['contactList'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb1.phone,  tb2.title, tb1.email, tb2.fullname, tb2.content, tb2.address, tb1.created_at',
			'table' => 'contact as tb1',
			'where' => [
				'tb1.deleted_at' => 0,
				'tb1.publish' => 1
			],
			'join' => [
				[
					'contact_translate as tb2','tb1.id = tb2.objectid AND tb2.module="contact" AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
				],
			],
			'limit' => 10,
			'order_by'=> 'tb1.created_at desc',
			'group_by' => 'tb1.id'
		], TRUE);

		$this->data['template'] = 'backend/dashboard/home/index';
		return view('backend/dashboard/layout/home', $this->data);
	}
}
