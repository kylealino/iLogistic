<?php
namespace App\Models;
use CodeIgniter\Model;

class MyDBNamesModel extends Model
{
	public function medb($nnum=0) { 
		$medb[] = 'myilogistic';
		$medb[] = 'bkmydb';
		$medb[] = 'pansamantala';
		return $medb[$nnum];
	}  //end medb
} //end MyDBNamesModel
