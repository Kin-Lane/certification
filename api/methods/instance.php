<?php						
	
$route = '/certification/:certification_id/';	
$app->delete($route, function ($certification_id) use ($app){
	
	$Add = 1;
	$ReturnObject = array();
	
 	$request = $app->request(); 
 	$_POST = $request->params();	

	$query = "DELETE FROM certification WHERE ID = " . $certification_id;
	//echo $query . "<br />";
	mysql_query($query) or die('Query failed: ' . mysql_error());	

	});		
		
?>