<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class DefaultCI_Model extends Model
{
    #region
    protected $encrypter;

    protected $DBGroup          = 'default';
    protected $table            = 'defaultcis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
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
    #endregion

    public function __construct() {
        parent::__construct();

        $this->encrypter = \Config\Services::encrypter();
    }

    public function generate_idno($mftable, $mfid){

        $xqry = "SELECT ({$mfid} +1) AS {$mfid} FROM {$mftable} WHERE year(created_at) = year(curdate()) ORDER BY recid DESC LIMIT 1";
        $xstm = $this->query($xqry);
        $xrow = $xstm->getResultArray();

        $xmfid = date("y")."0001";
        if(count($xrow) > 0)
        {
            $xmfid = $xrow[0][$mfid];
        }
        // $lastQuery = $this->db->getLastQuery();
        // echo $lastQuery;
        // var_dump($xmfid);
        // die();
       
        return $xmfid;
    }

    public function generate_username($columnid, $table) {

        $xqry = "SELECT LPAD((SUBSTRING({$columnid}, 6, 4) + 1), 4, 0) AS {$columnid} FROM {$table} WHERE year(created_at) = year(curdate()) ORDER BY recid DESC LIMIT 1";
        $xstm = $this->db->query($xqry);
        $xrow = $xstm->getResultArray();

        if($columnid == "studentid")
        {
            $xmfid = date("y")."-S-0001";
        }
        else if($columnid == "teacherid")
        {
            $xmfid = date("y")."-T-0001";
        }

        if(count($xrow)>0)
        {
            if($columnid == "studentid")
            {
                $xmfid = date("y")."-S-{$xrow[0][$columnid]}";
            }
            else if($columnid == "teacherid")
            {
                $xmfid = date("y")."-T-{$xrow[0][$columnid]}";
            }
        }

        $lastQuery = $this->db->getLastQuery();
        
        // echo $lastQuery;
        // echo "<pre>";
        // var_dump($xmfid);
        // var_dump($columnid);
        // var_dump($table);
        // die();

        return $xmfid;
    }

    public function generate_password($lastname, $key)
    {
        $xpassword = "";

        $xpassword = str_replace(" ", "", $lastname);
        $xpassword = strtolower($xpassword);
        $xpassword = $xpassword.$key;
        return $this->encode_url($xpassword);
        // return $xpassword;
    }

    public function encode_url($string, $key = "", $url_safe = TRUE) 
    {
        if ($key == null || $key == "") 
        {
            $key = $this->encrypter->key;
        }
    
        $ret = $this->encrypter->encrypt($string, $key);
        $base64String = base64_encode($ret);

        if($url_safe)
        {
            $ret = str_replace(['+', '/', '='], ['-', '_', ''], $base64String);
        }
    
        return $ret;
    }

    public function decode_url($encodedString, $key = "") 
    {
        if ($key == null || $key = "") {
            $key = $this->encrypter->key;
        }
    
        // Replace URL-safe characters with standard Base64 characters
        $base64String = str_replace(['-', '_'], ['+', '/'], $encodedString);
    
        // Add padding characters if necessary
        $padding = strlen($base64String) % 4;
        if ($padding > 0) {
            $base64String .= str_repeat('=', 4 - $padding);
        }
    
        // Decode the Base64 string
        $encryptedString = base64_decode($base64String);
    
        // Decrypt the data
        $decryptedString = $this->encrypter->decrypt($encryptedString, $key);
    
        return $decryptedString;
    }
}
