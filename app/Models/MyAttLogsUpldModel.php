<?php
namespace App\Models;
use CodeIgniter\Model;

class MyUserAttLogsModel extends Model
{
	// .. other member variables
	protected $db;

	public function __construct()
	{
		parent::__construct();
		$this->session = session();
		$this->request = \Config\Services::request();
		//$this->db = \Config\Database::connect();
		// OR $this->db = db_connect();
		$this->myusermod = model('App\Models\MyUserModel');
		$this->mylibzsys =  model('App\Models\MyLibzSysModel');
		$this->dbname = $this->myusermod->mydbname->medb(0);
		$this->cuser = $this->myusermod->mysys_user();
		$this->mtkntbltmp = $this->mylibzsys->random_string(15);
	}
	
	public function upld_data() {
		$allowed = array('dat','DAT');
		$mefiles_path = ROOTPATH . 'public/uploads/attlogs/';
		$mefiles_upath = 'uploads/attlogs/';
		if(!is_dir($mefiles_path)) mkdir($mefiles_path, '0755', true);
		
		//file uploading 
		$lfileupld = 0;
		if ($mefiles = $this->myusermod->request->getFiles()) { 
			$mfile = $mefiles['upl'];
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

			if(!in_array(strtolower($extension), $allowed)) {
				echo '{"status":"error"}';
				die();
			}
			
			$newName = $mfile->getRandomName();
			$ofilename = $mfile->getName();
			$__upld_filename = $this->cuser . '_' . $mfile->getName();
			$__upld_filename = $this->myusermod->mylibzdb->me_escapeString(str_replace(' ','_',$__upld_filename));
			$__upld_filename = $this->myusermod->mylibzdb->me_escapeString(str_replace(',','',$__upld_filename));
			$mfileMimeType = $mfile->getMimeType();
			if($mfileMimeType == 'text/plain'):
				if (file_exists($mefiles_path . $__upld_filename)) { 
					unlink($mefiles_path . $__upld_filename);
				}
				$mfile->move($mefiles_path, $__upld_filename);
				if (file_exists($mefiles_path . $__upld_filename)) { 
					$lfileupld = 1;
					$cfile = $mefiles_path . $__upld_filename;
					$str = "insert into {$this->dbname}.attlogs_upld (ATTL_USER,ATTL_FILE,ATTL_DATE,ATTL_OFILE) 
					values('{$this->cuser}','$__upld_filename',now(),'$ofilename')";
					$this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
					$this->myusermod->mylibzdb->user_logs_activity_module($this->dbname,'ATTLOGS_UPLD_AREC','',$ofile,$str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
					
				}
			endif;
			
			foreach ($mefiles['upl'] as $mfile) { 
				if ($mfile->isValid() && !$mfile->hasMoved()) { 
					$newName = $mfile->getRandomName();
					$__upld_filename = $this->cuser . '_' . $mfile->getName();
					$__upld_filename = $this->myusermod->mylibzdb->me_escapeString(str_replace(' ','_',$__upld_filename));
					$__upld_filename = $this->myusermod->mylibzdb->me_escapeString(str_replace(',','',$__upld_filename));
					$mfileMimeType = $mfile->getMimeType();
					if($mfileMimeType == 'text/plain'):
						if (file_exists($mefiles_path . $__upld_filename)) { 
							unlink($mefiles_path . $__upld_filename);
						}
						
						$mfile->move($mefiles_path, $__upld_filename);
						
						if (file_exists($mefiles_path . $__upld_filename)) { 
							$lfileupld = 1;
							$cfile = $mefiles_path . $__upld_filename;
							
						}
					endif;
				}
			}  //end foreach 
		} //end if 
		//file uploading end 		

		if(!$lfileupld):
			echo '{"status":"error"}';
			die();
		else:
			echo '{"status":"success"}';
		endif;
	} //end upld_proc
	
	
}  //end main class
