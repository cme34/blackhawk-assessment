<?php
class FooController {
	function barAction() {
		echo "You have accessed barAction in FooController   <br />\n";
	}
}

//This function takes a url with a request and the baseurl of a site, and translates the request into a controller/action pair
function translate($url, $baseurl) {
	//Remove '/' character from the end of the base url if there
	if ($baseurl[strlen($baseurl) - 1] == "/") {
		$baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
	}
	//Get request from url
	$request = substr($url, strlen($baseurl));
	$params = explode("/", $request);
	//Translate url request into a controller/action pair
	array_shift($params); //Removes the whitespace of first
	$controllerName = ucfirst(array_shift($params)) . "Controller";
	$actionName = array_shift($params) . "Action";
	$controller = new $controllerName;
	$controller->$actionName();
}

$url = "https://www.dummyurl.com/foo/bar";
$baseurl = "https://www.dummyurl.com/";
translate($url, $baseurl);
?>