<?php
require_once "./lib/File.php";

//vérifie si l'url correspond au format index.php?controller=...&action=...
if (isset($_GET['controller']) && isset($_GET['action']))
{
	$controller = 'Controller'.ucfirst($_GET['controller']);
	$filename = 'controller/'.$controller.'.php';
	if(file_exists($filename))
	{
		require_once File::build_path(array('controller',$controller.'.php'));
		$action = $_GET['action'];
		if(method_exists($controller,$action))
		{
			$controller::$action();
		}
		else
		{
			require_once File::build_path(array('controller','ControllerAccueil.php'));
			ControllerAccueil::afficher();//si l'URL ne correspond à aucun controller ou aucune action, afficher la page d'accueil
		}
	}
	else
	{
		require_once File::build_path(array('controller','ControllerAccueil.php'));
		ControllerAccueil::afficher();//si l'URL ne correspond à aucun controller ou aucune action, afficher la page d'accueil
	}
}
else
{
	require_once File::build_path(array('controller','ControllerAccueil.php'));
	ControllerAccueil::afficher();//si l'URL ne correspond à aucun controller ou aucune action, afficher la page d'accueil
}