<?php

namespace App\Controllers;
use ZipArchive;

class MyTestSimul extends BaseController
{
	
	public function __construct()
	{
		$this->cuser = 'L3B3';
	}
	
    public function getlogsfromconsole() { 
		$mepath = ROOTPATH . 'writable/logs/';
		$melogfile = 'log-' . date("Y-m-d") . '.log';
		$melogfilen = $mepath . $melogfile;
		if(file_exists($melogfilen)):
			exec("/usr/bin/tail -n 50 $melogfilen",$output);
			$chtml = "
			<!DOCTYPE html>
			<html lang=\"en\">
				<head>
					<style>
						code {
							font-family: Consolas,\"courier new\";
							color: crimson;
							background-color: #f1f1f1;
							padding: 2px;
							font-size: 105%;
						}
					</style>
				</head>
				<body>
					<p>Error Log File <br/><code>";
					
			foreach($output as $medata):
				$chtml .= $medata . '<br/>';
			endforeach;
					
			$chtml .= "</code></p>
				</body>
			</html>";
			echo $chtml;
		else:
			echo "No log file created!!!";
		endif;
	} //end getlogsfromconsole
	
}  //end main class 
