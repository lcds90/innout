<?= ini_set('display_errors', 0); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/comum.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>In N' Out</title>
</head>

<body>

    <!-- Post será submetido na própria página, carregado no Controller -->
    <form class="form-login" action="#" method="post">
        <div class="login-card card">
            <div class="card-header bg-dark">
                <span class="font-italic welcome">Bem vindo!</span>
                <i class="icofont-travelling mr-2 text-white"></i>
                <span class="font-weight-light text-white">In</span>
                <span class="font-weight-bold mx-1 text-secondary"> N' </span>
                <span class="font-weight-light text-white">Out</span>
                <i class="icofont-runner-alt-1 ml-2 text-white"></i>
            </div>
            <div class="card-body">
                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                <div class="form-group">
                    <label for="email">E-mail</label>                  <!-- Aqui é carregado o parametro que vem do controller, através da função loadView -->
                    <input type="email" name="email" id="email" value="<?= $email ?>"
                    class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>"
                    placeholder="Informe o e-mail" autofocus="true" autocomplete="off">
                    <div class="invalid-feedback">
                    <?= $errors['email'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password"
                    class="form-control <?= $errors['password'] ? 'is-invalid' : '' ?>"
                    placeholder="Informe a senha" autocomplete="off">
                    <div class="invalid-feedback">
                    <?= $errors['password'] ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-outline-primary btn-block">Entrar</button>
            </div>
        </div>
    </form>
</body>

</html>