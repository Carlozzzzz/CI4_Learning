<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Quizfile extends BaseController
{
    public function index($isactive = 1){

        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin")
        {
            // echo "<pre>";
            // var_dump(session()->get('ci4_usertype'));
            // die();
            $page = "quizfile";
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage']= 'quizfile';
            return view ('pages/quizfile', $data);
        }
        else
        {
            return view ('template/errorfile');
        }
       
    }

    public function endquiz(){

        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin")
        {
            // echo "<pre>";
            // var_dump(session()->get('ci4_usertype'));
            // die();
            $page = "endquiz";
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage']= 'endquiz';
            return view ('pages/endquiz', $data);
        }
        else
        {
            return view ('template/errorfile');
        }
       
    }

    public function highscores(){

        if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin")
        {
            // echo "<pre>";
            // var_dump(session()->get('ci4_usertype'));
            // die();
            $page = "highscores";
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                throw new PageNotFoundException($page);
            }
            $data['data_activepage']= 'highscores';
            return view ('pages/highscores', $data);
        }
        else
        {
            return view ('template/errorfile');
        }
       
    }
}
