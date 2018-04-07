<?php
namespace Common\Table\Data\Feed;

use Zend\Db\Adapter\Adapter;
use \Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Common\Table\Data\Feed\Url AS DataStruct;

class UrlTable
{
	private $dbAdapter;
	private $tableGateway;
	private $tableName = 'd_feed_url';
	
    public function __construct($dbAdapter)
    {
    	$this->dbAdapter = $dbAdapter;
    	$resultSetPrototype = new ResultSet();
    	$resultSetPrototype->setArrayObjectPrototype(new DataStruct());
        $this->tableGateway = new TableGateway($this->tableName,
        									   $dbAdapter,
        									   null,
        									   $resultSetPrototype
											   );
    }

	/**
	 * 追加
	 */
	public function insert($blogUrl, $rssUrl, $title)
	{
		$result = $this->dbAdapter->query('INSERT INTO `' . $this->tableName . '` (`blog_url`, `rss_url`, `title`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE cnt=cnt+1, rss_url=?, title=?',
										  array($blogUrl, $rssUrl, $title, $rssUrl, $title)
										  );
	}
		
	/**
	 * 取得
	 */
    public function get($url)
    {
		$dataStruct = new DataStruct();
        $rowset = $this->tableGateway->select(array('blog_url'  => $url));
		$data = $dataStruct->exchangeObject($rowset->current());
        return $data;
    }
}