<?php
require_once PROJECT_ROOT_PATH . "/model/database.class.php";

class UserModel extends Database
{
    public function getUser($userid)
    {
        return $this->select("SELECT * FROM user WHERE user_id = ?", "i", [$userid]);
    }

    public function deleteUser($userid)
    {
        return $this->modify("DELETE FROM user WHERE user_id = ?", "i", [$userid]);
    }

    public function createUser($user)
    {
        return $this->modify("INSERT INTO user (user_email) VALUES (?)", "s", [$user->user_email]);
    }

    public function userExists($userid){
        return count($this->getUser($userid)) > 0;
    }
}
