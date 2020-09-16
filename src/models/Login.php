<?php 
loadModel('User');

class Login extends Model {
    
    // recebe post de requisição vindo de views/login.php 
    public function checkLogin(){
        $user = User::getOne(['email' => $this->email]);
        if($user){

            if($user->end_date){
                throw new AppException('Usuário inativo');
            }

            if(password_verify($this->password, $user->password)){
                return $user;
            } 
        }
        throw new AppException('Dados inválidos');
    }
}