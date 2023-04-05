<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\StudentFile_Model;


class UserFile_Model extends Model
{
    protected $DefaultCI_Model;

    protected $DBGroup          = 'default';
    protected $table            = 'tbl_userfile1';
    protected $primaryKey       = 'userid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['userid', 'lastname', 'firstname', 'middlename', 'suffix', 'email', 'username', 'password', 'usertype', 'isactive'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    
    public function __construct()
    {
        $this->DefaultCI_Model = model('DefaultCI_Model');

    }

    public function go_fetch_file1_data($postdata = array()){
        
        $xarr_param = array();
        $xfilter = "";
        $xorderby = "";

        if(isset($postdata['isactive']) && $postdata['isactive'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.isactive = ?";
            $xarr_param[] = $postdata['isactive'];
        }

        if(isset($postdata['userid']) && $postdata['userid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.userid = ?";
            $xarr_param[] = $postdata['userid'];
        }

        if(isset($postdata['lastname']) && $postdata['lastname'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.lastname = ?";
            $xarr_param[] = $postdata['lastname'];
        }

        if(isset($postdata['firstname']) && $postdata['firstname'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.firstname = ?";
            $xarr_param[] = $postdata['firstname'];
        }

        if(isset($postdata['middlename']) && $postdata['middlename'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.middlename = ?";
            $xarr_param[] = $postdata['middlename'];
        }

        if(isset($postdata['suffix']) && $postdata['suffix'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.suffix = ?";
            $xarr_param[] = $postdata['suffix'];
        }

        if(isset($postdata['email']) && $postdata['email'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.email = ?";
            $xarr_param[] = $postdata['email'];
        }


        if(isset($postdata['username']) && $postdata['username'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.username = ?";
            $xarr_param[] = $postdata['username'];
        }

        if(isset($postdata['password']) && $postdata['password'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.password = ?";
            $xarr_param[] = $postdata['password'];
        }

        if(isset($postdata['notinid']) && $postdata['notinid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "uf1.userid != ?";
            $xarr_param[] = $postdata['notinid']['userid'];
        }

        if($xfilter != "")
        {
            $xfilter = "WHERE " . $xfilter;
        }

        if(isset($postdata['orderby']) && count($postdata['orderby']) > 0)
        {
            if(isset($postdata['orderby']) && $postdata['orderby']['field'] != "")
            {
                $xorderby .= "ORDER BY " . $postdata['orderby']['field'] != "";
            }

            if(isset($postdata['orderby']['ordertype']) && $postdata['orderby']['ordertype'] != "")
            {
                $xorderby .= " " . $postdata['orderby']['ordertype'];
            }
        }

        $qry = "SELECT 
                    *
                FROM tbl_userfile1 uf1
                {$xfilter}
                {$xorderby}";
        $stm = $this->query($qry, $xarr_param);
        $row = $stm->getResultArray();
        
        if(count($row) > 0)
        {
            foreach($row as $key => $value)
            {
                $row[$key]['encryptid'] = $this->DefaultCI_Model->encode_url($value['userid']);
            }
        }

        return $row;
    }

    public function set_data_insert_file1($postdata = array())
    {
        $xretobj = array();

        $xarr_param = array();
        $xarr_param['email'] = $postdata['txtfld']['email'];

        $xrows = $this->go_fetch_file1_data($xarr_param);

        $xretobj['bool'] = FALSE;
        if(count($xrows) > 0)
        {
            $xretobj['msg'] = "User already Exist!";
        }
        else
        {
            $xarr_param = array();
            $xarr_param = $postdata['txtfld'];
            $builder = $this->db->table($this->table);

            $xarr_param['userid'] = $this->DefaultCI_Model->generate_idno("tbl_userfile1", "userid");
            $xarr_param['password'] = $this->DefaultCI_Model->generate_password($xarr_param['lastname'], "_abc123#");
            $xarr_param['created_at'] = date("Y-m-d H:i:s");
            $xarr_param['isactive'] = 1;

            if($this->insert($xarr_param))
            {
                $xretobj['msg'] = "User Successfully Created!";
                $xretobj['bool'] = True;
            }
            else
            {
                $xretobj['bool'] = FALSE;
                $xretobj['msg'] = $this->error();
            }
        }
        
        return $xretobj;
    }

    public function set_data_update_file1($postdata = array())
    {
        $xretobj = array();
        $id = 1;
        
        $xarr_param = array();
        $xarr_param_notin = array();
        $xrows = array();
        if(isset($postdata['txtfld']['email']) && $postdata['txtfld']['email'] != "")
        {
            $xarr_param['email'] = $postdata['txtfld']['email'];
            $xarr_param_notin['userid'] = $postdata['idno'];
            $xarr_param['notinid'] = $xarr_param_notin;
            $xrows = $this->go_fetch_file1_data($xarr_param);
        }

        $xretobj['bool'] = FALSE;
        if(count($xrows) > 0)
        {
            $xretobj['msg'] = "User already exist!";
        }
        else
        {
            $xarr_param = array();
            $xarr_param = $postdata['txtfld'];
            $xarr_param['created_at'] = date("Y-m-d H:i:s");
          
            if($this->update($postdata['idno'], $xarr_param))
            {
                $affectedRows = $this->affectedRows();
                if ($affectedRows == 0) {
                    $xretobj['bool'] = FALSE;
                    $xretobj['msg'] = "No rows updated.";
                } else {
                    $xretobj['bool'] = TRUE;
                    $xretobj['msg'] = "User successfully updated!";
                }
            }
            else
            {
                $xretobj['bool'] = FALSE;
                $xretobj['msg'] = $this->error();
            }
        }
        return $xretobj;
    }

    public function set_data_delete_file1($postdata = array())
    {
        $xretobj = array();

        $xretobj['bool'] = FALSE;
        
        $xarr_param = array();
        $xarr_param['idno'] = $postdata['idno'];
        $xrows = $this->go_fetch_file1_data($xarr_param);

        if($this->delete($xarr_param['idno']))
        {
            $xretobj['bool'] = True;
            $xretobj['msg'] = "User successfully deleted!";
        }
        else
        {
            $xretobj['msg'] = $this->db->error();
        }
        return $xretobj;
    }
  
}
