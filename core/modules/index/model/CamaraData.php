<?php
class CamaraData {
	public static $tablename = "camara";


	public function CamaraData(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function getBook(){ return BookData::getById($this->book_id); }


	public function add(){
		$sql = "insert into camara (codigo,modelo,book_id) ";
		$sql .= "value (\"$this->codigo\",\"$this->modelo\",\"$this->book_id\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set code=\"$this->codigo\",modelo=\"$this->modelo\" where id=$this->id";
		Executor::doit($sql);
	}




	}






	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CamaraData());
	}

	public static function countByBookId($id){
		$sql = "select count(*) as c from ".self::$tablename." where book_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CamaraData());
	}

	public static function countAvaiableByBookId($id){
		$sql = "select count(*) as c from ".self::$tablename." where book_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CamaraData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CamaraData());
	}
	
	public static function getAllByBookId($id){
		$sql = "select * from ".self::$tablename." where book_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CamaraData());
	}

	public static function getAvaiableByBookId($id){
		$sql = "select * from ".self::$tablename." where book_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CamaraData());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CamaraData());
	}


}

?>