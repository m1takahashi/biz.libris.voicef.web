<?php
namespace Common\Table\Log;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Common\Table\Log\Log AS DataStruct;
use \Zend\Db\Sql\Expression;
use \Zend\Log\Writer\Db;

class LogTable
{
	private $tableGateway;
	private $tableName = 'l_log';

    public function __construct($dbAdapter)
    {
    	$resultSetPrototype = new ResultSet();
    	$resultSetPrototype->setArrayObjectPrototype(new DataStruct());
        $this->tableGateway = new TableGateway($this->tableName,
        									   $dbAdapter,
        									   null,
        									   $resultSetPrototype
											   );
	}

	/**
	 * 一覧取得（新しい順）
	 */
    public function getList($priority = '', $limit = 100, $offset = 0)
    {
 		$select = $this->tableGateway->getSql()->select();
		if (!empty($priority)) {
			$select->where(array('priority' => $priority));			
		}
		$select->order('id DESC');
		if ($limit) {
			$select->limit($limit);
		}
    	$resultSet = $this->tableGateway->select($select);		
        $resultSet->buffer();
        return $this->toArray($resultSet);
    }

	public function toArray($resultSet)
	{
		$list = array();
		$dataStruct = new DataStruct();
		foreach ($resultSet as $item) {
			$list[] = $dataStruct->exchangeObject($item);
		}
		return $list;
	}
}