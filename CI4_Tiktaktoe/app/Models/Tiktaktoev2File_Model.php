<?php

namespace App\Models;

use CodeIgniter\Model;

class Tiktaktoev2File_Model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_scoreboardfile1';
    protected $primaryKey       = 'recid';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['playername', 'move', 'iswinner'];

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

    public function go_fetch_file1_data($postdata = array()){

        $orderCondition = 'playername DESC';

        $query = $this->select('playername, SUM(move) as total_moves')
              ->groupBy('playername')
              ->orderBy($orderCondition)
              ->get();

        $rows = $query->getResultArray();

        return $rows;
    }

    public function go_fetch_file2_data($postdata = array()){

        $whereCondition = [
            'iswinner' => 'Yes',
        ];
        $orderCondition = 'created_at DESC';

        $row = $this->where($whereCondition)
                    ->orderBy($orderCondition)
                    ->first();

        return $row;
    }
    public function set_data_insert_file1($postdata = array()){
        $xarr_param = array();
        $xret_obj = array();

        $xarr_param = $postdata['txtfld'];

        // echo "<pre>";
        // var_dump($xarr_param);
        // die();

        if($this->insert($xarr_param))
        {
            $xret_obj['bool'] = "success";
            $xret_obj['msg'] = "Player Data has been saved.";
        }
        else
        {
            $xret_obj['bool'] = "error";
            $xret_obj['msg'] = $this->error();
        }

        return $xret_obj;
    }
}
