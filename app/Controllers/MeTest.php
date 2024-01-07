<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
  
class MeTest extends BaseController
{
	
	public function __construct()
	{
		//$this->db_erp = $this->mydbname->medb(0);
		$this->myattlogsupld = model('App\Models\MyAttLogsUpldModel');
	}
	
	public function index() {
		return view('md/myattlogs-upld');
	} //end index
		
	public function pdf_import() { 
		return view('metest/metest-pdf-import');
	} //end upld_proc
		
}  //end main class
