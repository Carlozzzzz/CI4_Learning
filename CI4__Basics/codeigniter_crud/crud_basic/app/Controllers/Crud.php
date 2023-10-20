<?php

namespace App\Controllers;

use App\Models\CrudModel;

class Crud extends BaseController
{
    public function index()
    {
        # create model
        $crudModel = new CrudModel();

        $data ['user_data'] = $crudModel->orderBy('id', 'DESC')->paginate(10);
        
        # return pagination link
        $data['pagination_link'] = $crudModel->pager;

        return view('crud_view', $data);
    }

    function add()
    {
        return view('add_data');    
    }

    function add_validation()
    {
        # load fore form and url helper
        helper(['form', 'url']);

        $error = $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'gender' => 'required'
        ]);

        # validation message 
        if(!$error)
        {
            echo view('add_data',[
                'error' => $this->validator
            ]);
        }
        else
        {
            # create Model
            $crudModel = new CrudModel();

            # save data to msql table
            $crudModel->save([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'gender' => $this->request->getVar('gender'),
            ]);

            # set session message
            $session = \Config\Services::session();

            $session->setFlashData('success', 'User Data Added');

            # redirect to list of user data
            return $this->response->redirect(site_url('/crud'));
        }
    }

    function fetch_single_data($id = null)
    {
        $crudModel = new CrudModel();

        $data['user_data'] = $crudModel->where('id', $id)->first();
        
        return view('edit_data', $data);
    }

    function edit_validation()
    {
    	helper(['form', 'url']);
        
        $error = $this->validate([
            'name' 	=> 'required|min_length[3]',
            'email' => 'required|valid_email',
            'gender'=> 'required'
        ]);

        $crudModel = new CrudModel();

        $id = $this->request->getVar('id');

        if(!$error)
        {
        	$data['user_data'] = $crudModel->where('id', $id)->first();
        	$data['error'] = $this->validator;
        	echo view('edit_data', $data);
        } 
        else 
        {
	        $data = [
	            'name' => $this->request->getVar('name'),
	            'email'  => $this->request->getVar('email'),
	            'gender'  => $this->request->getVar('gender'),
	        ];

        	$crudModel->update($id, $data);

        	$session = \Config\Services::session();

            $session->setFlashdata('success', 'User Data Updated');

        	return $this->response->redirect(site_url('/crud'));
        }
    }

    function delete($id)
    {
        $crudModel = new CrudModel();

        $crudModel->where('id', $id)->delete($id);

        # set session message

        $session = \Config\Services::session();
        
        $session->setFlashdata('success', 'User data delete.');

        # redirect page to list of user
        return $this->response->redirect(site_url('/crud'));
    }
}
