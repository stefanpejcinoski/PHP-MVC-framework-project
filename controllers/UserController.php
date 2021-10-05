<?php

namespace Controllers;

use Exception;
use Framework\Classes\Authentication;
use Framework\Classes\Redirect;
use Framework\Classes\Request;
use Framework\Classes\Session;
use Framework\Classes\Validator;
use Models\Framework;
use Models\Technology;
use Models\User;
/**
 * Contains simple login/register functionality for the code test task
 */


 class UserController
 {
     public function registerView(Request $request)
     {
         $userModel = new User;
         $frameworkModel = new Framework;
         $technologyModel = new Technology;
         $userTypes = $userModel->getTypes();
         $frameworks = $frameworkModel->getAll();
         $technologies = $technologyModel->getAll();
         $allTypesArray = [];
         foreach($userTypes as $type){
             array_push($allTypesArray, ['value'=>json_encode(['type'=>$type['id']]), 'name'=>$type['name']]);
             foreach($technologies as $technology){
                 if($type['id'] == $technology['type_id']){
                     array_push($allTypesArray, ['value'=>json_encode(['type'=>$type['id'], 'technology'=>$technology['id']]), 'name'=>$technology['name']]);
                 }
                 foreach($frameworks as $framework){
                     if($type['id'] == $technology['type_id']  && $technology['id'] == $framework['technology_id']){
                         array_push($allTypesArray, ['value'=>json_encode(['type'=>$type['id'], 'technology'=>$technology['id'], 'framework'=>$framework['id']]), 'name'=>$framework['name']]);
                     }
                 }
             }
         }
        return view('register', ['types'=>$allTypesArray]);
     } 
     public function loginView(Request $request)
     {
         $loginForm = viewString('loginform');
        return view('login', ['appname'=>config('app', 'app_name'), 'login'=>$loginForm]);
     }

     public function register(Request $request)
     {
         $rules = [
             "email"=>["required"],
             "name"=>["required"],
             "password"=>["required"],
             "password_confirm"=>['required', 'equal:password'],
             "user-type"=>['required']
         ];

         Validator::getValidator($rules)->validateRequest($request);
         $type = $request->getKey('user-type');
         $type = json_decode($type, true);
         $user = new User;
         $status = $user->createUser($request->getKey('name'), $request->getKey('email'), $request->getKey('password'), $type['type'], $type['technology'], $type['framework']);
         if(!$status)
            throw new Exception("User query failed");
         Session::append('messages', 'Registration succesful');
         return Redirect::redirectHome();
     }

     public function login(Request $request)
     {
        $rules = [
            "email"=>["required"],
            "password"=>["required"],
        ];

        Validator::getValidator($rules)->validateRequest($request);
      
        $user = new User;
        $userDataQuery = $user->getUser($request->getKey('email'));

        $userData = $userDataQuery['results'];
        if(!Authentication::makeAuth()->authenticateUser($request->getKey('password'), $userData['password'], $userData['id']))
        {
            Session::append('errors', "Wrong password");
            return Redirect::redirectWithErrors(422);
        }
   
        Session::append('messages', "Welcome ".$userData['results']['username']."!");
        return Redirect::redirectHome();
     }

     public function logout (Request $request)
     {
         Authentication::makeAuth()->revokeAuthentication();
         Session::append('messages', "Logged out succesfully");
         Redirect::redirectHome();
     }

 }