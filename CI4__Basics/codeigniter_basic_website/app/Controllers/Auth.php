<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\UserModel;
use \App\Libraries\Hash;

class Auth extends BaseController
{

    // Enabling features

    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    /** 
     * Save new user to database
     */
    public function registerUser()
    {
        $validated = $this->validate([
            'name'=> [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Your full name is required.',
                    'min_length' => 'Name must be 5 characters long.'
                ]
            ],
            'email'=> [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required.',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required.',
                    'min_length' => 'Password must be 5 characters long.',
                    'max_length' => 'Password cannot be longer that 20 characters.',
                ]
            ],
            'passwordConf'=> [
                'rules' => 'required|min_length[5]|max_length[20]|matches[password]',
                'errors' => [
                    'required' => 'Your password is required.',
                    'min_length' => 'Password must be 5 characters long.',
                    'max_length' => 'Password cannot be longer that 20 characters.',
                    'matches' => 'Confirm password must match the password.',
                ]
            ],
        ]);

        if(!$validated){
            return view('auth/register', ['validation' => $this->validator]);
        }

        // Here we save the user
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConf = $this->request->getPost('passwordConf');

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::encrypt($password)
        ];

        // Storing the data
        $userModel = new UserModel();

        $query = $userModel->insert($data);

        if(!$query)
        {
            return redirect()->back()->with('fail', 'Saving user failed');
        }
        else
        {
            session()->setFlashData('success', 'Registration Success12333!');
            return view('auth/register');
        }

    }

    /**
     * User login method
     */
    public function loginUser(){

        // Validating user input
        $validated = $this->validate([
            'email'=> [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required.',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required.',
                    'min_length' => 'Password must be 5 characters long.',
                    'max_length' => 'Password cannot be longer that 20 characters.',
                ]
            ],
            
        ]);

        if(!$validated){
            return view('auth/login', ['validation' => $this->validator]);
        }
        else
        {
            // Checking user details in database
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // create model
            $userModel = new UserModel();
            $userInfo = $userModel->where('email', $email)->First();

            // check if matches on database
            $checkPassword = Hash::check($password, $userInfo['password']);

            if(!$checkPassword)
            {
                session()->setFlashData('fail', 'Incorrect password provided');
                return redirect()->to('auth');
            }
            else
            {
                // Process user info
                $userId = $userInfo['id'];

                session()->set('loggedInUser', $userId);
                return redirect()->to('/dashboard');
            }

            
        }


    }

    /**
     * Upload user Image
     */
    public function uploadImage()
    {
        try
        {
            $loggedInUserId = session()->get('loggedInUser');
            $config['upload_path'] = getcwd().'/images';
            $imageName = $this->request->getFile('userImage')->getName();
    
            // if Directory not present the create
            if(!is_dir( $config['upload_path'] ))
            {
                mkdir( $config['upload_path'], 0777);
            }
    
            // Get image
            $img = $this->request->getFile('userImage');
            if(!$img->hasMoved() && $loggedInUserId)
            {
                $img->move($config['upload_path'], $imageName);
    
                $data = [
                    'avatar' => $imageName,
                ];
    
                $userModel = new Usermodel();
                $userModel->update($loggedInUserId, $data);
    
                // session message
                return redirect()->to('dashboard/index')->with('notification',
                    'Image upload successfully'
                );
            } 
            else 
            {
                // session message
                return redirect()->to('dashboard/index')->with('notification',
                'Image upload failed'
                );
            }
        }

        catch(Exceptin $e)
        {
            echo $e->getMessage();
        }

        


    }

    /**
     * Log out the user
     */
    public function logout()
    {
        if(session()->has('loggedInUser'))
        {
            session()->remove('loggedInUser');
        }

        return redirect()->to('/auth?access=loggedout')->with('fail', 'You are logged out.');
    }

    
}
