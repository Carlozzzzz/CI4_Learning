<?php

namespace App\Models;

use CodeIgniter\Model;

class TeachersubjectlistFile_Model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_subjectfile2';
    protected $primaryKey       = 'recid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['teachersfid', 'subjectid', 'teacherid', 'isactive'];

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
        $this->Subject_File = model('Subject_File');
    }
    
    public function go_fetch_file1_data($postdata = array())
    {
        $xarr_param = array();
        $xfilter = "";
        $xorderby = "";

        if(isset($postdata['teachersfid']) && $postdata['teachersfid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "sf2.teachersfid = ?";
            $xarr_param[] = $postdata['teachersfid'];
        }

        if(isset($postdata['subjectid']) && $postdata['subjectid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "sf2.subjectid = ?";
            $xarr_param[] = $postdata['subjectid'];
        }

        if(isset($postdata['teacherid']) && $postdata['teacherid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "sf2.teacherid = ?";
            $xarr_param[] = $postdata['teacherid'];
        }

        if(isset($postdata['notinid']) && $postdata['notinid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "sf2.teachersfid != ?";
            $xarr_param[] = $postdata['notinid']['teachersfid'];
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
                    sf1.subject,
                    sf2.*
                FROM tbl_subjectfile2 sf2
                LEFT JOIN tbl_subjectfile1 sf1 ON sf1.subjectid = sf2.subjectid
                {$xfilter}
                {$xorderby}";
        $stm = $this->query($qry, $xarr_param);
        $row = $stm->getResultArray();
        
        if(count($row) > 0)
        {
            foreach($row as $key => $value)
            {
                $row[$key]['encryptid'] = $this->DefaultCI_Model->encode_url($value['teachersfid']);
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
        $xarr_param['teacherid'] = $postdata['txtfld']['teacherid'];
        $xarr_param['subjectid'] = $postdata['txtfld']['subjectid'];
        $xrows = $this->go_fetch_file1_data($xarr_param);

        // echo "<pre>";
        // var_dump($xarr_param);
        // die();

        $xretobj['bool'] = FALSE;
        if(count($xrows) > 0)
        {
            $xretobj['msg'] = "Subject already exist!";
        }
        else
        {
            $xarr_param = array();
            $xarr_param = $postdata['txtfld'];
            $xarr_param['teachersfid'] = $this->DefaultCI_Model->generate_idno("tbl_subjectfile2", "teachersfid");
            $xarr_param['isactive'] = 1;

            // echo "<pre>";
            // var_dump($xarr_param);
            // die();

            if($this->insert($xarr_param))
            {
                // $lastQuery = $this->db->getLastQuery();
                // echo $lastQuery;
                // echo "<pre>";
                // var_dump($xarr_param);
                // die();
                $xretobj['bool'] = true;
                $xretobj['msg'] = "Subject Successfully Created!";
            }
            else
            {
                $xretobj['bool'] = false;
                $xretobj['msg'] = $this->error;
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
        if(isset($postdata['txtfld']['subject']) && $postdata['txtfld']['subject'] != "")
        {
            $xarr_param['subject'] = $postdata['txtfld']['subject'];
            $xarr_param_notin['subjectid'] = $postdata['idno'];
            $xarr_param['notinid'] = $xarr_param_notin;
            $xrows = $this->go_fetch_file1_data($xarr_param);
        }
        
        $xretobj['bool'] = FALSE;
        if(count($xrows) > 0)
        {
            $xretobj['msg'] = "Subject already exist";
        }
        else
        {
            $xarr_param = array();
            $xarr_param = $postdata['txtfld'];

            // echo "<pre>";
            // var_dump($xarr_param);
            // var_dump($postdata['idno']);
            // die();

            if($this->update($postdata['idno'], $xarr_param))
            {
                $xretobj['bool'] = true;
                $xretobj['msg'] = "Subject Successfully updated!";
            }
            else
            {
                $xretobj['bool'] = false;
                $xretobj['msg'] = $this->error;
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

        if($this->where('teachersfid', $xarr_param['idno'])->delete())
        {
            $xretobj['bool'] = True;
            $xretobj['msg'] = "Subject successfully deleted!";
        }
        else
        {
            $xretobj['msg'] = $this->db->error();
        }
        return $xretobj;
    }

}
