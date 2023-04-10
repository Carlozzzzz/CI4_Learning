<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentsubjectlistFile_Model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_subjectfile3';
    protected $primaryKey       = 'recid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['subjectid', 'studentid', 'teacherid', 'isactive'];

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
            $xfilter .= "sf3.teachersfid = ?";
            $xarr_param[] = $postdata['teachersfid'];
        }

        if(isset($postdata['subjectid']) && $postdata['subjectid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "sf3.subjectid = ?";
            $xarr_param[] = $postdata['subjectid'];
        }

        if(isset($postdata['teacherid']) && $postdata['teacherid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "sf3.teacherid = ?";
            $xarr_param[] = $postdata['teacherid'];
        }

        if(isset($postdata['notinid']) && $postdata['notinid'] != "")
        {
            if($xfilter != "")
            {
                $xfilter .= " AND ";
            }
            $xfilter .= "sf3.teachersfid != ?";
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
                $xorderby .= "ORDER BY " . $postdata['orderby']['field'] != "";
            }

            if(isset($postdata['orderby']['ordertype']) && $postdata['orderby']['ordertype'] != "")
            {
                $xorderby .= " " . $postdata['orderby']['ordertype'];
            }
        }

        $qry = "SELECT
                    sf1.subject,
                    tf1.lastname,
                    tf1.firstname,
                    sf3.*
                FROM tbl_subjectfile3 sf3
                LEFT JOIN tbl_subjectfile1 sf1 ON sf1.subjectid = sf3.subjectid
                LEFT JOIN tbl_teacherfile1 tf1 ON tf1.teacherid = sf3.teacherid
                {$xfilter}
                {$xorderby}";
        $stm = $this->query($qry, $xarr_param);
        $row = $stm->getResultArray();

        
        if(count($row) > 0)
        {
            foreach($row as $key => $value)
            {
                $row[$key]['encryptid'] = $this->DefaultCI_Model->encode_url($value['studentsfid']);
            }
        }

        $lastQuery = $this->db->getLastQuery();

        // echo $lastQuery;
        // echo "<pre>";
        // var_dump($postdata);
        // var_dump($xarr_param);
        // var_dump($row);
        // die();

        return $row;

    }

    public function set_data_insert_file1($postdata = array())
    {
        $xretobj = array();

        $xarr_param = array();
        $xarr_param['teacherid'] = $postdata['txtfld']['teacherid'];
        $xarr_param['subjectid'] = $postdata['txtfld']['subjectid'];
        $xarr_param['studentid'] = $postdata['txtfld']['studentid'];
        $xrows = $this->go_fetch_file1_data($xarr_param);

        // echo "<pre>";
        // var_dump($xrows);
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
            $xarr_param['studentsfid'] = $this->DefaultCI_Model->generate_idno("tbl_subjectfile3", "studentsfid");
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
}
