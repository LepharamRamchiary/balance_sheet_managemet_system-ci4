<?php

namespace App\Models;

use \CodeIgniter\Model;

class KycModel extends Model
{
    public $table = 'kyc';
    public function insertKyc($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function getKycByUserId($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $userId);
        $result = $builder->get();

        if (count($result->getResultArray()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

}
