<?php

namespace App\Models;

use CodeIgniter\Model;

class TranslatorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'english_spanish_lang';
    protected $primaryKey       = 'recid';
    protected $useAutoIncrement = true;
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

    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect(); 
    }


    public function addUserLanguage() {
        $id = session()->get('userid');

        $data = array('userid' 		=> $this->user['user_id'],
					  'user_id' 		=> $id,
					  'created_datetime' 	=> date('Y-m-d H:i:s'));

		if ($this->db->insert('user_language_settings', $data)) {
			return true;
		} else {
			return false;
		}
    }

    public function getUserLanguage()
    {
        $userid = session('userid');
    
        $query = $this->db->table('user_language_settings uls')
            ->select('uls.language')
            ->where('uls.userid', $userid)
            ->get();
    
        if ($query->getNumRows() > 0) {
            return $query->getResult();
        }
    
        return false;
    }
    

    // create get function for retrieving Selected language by id

    public function getTranslatedData($language, $original_text) {
        if($language == "spanish") {
            $this->db->select('esl.spanish_text');
            $this->db->from('english_spanish_lang esl');
            $this->db->where('esl.english_text', $original_text);
        } else if($language == "english") {
            $this->db->select('esl.english_text');
            $this->db->from('english_spanish_lang esl');
            $this->db->where('esl.spanish_text', $original_text);
        }

		$sessions = $this->db->get();

        if ($sessions->num_rows() > 0)
		{
			return $sessions->result();
		}
        return false;

    }

    public function getTextData() {
        
        $query = $this->db->table('english_spanish_lang')
            ->select('english_text, spanish_text')
            ->orderBy('CHAR_LENGTH(english_text)', 'DESC')
            ->get();

        if ($query->getNumRows() > 0) {
            $result = $query->getResult();
        return $result;
        }

        return false;

    }

    public function updateUserLanguage($language) {
        $xretobj = array();
        $id = session()->get('userid');

        if($this->getUserLanguage() == true){

            $data = array('language' => $language,
					  'userid' 		 => $id,
					  'added_datetime' 	=> date('Y-m-d H:i:s'));

            $xupdatedata = $this->db->table('user_language_settings')
                ->where('userid', $id)
                ->update($data);

            if($xupdatedata > 0)
            {
                $xretobj['bool'] = true;
                $xretobj['msg'] = "update success.";
            }
            else
            {
                $xretobj['bool'] = false;
                $xretobj['msg'] = "update fail.";
            }
        }
        else {
            // insert the new language here
            $xretobj['bool'] = false;
            $xretobj['msg'] = "create insert language first.";


            $field_set = array(
                'userid'=>$id,
                'language'=>$language,
                'added_datetime'=>date('Y-m-d H:i:s')
            );
            
            if($this->db->table("user_language_settings")->insert($field_set)){
                $xretobj['bool'] = true;
                $xretobj['msg'] = "Language setting created.";
            }
            else
            {
                $xretobj['bool'] = false;
                $xretobj['msg'] = "Faile to create language setting.";
            }
        }

        return $xretobj;
    }
}
