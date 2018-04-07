<?php
namespace Common\Table\Data\Feed;

class Url
{
	public $blogUrl;
	public $rssUrl;
	public $title;
	public $cnt;
	public $updateDate;

	public function exchangeArray($data)
	{
		$this->blogUrl		= (isset($data['blog_url'])) ? $data['blog_url'] : '';
		$this->rssUrl		= (isset($data['rss_url'])) ? $data['rss_url'] : '';
		$this->title		= (isset($data['title'])) ? $data['title'] : '';
		$this->cnt			= (isset($data['cnt'])) ? $data['cnt'] : 0;
		$this->updateDate	= (isset($data['update_date'])) ? $data['update_date'] : '0000-00-00';
	}
	
	public function exchangeObject($obj)
	{
		$data = array('blog_url'	=> $obj->blogUrl,
					  'rss_url'		=> $obj->rssUrl,
					  'title'		=> $obj->title,
					  'cnt'			=> $obj->cnt,
					  'update_date'	=> $obj->updateDate
					  );
		return $data;
	}
}
