<?php 

require_once(realpath(MODEL_PATH . '/User.php'));

class Login extends Model {
    
    // recebe post de requisição vindo de views/login.php 
    public function checkLogin(){
        $user = User::getOne(['email' => $this->email]);
        if($user){
            if(password_verify($this->password, $user->password)){
                return $user;
            } 
        }
        throw new Exception();
    }
}