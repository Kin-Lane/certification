<?php
$route = '/certification/tags/:tag';
$app->delete($route, function ($tag)  use ($app){

	$ReturnObject = array();
	
 	$request = $app->request(); 
 	$params = $request->params();	

	$Query = "SELECT t.Tag_ID, t.Tag FROM tags WHERE Tag = '" . trim(mysql_real_escape_string($tag)) . "'";

	$TagResult = mysql_query($LinkQuery) or die('Query failed: ' . mysql_error());
		
	if($TagResult && mysql_num_rows($TagResult))
		{	
		$Tag = mysql_fetch_assoc($TagResult);
		$Tag_ID = $Tag['Tag_ID'];
		$Tag_Text = $Tag['Tag'];

		$DeleteQuery = "DELETE FROM certification_tag_pivot WHERE Tag_ID = " . $Tag_ID;
		$DeleteResult = mysql_query($DeleteQuery) or die('Query failed: ' . mysql_error());
			
		$F = array();
		$F['tag_id'] = $Tag_ID;
		$F['tag'] = $Tag_Text;
		$F['certification_count'] = 0;
		
		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo format_json(json_encode($ReturnObject));
	});
?>