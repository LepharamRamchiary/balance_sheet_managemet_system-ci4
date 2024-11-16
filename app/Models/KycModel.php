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

        // Return the first row if data exists, else return false
        if (count($result->getResultArray()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }



    // // Method to get KYC details by user ID
    // public function getKycByUserId($userId)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->where('user_id', $userId);
    //     $result = $builder->get();

    //     // Return the first row if data exists, else return false
    //     if (count($result->getResultArray()) > 0) {
    //         return $result->getRowArray();
    //     } else {
    //         return false;
    //     }
    // }

    // // Method to update KYC status
    // public function updateKycStatus($id, $status, $remarks = '')
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->set('kyc_status', $status);
    //     $builder->set('remarks', $remarks);
    //     $builder->where('id', $id);
    //     return $builder->update(); // Returns true if update successful, false otherwise
    // }
}
