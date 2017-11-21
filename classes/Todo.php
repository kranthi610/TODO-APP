<?php

class Todo{
	public static function Additem($item,$id){
		$query = "(item, user_id) VALUES ('$item', '$id')";
		DB::query('insert','todo',$query);
		echo "done";
	}

	public static function displayItem($id){
		$query = 'where user_id="'.$id.'" order by id';
    	$result = DB::query('select','todo',$query);
    	return $result;
	} 

	public static function Deleteitem($id){
		$query = 'where id="'.$id.'"';
     	DB::query('delete','todo',$query);
 
	}
}
