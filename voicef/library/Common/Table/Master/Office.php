<?php
namespace Common\Table\Master;

class Office
{
	public $id;
	public $name;
	public $nameKana;
	public $url;
	public $seq;
	public $comment;
	
	public function exchangeArray($data)
	{
		$this->id		= (isset($data['id'])) ? $data['id'] : 0;
		$this->name		= (isset($data['name'])) ? $data['name'] : '';
		$this->nameKana	= (isset($data['name_kana'])) ? $data['name_kana'] : '';
		$this->url		= (isset($data['url'])) ? $data['url'] : '';
		$this->seq		= (isset($data['seq'])) ? $data['seq'] : 0;
		$this->comment	= (isset($data['comment'])) ? $data['comment'] : '';
	}
	
	public function exchangeObject($obj)
	{
		$data = array('id'			=> $obj->id,
					  'name'		=> $obj->name,
					  'name_kana'	=> $obj->nameKana,
					  'url'			=> $obj->url,
					  'seq'			=> $obj->seq,
					  'comment'		=> $obj->comment					  
					  );
		return $data;
	}
}