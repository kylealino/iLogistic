<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\MyQuotationModel;

class MyQuotation extends BaseController
{

    public function __construct()
    {
        $this->mydbname = model('App\Models\MyDBNamesModel');
        $this->db_erp = $this->mydbname->medb(0);
        $this->mymdarticle =  new MyQuotationModel();
        $this->myusermod = model('App\Models\MyUserModel');
        $this->request = \Config\Services::request();
        $this->mylibzdb = model('App\Models\MyLibzDBModel');
    }

    public function index()
    {
        echo view('quotation/quotation-main');
    } 

    public function quotation_entry()
    {
        echo view('quotation/quotation-entry');
    } 

    public function quotation_org_search() { 
		$cuser = $this->myusermod->mysys_user();
		$mpw_tkn = $this->myusermod->mpw_tkn();

		$term = $this->request->getVar('term');
		$autoCompleteResult = array();

		$str = "
		select `org_addr`,`org_desc` __mdata FROM `mst_organization` where (`org_desc` like '%$term%') limit 5 
		";

        $q =  $this->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);// AND {$str_comp} 
        if($q->getNumRows() > 0) { 
            $rrec = $q->getResultArray();
            foreach($rrec as $row):
 
                $mtkn_recid = hash('sha384', $row['recid'] . $mpw_tkn);
                array_push($autoCompleteResult,array("value" => $row['__mdata'], 
                    "org_addr" => $row['org_addr'] ));

            endforeach;
        }

        $q->freeResult();
        echo json_encode($autoCompleteResult);
	}  //end search

} 
