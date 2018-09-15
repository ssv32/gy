<?class db{
	
	$type_db = GY_TYPE_DB; // используемый тип БД // название класса

	/*
	 * запрос к БД
	 */
	function query( $type_db, $query ){
		$type_db::query($query);
	}

	function select(){
		query()
	}

}?>