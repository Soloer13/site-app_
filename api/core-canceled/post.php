<<?php 

/**
 * 
 */
class Post extends AnotherClass
{
	//db stuff
	private $conn;
	private $table = 'posts';

	//post properties
	public $id;
	public $category_id;
	public $category_name;
	public $title;
	public $body;
	public $auther;
	public $created_at
	
	//constructor with db connection
	public function __construct($db)
	{
		$this->conn = $db;
	}

	//gets from db
	public function read(){
		//create read query
		$query = 'SELECT 
		c.name  as category_name,
		p.id,
		p.title,
		p.body,
		p.auther,
		p.created_at
		from
		' .this->table .' p
		LEFT join
			catergories c on p.category_id=c.id
		ORDERED BY p.created_at DESC'


		//prepare statement
		$stmt = $this->conn->prepare($query);
		//excute query
		$stmt->execute();

		return $stmt;
	}


}

 ?>