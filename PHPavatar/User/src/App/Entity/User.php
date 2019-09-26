<?php

namespace App\Entity;

class User{

    private $firstname;
    private $lastname;
    private $email;
    private $avatar;
    private $createdAt;
    private $password;

    public function __construct(array $data=[]){
        if(!empty($data)){
            $this->bind($data);
        }
    }

    private function bind(array $data){
        foreach ($data as $field=>$value){
            $setter = 'set'.ucfirst($field);
            if(method_exists($this, $setter)){
                $this->$setter($value);
            }
        }
    }

    public function getId():?int{
        return $this->id;
    }

    public function setId( $id){
        $this->id = $id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}