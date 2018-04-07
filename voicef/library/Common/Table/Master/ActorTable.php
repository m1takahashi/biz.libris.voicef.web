<?php
namespace Common\Table\Master;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Common\Table\Master\Actor AS DataStruct;

class ActorTable
{
	private $dbAdapter;
	private $tableGateway;
	private $tableName = 'm_actor';
	
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
	public function insert($params)
	{
    	$this->tableGateway->insert($params);
	}
	
	/**
	 * 編集
	 */
	public function update($id, $params)
	{
		$this->tableGateway->update($params, array('id'  => $id));
	}

	/**
	 * 削除
	 */
    public function delete($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }	
	
	/**
	 * 取得
	 */
    public function get($id)
    {
		$dataStruct = new DataStruct();
        $rowset = $this->tableGateway->select(array('id'  => $id));
		$data = $dataStruct->exchangeObject($rowset->current());
        return $data;
    }

	/**
	 * 一覧取得
	 */
    public function getList($where, $limit = null, $notWhere = null)
    {
 		$select = $this->tableGateway->getSql()->select();
		// Where
		foreach ($where as $key => $val) {
			$select->where("$key = '$val'");
		}
		// Not Where
		foreach ($notWhere as $key => $val) {
			$select->where("$key != '$val'");
		}
//		$select->order('seq ASC'); // 並び順
		$select->order('id ASC'); // 基本五十音順にならんでいる
		if ($limit) {
			$select->limit($limit);
		}
		$resultSet = $this->tableGateway->selectWith($select);
		$list = $this->toArray($resultSet->buffer());		
        return $list;
	}
	
	/**
	 * キーワード検索
	 * 名前（ひらがな）Like検索
	 */
	public function searchKeyword($keyword) 
	{
 		$select = $this->tableGateway->getSql()->select();
		$select->where->like('name_kana', "%$keyword%");		
		$select->where($spec);
		$resultSet = $this->tableGateway->selectWith($select);
		$list = $this->toArray($resultSet->buffer());		
        return $list;		
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