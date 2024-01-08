<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\MyMaintenanceModel;
class MyMaintenance extends BaseController
{

    public function __construct()
    {
        $this->mydbname = model('App\Models\MyDBNamesModel');
        $this->db_erp = $this->mydbname->medb(0);
        $this->mymaintenance =  new MyMaintenanceModel();
    }

    public function index()
    {
		$data = $this->mymaintenance->coa_recs();
		return view('maintenance/coa-main',$data);
    } 
    
    public function coa_recs(){
        $txtsearchedrec = $this->request->getVar('txtsearchedrec');
		$mpages = $this->request->getVar('mpages');
		$mpages = (empty($mpages) ? 0: $mpages);
		$data = $this->mymaintenance->coa_recs($mpages,20,$txtsearchedrec);
		return view('maintenance/coa-main',$data);
    }

} 
