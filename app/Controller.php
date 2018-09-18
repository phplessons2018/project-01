<?php
namespace App;

class Controller
{
    public function connect()
    {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'street' => $_POST['street'],
            'home' => $_POST['home'],
            'part' => $_POST['part'],
            'appt' => $_POST['appt'],
            'floor' => $_POST['floor'],
            'comment' => $_POST['comment']
        ];

        $postForm = new Model();
        $postForm->post($data);
        $postForm->swift($data);
    }
}
