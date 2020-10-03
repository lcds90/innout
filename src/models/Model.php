<?php 

class Model {
    // Responsabilidade para apontar para tabela de BD
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = []; // não é estatica, pois cada istancia tem seu próprio

    // a partir do construtor passa o array feito na construção da instancia, e assim após passar os valores
    // as funções get e set servem para manipular-los
    function __construct($arr){
        $this->loadFromArray($arr);
    }

    public function loadFromArray($arr){
        if($arr){
            foreach($arr as $key => $value){
                $this->$key = $value;
            }
        }
    }
    public function __get($key){
        return $this->values[$key];
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
    }

    public function getValues() {
        return $this->values;
    }

    // função para retornar valores vindo de função que gera modelo de SQL
    public static function getOne($filters = [], $columns = '*'){
        $class = get_called_class();
        $result = static::getResultSetFromSelect($filters, $columns);
        return $result ? new $class($result->fetch_assoc()) : null;
    }

    // função para retornar valores vindo de função que gera modelo de SQL
    public static function get($filters = [], $columns = '*'){
        $objects = [];
        $result = static::getResultSetFromSelect($filters, $columns);
        if($result){
            $class = get_called_class();
            while($row = $result->fetch_assoc()){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    // função para gerar select de determinado modelo
    public static function getResultSetFromSelect($filters = [], $columns = '*'){
        $sql = "SELECT ${columns} FROM "
        . static::$tableName
        . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0){
            return null;
        } else {
            return $result;
        }
    }

    // lembrando que esse método será acessivel a partir da instancia, e é necessario pegar o atributo do objeto aonde a função é chamada
    // implode irá transformar as colunas que vem do array em string do sql
    public function insert(){
        // o foreach tem como função de passar por cada coluna com seus valores associados na ordem correta
        $sql = "INSERT INTO " . static::$tableName . " ("
        . implode(",", static::$columns) . ") VALUES (";
        foreach(static::$columns as $col){
            $sql .= static::getFormatedValue($this->$col) . ",";
        }
        $sql[strlen($sql) - 1] = ')';
        $id = Database::executeSQL($sql);
        $this->id = $id;
    }

    private static function getFilters($filters){
        $sql = '';
        if(count($filters) > 0){
            // Essa técnica serve para que toda consulta possua WHERE para conseguir colocar o AND
            $sql .= " WHERE 1 = 1"; // Essa condição não tem impacto pois retorna o valor que é TRUE
            foreach($filters as $column => $value){
            $sql .= " AND {$column} = " . static::getFormatedValue($value);
            }
        }
        return $sql;
    }

    // tratamento para identificar tipo certo para a query do SQL
    private static function getFormatedValue($value){
        if(is_null($value)){
            return "null";
        } elseif(gettype($value) === 'string'){
            return "'${value}'";
        } else {
            return $value;
        }
    }
}