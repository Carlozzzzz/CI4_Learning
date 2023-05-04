<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherFile_Model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_teacherfile1';
    protected $primaryKey       = 'teacherid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['teacherid', 'employeeno', 'lastname', 'firstname', 'middlename', 'suffix', 'email', 'isactive'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
        $this->UserFile_Model = model('UserFile_Model');

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
            $xfilter .= "tf1.isactive = ?";
            $xarr_param[] = $postdata['isactive'];
        }

        if(isset($postdata['teacherid']) && $postdata['teacherid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.teacherid = ?";
            $xarr_param[] = $postdata['teacherid'];
        }

        if(isset($postdata['employeeno']) && $postdata['employeeno'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.employeeno = ?";
            $xarr_param[] = $postdata['employeeno'];
        }

        if(isset($postdata['lastname']) && $postdata['lastname'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.lastname = ?";
            $xarr_param[] = $postdata['lastname'];
        }

        if(isset($postdata['firstname']) && $postdata['firstname'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.firstname = ?";
            $xarr_param[] = $postdata['firstname'];
        }

        if(isset($postdata['middlename']) && $postdata['middlename'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.middlename = ?";
            $xarr_param[] = $postdata['middlename'];
        }

        if(isset($postdata['suffix']) && $postdata['suffix'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.suffix = ?";
            $xarr_param[] = $postdata['suffix'];
        }

        if(isset($postdata['email']) && $postdata['email'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.email = ?";
            $xarr_param[] = $postdata['email'];
        }


        if(isset($postdata['notinid']) && $postdata['notinid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "tf1.teacherid != ?";
            $xarr_param[] = $postdata['notinid']['teacherid'];
        }

        if($xfilter != "")
        {
            $xfilter = "WHERE " . $xfilter;
        }

        if(isset($postdata['orderby']) && count($postdata['orderby']) > 0)
        {
            if(isset($postdata['orderby']) && $postdata['orderby']['field'] != "")
            {
                $xorderby .= "ORDER BY " . $postdata['orderby']['field'];
            }

            if(isset($postdata['orderby']['ordertype']) && $postdata['orderby']['ordertype'] != "")
            {
                $xorderby .= " " . $postdata['orderby']['ordertype'];
            }
        }

        $qry = "SELECT 
                    *
                FROM tbl_teacherfile1 tf1
                {$xfilter}
                {$xorderby}";
        $stm = $this->query($qry, $xarr_param);
        $row = $stm->getResultArray();
        
        if(count($row) > 0)
        {
            foreach($row as $key => $value)
            {
                $row[$key]['encryptid'] = $this->DefaultCI_Model->encode_url($value['teacherid']);
            }
        }

        // $lastQuery = $this->db->getLastQuery();

        // echo $lastQuery;
        // echo "<pre>";
        // var_dump($postdata);
        // var_dump($xarr_param);
        // die();

        return $row;
    }

    public function set_data_insert_file1($postdata = array())
    {
        $xretobj = array();

        $xarr_param = array();
        $xarr_param['email'] = $postdata['txtfld']['email'];
        $xrows = $this->go_fetch_file1_data($xarr_param);

        // echo "<pre>";
        // var_dump($xrows);
        // die();

        $xretobj['bool'] = FALSE;
        if(count($xrows) > 0)
        {
            $xretobj['msg'] = "Teacher already Exist!";
        }
        else
        {
            $xarr_param = array();
            $xarr_param = $postdata['txtfld'];
            $xarr_param['teacherid'] = $this->DefaultCI_Model->generate_idno("tbl_teacherfile1", "teacherid");
            $xarr_param['username'] = $this->DefaultCI_Model->generate_username("teacherid", "tbl_teacherfile1");
            $xarr_param['employeeno'] = $xarr_param['username'];
            $xarr_param['isactive'] = 1;

            $xarr_param2 = array();
            $xarr_param2['username'] = $xarr_param['employeeno'];
            $xrows = $this->UserFile_Model->go_fetch_file1_data($xarr_param2);

            // echo "<pre>";
            // var_dump($xarr_param);
            // // var_dump($xarr_param['username']);
            // // var_dump($xarr_param['employeeno']);
            // die();
            if(count($xrows) > 0)
            {
                $xretobj['bool'] = FALSE;
                $xretobj['msg'] = "User Exists!";
            }
            else if($this->insert($xarr_param))
            {
                // $lastQuery = $this->db->getLastQuery();

                // echo $lastQuery;
                // echo "<pre>";
                // var_dump($xarr_param);
                // die();

                $xarr_param['userid'] = $this->DefaultCI_Model->generate_idno("tbl_userfile1", "userid");
                $xarr_param['password'] = $this->DefaultCI_Model->generate_password($xarr_param['lastname'], "_abc123#");
                $xarr_param['usertype'] = "teacher";

                if($this->UserFile_Model->insert($xarr_param))
                {
                    $xretobj['msg'] = "Teacher Successfully Created!";
                    $xretobj['bool'] = True;
                }
                else
                {
                    $xretobj['bool'] = FALSE;
                    $xretobj['msg'] = "Failed to Create Useraccount!";
                }
            }
            else
            {
                $xretobj['bool'] = FALSE;
                $xretobj['msg'] = "Failed to Save!";
            }
        }
        
        return $xretobj;
    }

    public function set_data_update_file1($postdata = array())
    {
        $xretobj = array();
        
        $xarr_param = array();
        $xarr_param_notin = array();
        $xrows = array();
        if(isset($postdata['txtfld']['email']) && $postdata['txtfld']['email'] != "")
        {
            $xarr_param['email'] = $postdata['txtfld']['email'];
            $xarr_param_notin['teacherid'] = $postdata['idno'];
            $xarr_param['notinid'] = $xarr_param_notin;
            $xrows = $this->go_fetch_file1_data($xarr_param);
        }

        $xretobj['bool'] = FALSE;
        if(count($xrows) > 0)
        {
            $xretobj['msg'] = "Teacher already exist!";
        }
        else
        {
            $xarr_param = array();
            $xarr_param = $postdata['txtfld'];
          
            if($this->update($postdata['idno'], $xarr_param))
            {
                $xarr_param = array();
                $xarr_param['teacherid'] = $postdata['idno'];
                $row = $this->go_fetch_file1_data($xarr_param);

                $xarr_param = array();
                $xarr_param = $postdata['txtfld'];
                
                $updateuserfile = $this->UserFile_Model  
                    ->whereIn('username', [$row[0]['employeeno']])
                    ->set($xarr_param)
                    ->update();

                if($updateuserfile)
                {
                    $xretobj['bool'] = TRUE;
                    $xretobj['msg'] = "Teacher successfully updated!";
                }
                else
                {
                    $xretobj['bool'] = FALSE;
                    $xretobj['msg'] = "Useraccount not found!";
                }
            }
            else
            {
                $xretobj['bool'] = FALSE;
                $xretobj['msg'] = "Failed to Update!";
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

        $xarr_param = array();
        $xarr_param['teacherid'] = $postdata['idno'];
        $xrow = $this->go_fetch_file1_data($xarr_param);
        // echo "<pre>";
        // var_dump($xrow);
        // die();

        if(count($xrow) > 0 && $this->delete($postdata['idno']))
        {
            if($this->UserFile_Model->where('username', $xrow[0]['employeeno'])->delete())
            {
                $xretobj['bool'] = True;
                $xretobj['msg'] = "Teacher successfully deleted!";
            }
            else
            {
                $xretobj['bool'] = FALSE;
                $xretobj['msg'] = "Useraccount not found!";
            }
        }
        else
        {
            $xretobj['msg'] = "Failed to Delete!";
        }
        return $xretobj;
    }

    public function set_data_reset_file1($postdata = array())
    {
        $xretobj = array();

        $xretobj['bool'] = FALSE;

        $xarr_param = array();
        $xarr_param['username'] = $postdata['idno'];
        $xrow = $this->UserFile_Model->go_fetch_file1_data($xarr_param);
        
        // echo "<pre>";
        // var_dump($xarr_param);
        // var_dump($xrow);
        // die();

        if(count($xrow) > 0)
        {
            // echo "<pre>";
            // $xarr_param['password'] = $this->DefaultCI_Model->decode_url($xrow[0]['password']);
            // echo "Old pass: " . ($xarr_param['password']) . "<br>";
            // $xarr_param['password'] = $this->DefaultCI_Model->decode_url($xarr_param['password']);
            // echo "New pass: " . ($xarr_param['password']);
            // die();
            $xarr_param = array();
            $xarr_param['password'] = $this->DefaultCI_Model->generate_password($xrow[0]['lastname'], "_abc123#");
            
            $updateuserfile = $this->UserFile_Model  
                    ->whereIn('username', [$postdata['idno']])
                    ->set($xarr_param)
                    ->update();

            if($updateuserfile)
            {
                $xretobj['bool'] = TRUE;
                $xretobj['msg'] = "Teacher password has been reset!";
            }
            else
            {
                $xretobj['bool'] = FALSE;
                $xretobj['msg'] = "Password Reset Failed!";
            }
            
        }
        else
        {
            $xretobj['msg'] = "Failed to reset password!";
        }
        return $xretobj;
        
    }
}
