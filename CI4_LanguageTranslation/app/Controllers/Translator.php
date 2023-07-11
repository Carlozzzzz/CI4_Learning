<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class Translator extends BaseController
{
    protected $session;


    public function __construct()
	{
        $this->session = \Config\Services::session();
		$this->ModelClass = model('Translator_Model');
		$this->session->set('userid', 1871); 
	}

    public function index()
    {
        echo "Index";
    }

    public function initializeUserLanguageSetting() {
        $xdata = $this->ModelClass->getUserLanguage();
        echo json_encode($xdata);
    }

	public function getEnglishToSpanishData() {
		$originalText = $_GET['originalText'];
		$language = $_GET['language'];
		
		$xdata = $this->ModelClass->getTranslatedData($language, $originalText);
		echo json_encode($xdata);
	}

	public function getTextData() {
		$xdata = $this->ModelClass->getTextData();
		echo json_encode($xdata);
	}

    public function updateUserLanguage() {
		$selectedLanguage = $_POST['selectedLanguage'];
		
		$xdata = $this->ModelClass->updateUserLanguage($selectedLanguage);
		echo json_encode($xdata);
	}
}
