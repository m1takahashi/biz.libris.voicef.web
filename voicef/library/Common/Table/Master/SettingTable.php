<?php
namespace Common\Table\Master;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Common\Table\Master\Setting AS DataStruct;

class SettingTable
{
	private $dbAdapter;
	private $tableGateway;
	private $tableName = 'm_setting';
	
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
	 * 編集
	 * 1レコードしかないので、固定
	 */
	public function update($params)
	{
		$this->tableGateway->update($params, array('id'  => 1));
	}

	/**
	 * 取得
	 */
    public function get()
    {
		$dataStruct = new DataStruct();
        $rowset = $this->tableGateway->select(array('id'  => 1));
		$data = $dataStruct->exchangeObject($rowset->current());
        return $data;
    }

	private function toArray($resultSet)
	{
		$list = array();
		$dataStruct = new DataStruct();
		foreach ($resultSet as $item) {
			$list[] = $dataStruct->exchangeObject($item);
		}
		return $list;
	}
}