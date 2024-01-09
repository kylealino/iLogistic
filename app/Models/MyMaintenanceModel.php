<?php
namespace App\Models;
use CodeIgniter\Model;
class MyMaintenanceModel extends Model
{
	public function __construct()
	{ 
		parent::__construct();
		$this->mylibzsys = model('App\Models\MyLibzSysModel');
		$this->myusermod = model('App\Models\MyUserModel');
		$this->db_erp = $this->myusermod->mydbname->medb(0);
		$this->db_temp = $this->myusermod->mydbname->medb(2);
		$this->cuser = $this->myusermod->mysys_user();
		$this->request = \Config\Services::request();  
		$this->mpw_tkn = $this->myusermod->mpw_tkn();
	}	
	
	public function coa_charges($npages = 1,$npagelimit = 30,$msearchrec='') { 
        $strqry="
            SELECT
                `recid` as recid,
                `charge_desc`,
                `charge_type`,
                `charge_basis`,
                `charge_cur`,
                `charge_rate`,
                `charge_amount`
            FROM
                `mst_charges`
        ";

        $str = "
		select count(*) __nrecs from ({$strqry}) oa
		";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		$rw = $qry->getRowArray();
		$npagelimit = ($npagelimit > 0 ? $npagelimit : 30);
		$nstart = ($npagelimit * ($npages - 1));
		
		
		$npage_count = ceil(($rw['__nrecs'] + 0) / $npagelimit);
		$data['npage_count'] = $npage_count;
		$data['npage_curr'] = $npages;
		$str = "
		SELECT * from ({$strqry}) oa limit {$nstart},{$npagelimit} ";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		
		if($qry->resultID->num_rows > 0) { 
			$data['rlist'] = $qry->getResultArray();
		} else { 
			$data = array();
			$data['npage_count'] = 1;
			$data['npage_curr'] = 1;
			$data['rlist'] = '';
		}
		return $data;
    } 

	public function coa_recs($npages = 1,$npagelimit = 30,$msearchrec='') { 
        $strqry="
			SELECT `org_desc`,`service_desc` FROM mst_coa GROUP BY `org_desc`,`service_desc`
        ";

        $str = "
		select count(*) __nrecs from ({$strqry}) oa
		";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		$rw = $qry->getRowArray();
		$npagelimit = ($npagelimit > 0 ? $npagelimit : 30);
		$nstart = ($npagelimit * ($npages - 1));
		
		
		$npage_count = ceil(($rw['__nrecs'] + 0) / $npagelimit);
		$data['npage_count'] = $npage_count;
		$data['npage_curr'] = $npages;
		$str = "
		SELECT * from ({$strqry}) oa limit {$nstart},{$npagelimit} ";
		$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
		
		if($qry->resultID->num_rows > 0) { 
			$data['rlist'] = $qry->getResultArray();
		} else { 
			$data = array();
			$data['npage_count'] = 1;
			$data['npage_curr'] = 1;
			$data['rlist'] = '';
		}
		return $data;
    } 

	public function coa_sv(){
		$cuser = $this->myusermod->mysys_user();
		$charge = $this->request->getVar('charge');
		$organization = $this->request->getVar('organization');
		$service = $this->request->getVar('service');

		if (empty($charge) || empty($organization) || empty($service)) {
			echo "<div class=\"alert alert-danger p-0\" role=\"alert\"> Please fill up the required field/selection! </div>";
            die();
		}
		if (is_array($charge) && !empty($charge)) {
			foreach ($charge as $item) {
				$value = $item['value'];
			
				$str="
				INSERT INTO `mst_coa` (
					`service_desc`,
					`org_desc`,
					`charge_desc`,
					`encd_date`,
					`encd_by`
				  )
				  VALUES
					(
					  '$service',
					  '$organization',
					  '$value',
					  NOW(),
					  '$cuser'
					)
				";
				$qry = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
			}
		}

		echo "Data successfully saved!";


	}
	
}
