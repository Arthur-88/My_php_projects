<?php
namespace Models;
class User extends Model
{
    protected $table = 'users';
    
    public function getById($id)
    {
        $stmt = $this->mysql->prepare('SELECT * FROM '. $this->table .' WHERE `id`=?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }
    public function authById($id,$pass)
    {
        var_dump($id,$pass);
        $stmt = $this->mysql->prepare('SELECT * FROM '. $this->table .' WHERE id=:id AND Pass=:pass');
        $stmt->execute([':id'=>$id,':pass'=>$pass]);
        var_dump($stmt->fetch());
        return $stmt->fetch();
    }
        
    public function registerUser($name,$role,$pass)
    {
        $stmt = $this->mysql->prepare('INSERT INTO '. $this->table .' (Name, Role, Pass) values (:name, :role, :pass)');
        $stmt->execute([':name'=>$name,':role'=>$role,':pass'=>$pass]);
        return $this->mysql->lastInsertId();
    }
        
    public function updateUser($id,$name,$role,$pass)
    {
        $oldName = $this->getById($id);
        $new_stmt = $this->mysql->prepare('UPDATE '. $this->table .' set Name = :name, Role = :role, Pass = :pass where id = :id');
        $new_stmt->execute([':name'=>$name,':role'=>$role,':pass'=>$pass, ':id'=>$id]);
        return $oldName['Name'];
    }
    
    public function deleteUser($id)
    {
        $oldName = $this->getById($id);
        $stmt = $this->mysql->prepare('DELETE FROM '. $this->table .' WHERE id = :id');
        $stmt->execute([':id'=>$id]);
        return $oldName['Name'];
    }
}