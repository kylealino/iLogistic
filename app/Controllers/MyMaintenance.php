<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\MyMaintenanceModel;
class MyMaintenance extends BaseController
{

    public function __construct()
    {
        $this->mydbname = model('App\Models\MyDBNamesModel');
        $this->mylibzsys = model('App\Models\MyLibzSysModel');
        $this->myusermod = model('App\Models\MyUserModel');
        $this->db_erp = $this->mydbname->medb(0);
        $this->mymaintenance =  new MyMaintenanceModel();
    }

    public function index(){
      $data = $this->mymaintenance->coa_charges();
      return view('maintenance/coa-main',$data);
    } 
    
    public function coa_sv(){
      $this->mymaintenance->coa_sv();
    }

    public function coa_getorg(){ 

      $term = $this->request->getVar('term');

      $autoCompleteResult = array();

      $str = "
      SELECT 
      a.`org_desc` __mdata
      FROM 
      mst_organization a
      WHERE  
      a.`org_desc` like '%%'
      ORDER
      by org_desc limit 15 
      ";


      $qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
      if($qry->getNumRows() > 0) { 
        $rrec = $qry->getResultArray();
        foreach($rrec as $row):
          array_push($autoCompleteResult,array("value" => $row['__mdata']
        ));

        endforeach;
      }
      $qry->freeResult();
      echo json_encode($autoCompleteResult);

    }

    public function coa_getservice(){ 

      $term = $this->request->getVar('term');

      $autoCompleteResult = array();

      $str = "
      SELECT 
      a.`service_desc` __mdata
      FROM 
      mst_services a
      WHERE  
      a.`service_desc` like '%{$term}%'
      ORDER
      by service_desc limit 15 
      ";

      $qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
      if($qry->getNumRows() > 0) { 
        $rrec = $qry->getResultArray();
        foreach($rrec as $row):
          array_push($autoCompleteResult,array("value" => $row['__mdata']
        ));

        endforeach;
      }
      $qry->freeResult();
      echo json_encode($autoCompleteResult);

    }
    
    public function coa_recs() 
    { 
      $data = $this->mymaintenance->coa_recs(1, 10);
      return view('maintenance/coa-recs',$data);
    }

} 
