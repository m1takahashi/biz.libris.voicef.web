<?php
namespace Common\Table\Master;

class Actor
{
	public $id;
	public $name;
	public $nameKana;
	public $syllabaryCategory;
	public $syllabary;
	public $officeId;
	public $officialUrl;
	public $blogTitle;
	public $blogUrl;
	public $rssUrl;
	public $twitterUrl;
	public $birthdayRaw;
	public $birthplaceRaw;
	public $bloodtype;
	public $hobby;
	public $filmograhies;

	private $dispSyllabaryCategoryList =array('a'  => 'あ',
										      'ka' => 'か',
										      'sa' => 'さ',
										      'ta' => 'た',
										      'na' => 'な',
										      'ha' => 'は',
										      'ma' => 'ま',
										      'ya' => 'や',
										      'ra' => 'ら',
										      'wa' => 'わ'
											  );
											  
	private $dispBloodtypeList =array(''  => '--',
									  'A' => 'A',
									  'B' => 'B',
									  'AB' => 'AB',
									  'O' => 'O'
									  );

	public function exchangeArray($data)
	{
		$this->id					= (isset($data['id'])) ? $data['id'] : 0;
		$this->name					= (isset($data['name'])) ? $data['name'] : '';
		$this->nameKana				= (isset($data['name_kana'])) ? $data['name_kana'] : '';
		$this->syllabaryCategory	= (isset($data['syllabary_category'])) ? $data['syllabary_category'] : '';
		$this->syllabary			= (isset($data['syllabary'])) ? $data['syllabary'] : '';
		$this->officeId				= (isset($data['office_id'])) ? $data['office_id'] : '';
		$this->officialUrl			= (isset($data['official_url'])) ? $data['official_url'] : '';
		$this->blogTitle			= (isset($data['blog_title'])) ? $data['blog_title'] : '';
		$this->blogUrl				= (isset($data['blog_url'])) ? $data['blog_url'] : '';
		$this->rssUrl				= (isset($data['rss_url'])) ? $data['rss_url'] : '';
		$this->twitterUrl			= (isset($data['twitter_url'])) ? $data['twitter_url'] : '';
		$this->birthdayRaw			= (isset($data['birthday_raw'])) ? $data['birthday_raw'] : '';
		$this->birthplaceRaw		= (isset($data['birthplace_raw'])) ? $data['birthplace_raw'] : '';
		$this->bloodtype			= (isset($data['bloodtype'])) ? $data['bloodtype'] : '';
		$this->hobby				= (isset($data['hobby'])) ? $data['hobby'] : '';
		$this->filmograhies			= (isset($data['filmograhies'])) ? $data['filmograhies'] : '';

	}
	
	public function exchangeObject($obj)
	{
		$data = array('id'					=> $obj->id,
					  'name'				=> $obj->name,
					  'name_kana'			=> $obj->nameKana,
					  'syllabary_category'	=> $obj->syllabaryCategory,
					  'syllabary'			=> $obj->syllabary,
					  'office_id'			=> $obj->officeId,
					  'official_url'		=> $obj->officialUrl,
					  'blog_title'			=> $obj->blogTitle,
					  'blog_url'			=> $obj->blogUrl,
					  'rss_url'				=> $obj->rssUrl,
					  'twitter_url'			=> $obj->twitterUrl,
					  'birthday_raw'		=> $obj->birthdayRaw,		  
					  'birthplace_raw'		=> $obj->birthplaceRaw,		  
					  'bloodtype'			=> $obj->bloodtype,		  
					  'hobby'				=> $obj->hobby,		  
					  'filmograhies'		=> $obj->filmograhies
					  );
		return $data;
	}

	// 五十音カテゴリリスト取得
	public function getDispSyllabaryCategoryList()
	{
		return $this->dispSyllabaryCategoryList;
	}
	
	// 血液型リスト取得
	public function getDispBloodtypeList ()
	{
		return $this->dispBloodtypeList;
	}
}