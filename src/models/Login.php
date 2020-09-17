<?php 
loadModel('User');

class Login extends Model {
    
    // identificação do tipo de validação
    public function validate(){
        $errors = [];

        if(!$this->email){
            $errors['email'] = 'E-mail é um campo obrigatório';
        }
        if(!$this->password){
            $errors['password'] = 'Por favor, informe a senha';
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    // recebe post de requisição vindo de views/login.php 
    public function checkLogin(){
        
        $this->validate();
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