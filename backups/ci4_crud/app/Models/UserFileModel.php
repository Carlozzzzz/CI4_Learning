<?php

namespace App\Models;

use CodeIgniter\Model;

class UserFileModel extends Model
{
    protected $defaultCI;

    protected $DBGroup          = 'default';
    protected $table            = 'tbl_userfile1';
    protected $primaryKey       = 'recid';
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
        $this->defaultCI = model('DefaultCI_Model');

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
            $xfilter .= "uf1.userid = ?";
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
                $row[$key]['encryptid'] = $value['recid'];
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

            $xarr_param['userid'] = $this->defaultCI->generate_idno("tbl_userfile1", "userid");
            $xarr_param['password'] = $this->defaultCI->generate_password($xarr_param['lastname'], "_abc123#");
            $xarr_param['created_at'] = date("Y-m-d H:i:s");
            $xarr_param['isactive'] = 1;

            $builder->insert($xarr_param);
            $xretobj['msg'] = "User Successfully Created!";
            $xretobj['bool'] = True;

        }
        
        return $xretobj;
    }

    public function set_data_insert_file2($postdata = array())
    {
        $xretobj = array();

        $xarr_param = array();
        $xarr_param['email'] = $postdata['txtfld']['email'];

        $xrows = $this->go_fetch_file1_data($xarr_param);

        $xretobj['bool'] = FALSE;
        if (count($xrows) > 0) {
            $xretobj['msg'] = "User already Exist!";
        } else {
            $xarr_param = array();
            $xarr_param = $postdata['txtfld'];

            $xarr_param['userid'] = $this->defaultCI->generate_idno("tbl_userfile1", "userid");
            $xarr_param['password'] = $this->defaultCI->generate_password($xarr_param['lastname'], "_abc123#");
            $xarr_param['isactive'] = 1;

            // Insert data into the table
            $success = true;
            try {
                $success = $this->insert($xarr_param);
            } catch (\Exception $e) {
                $success = false;
            }
                    
            if ($success) {
                $xretobj['msg'] = "User Successfully Created!";
                $xretobj['bool'] = True;
            } else {
                // insert failed, debug to find out why
                $xretobj['msg'] = "Insert failed!";
                $xretobj['bool'] = False;
                $xretobj['error'] = $this->db->error();
            }
        }

        return $xretobj;
    }
}
