<?php
namespace Common\Util;

class DateUtils
{
	/**
	 * 年一覧取得
	 */
	public static function getYearList($start = 1990, $end = 2024)
	{
		if ($start > $end) {
			return;
		}
		for ($i = $start; $i <= $end; $i++) {
			$list[ $i ] = $i;
		}
		return $list;
	}
	
	/**
	 * 月一覧取得
	 */
	public static function getMonthList()
	{
		for ($i = 1; $i <= 12; $i++) {
			$list[ $i ] = $i;
		}
		return $list;		
	}
	
	/**
	 * 日一覧取得
	 */
	public static function getDayList()
	{
		for ($i = 1; $i <= 31; $i++) {
			$list[ $i ] = $i;
		}
		return $list;				
	}
}

