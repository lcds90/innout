<?php 

require_once(realpath(MODEL_PATH . '/Model.php'));

class User extends Model {
    // Extendendo de Model, aqui é especificação de tabela e suas colunas
    protected static $tableName = 'users';
    protected static $columns = [
        'id',
        'name',
        'password',
        'email',
        'start_date',
        'end_date',
        'is_admin',
    ];
}