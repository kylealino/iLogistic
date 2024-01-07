<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
  
class MyAttLogsUpld extends BaseController
{
	
	public function __construct()
	{
		//$this->db_erp = $this->mydbname->medb(0);
		$this->myattlogsupld = model('App\Models\MyAttLogsUpldModel');
	}
	
	public function index() {
		return view('md/myattlogs-upld');
	} //end index
		
	public function upld_data() { 
		$this->myattlogsupld->upld_data();
	} //end upld_proc
		
}  //end main class
