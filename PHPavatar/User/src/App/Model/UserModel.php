<?php

namespace App\Model;
use Core\DB\AbstractModel;
use \Exception;
use App\Entity\User;

class UserModel extends AbstractModel{


public function getUserByEmail( $email){
        return $this->db->queryOne('SELECT * FROM user WHERE email=?', [$email]);
}

public function insert(User $user){
        $userBdd = $this->getUserByEmail($user->getEmail());
        if($userBdd){
            throw new Exception('Cet email existe déjà!');
        }
    $sql = 'INSERT INTO user (firstname, lastname, email, password, createdAt, avatar)
                VALUES(?,?,?,?, NOW(),?)';
    $passwordHash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
    $this -> db -> executeQuery($sql, [$user->getFirstname(), $user->getLastname(), $user->getEmail(), $passwordHash, $user->getAvatar()]);
}

}