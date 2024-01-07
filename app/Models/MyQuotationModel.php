<?php
namespace App\Models;
use CodeIgniter\Model;
class MyQuotationModel extends Model
{
	public function __construct()
	{ 
		parent::__construct();
		$this->mylibzsys = model('App\Models\MyLibzSysModel');
		$this->myusermod = model('App\Models\MyUserModel');
		$this->db_erp = $this->myusermod->mydbname->medb(0);
		$this->db_temp = $this->myusermod->mydbname->medb(2);
		$this->cuser = $this->myusermod->mysys_user();
		$this->mpw_tkn = $this->myusermod->mpw_tkn();
	}	
	
	public function quotation_sv() { 

    } 
	
}
