<?php
namespace Home\Model;
use Think\Model;
class TeaSettingsModel extends Model {
	public function showAll(){
		$data = $this -> select();
		$result = array();
		foreach ($data as $row ) {
			$result[ $row['key']] = $row['val'];
		}		
		return $result;
	}
} 