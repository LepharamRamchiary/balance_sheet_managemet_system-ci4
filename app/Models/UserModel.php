<?php
namespace App\Models;
use \CodeIgniter\Model;

class UserModel extends Model {
    
    public $table = 'users';

    public function getTotalUsers()
    {
        $builder = $this->db->table($this->table);
        return $builder->countAllResults();
    }

    public function getActiveUsers()
    {
        $builder = $this->db->table($this->table);
        $builder->where('status', 'active');
        return $builder->countAllResults();
    }

    public function getBlockedUsers()
    {
        $builder = $this->db->table($this->table);
        $builder->where('status', 'blocked');
        return $builder->countAllResults();
    }
}
