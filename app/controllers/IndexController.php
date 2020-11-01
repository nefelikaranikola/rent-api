<?php

namespace MyApp\Controllers;

//Guest Controller
class IndexController
{
    public function initialize()
    {
        $this->view->setTemplateAfter('guestLayout');
        $this->tag->setTitle('Guest User'); //By default Page title
    }

    public function indexAction()
    {
        $this->tag->prependTitle('Index -- '); //Current Page Title
    }

    //Create login page
    public function loginAction() {

        if (!$this->request->isPOST()) {
            return;
        }

        $dataSent = $this->request->getPOST();
        $email = $dataSent['email'];
        $password = md5($dataSent['password']);

        //$user-> new MyApp\Models\Users();
        //Other Method

        $user = \MyApp\Models\Users::findFirst([
            'conditions' => 'email = ?1 and password = ?2',
            'bind' => [
                1 => $email,
                2 => $password
            ]
        ]);

        if (!$user) {
            echo "Invalid Credentials";
            $this->view->disable();
        }

        //active
        if ($user->status != 1) {
            echo "User Disable";
            $this->view->disable();
            return;
        }

        //Set Session
        $this->session->set("AUTH_ID", $user->id);
        $this->session->set("AUTH_NAME", $user->name);
        $this->session->set("AUTH_EMAIL", $user->email);
        $this->session->set("AUTH_ROLE", $user->role);
        $this->session->set("AUTH_CREATED", $user->created);
        $this->session->set("AUTH_UPDATED", $user->updated);
        $this->session->set("IS_LOGIN", 1);

        if ($user->role === 1) {
            //redirect user panel
        } else if ($user->role === 2) {
            //redirect admin panel
        } else {
            //exit;
        }

        //return $this->response->redirect('index/login');
    }

    //Create Signup page
    /*public function signupAction() {
        if ($this->request->isPOST()) {

            $user = new Users(); //Users Model Object

            $user->setName($this->request->getPOST('name'));
            $user->setEmail($this->request->getPOST('email'));
            $user->setRole($this->request->getPOST('role'));
            $user->setPassword (md5($this->request->getPOST('password'))); //MD5
            $user->setActive(1);
            $user->setCreated(time());
            $user->setUpdated(time());

            $output = $user->save();

            if ($output) {
                echo "Thanks for registering!";
                $this->view->disable(); //View page disable
            } else {
                //Show Validation Errors

                $message = $user->getMessage(); {
                    echo $message->getMessage(), "<br>";
                }

                $this->view->disable(); //View page disable
            }
        }
    }*/


