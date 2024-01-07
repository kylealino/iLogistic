<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
  
class Mylogin extends BaseController
{
    public function index()
    {
        echo view('mylogin');
    } 
  
    public function auth()
    {
        //https://www.tutsmake.com/codeigniter-4-login-and-registration-tutorial-example/
        $db_erp = $this->myusermod->mydbname->medb(0);
        $meusername = $this->request->getVar('MyUsername');
        $password = $this->request->getVar('MyPassword');
        $hash_passwd = hash('sha512', $password);
        $data = $this->myusermod->Verify_User($meusername)->getRowArray();
        $nrows = $this->myusermod->Verify_User($meusername)->resultID->num_rows;

        if($data) {

            $curdate = substr($data['xcurdate'],0,10);
            $dvalis = substr($data['myua_date_s'],0,10);
            $dvalie = substr($data['myua_date_e'],0,10);
            $myuser_aremote = $data['myua_aremote'];

            $passdb = $data['myua_passwd'];
            //echo $password . '<br/>';
            //echo $hash_passwd . '<br/>';
            //die();
            $verify_pass = $this->myusermod->Verify_Password($passdb, $password);
            if($verify_pass) { 
                if($curdate >= $dvalis and $curdate <= $dvalie) { 
                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
                        $mclient_ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $mclient_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $mclient_ip = $_SERVER['REMOTE_ADDR'];
                    }
                    $meclient_ip = '';
                    $aclient_ip = explode(".", $mclient_ip);
                    if(count($aclient_ip) > 2) {
                        $meclient_ip = $aclient_ip[0] . "." . $aclient_ip[1] . "." . $aclient_ip[2];
                    }

                    if($myuser_aremote == 'Y') {      
                            $ses_data = array(
                            '__xsys_myuserziamsys_is_logged__' => TRUE,
                            '__xsys_myuserziamsys__' => $meusername 
                            );

                            $this->session->set($ses_data);
                            $this->myusermod->mylibzdb->user_logs_activity_module($db_erp,'USER_LOG_IN','',$meusername,'','URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
                            return redirect()->to('/');
                    } else {
                        $str = "select `m_client_ip` from {$db_erp}.`mst_netw_farm` where (`m_client_ip` = '$mclient_ip' or `m_client_ip` = '$meclient_ip') and `m_activate` = 'Y'";
                        $qip = $this->myusermod->mylibzdb->myoa_sql_exec($str,'URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
                        if($qip->resultID->num_rows > 0) { 
                            $ses_data = array(
                            '__xsys_myuserziamsys_is_logged__' => TRUE,
                            '__xsys_myuserziamsys__' => $meusername 
                            );

                            $this->session->set($ses_data);                            
                            $this->myusermod->mylibzdb->user_logs_activity_module($db_erp,'USER_LOG_IN','',$meusername,'','URI: ' . $_SERVER['PHP_SELF'] . chr(13) . chr(10) . 'File: ' . __FILE__  . chr(13) . chr(10) . 'Line Number: ' . __LINE__);
                            return redirect()->to('/');
                        } else {
                            $this->session->setFlashdata('mesysziam_memsg_login', 'Network Access Denied!!! [' . $mclient_ip . ']');
                            return redirect()->to('/mylogin');

                        }
                        $qip->freeResult();
                    }
                } else {
                    $this->session->setFlashdata('mesysziam_memsg_login', 'Expired User Login');
                    return redirect()->to('/mylogin');
                }
            } else {
                $this->session->setFlashdata('mesysziam_memsg_login', 'Wrong Password');
                return redirect()->to('/mylogin');
            }
        } else {
            $this->session->setFlashdata('mesysziam_memsg_login', 'User Name not Found');
            return redirect()->to('/mylogin');
        }
    }
  
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/mylogin');
    }
} //end main Mylogin
