<?php
/**
 * 三私一公创建
 */
class Four 
{
    //私有的属性
    private $pdo;

    /**
     * Four constructor.
     * 私有的公共
     */
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=forge','root','root');
    }

    /**
     * 私有的克隆
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
    public function create(){

    }

    /**
     * @param $table
     * @param null $where
     */
    public function select($table,$where = null){
        if ($where == null){
            $query = "select * from $table";
        }
        $query = "select * from $table where id='$where'";
        return $this->pdo->query($query)->execute();
    }

    /**
     * @param $id
     * @param $table
     */
    public function find($id,$table){
        $query = "select * from $table where id='$id'";
        return $this->pdo->query($query)->execute();
    }

    /**
     * @param $table
     * @param $id
     */
    public function delete($table,$id){
        return $this->pdo->query("delete from $table where id='$id'")->execute();
    }

    /**
     * @param $id
     * @param $options
     */
    public function update($table,$id,$options){
        $query = "update `$table` set where option = '$options' where identity ='$id'";
        return $this->pdo->query($query)->execute();
    }
}