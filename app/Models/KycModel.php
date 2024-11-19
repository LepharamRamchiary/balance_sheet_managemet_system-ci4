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

    public function getAllKycRequests()
    {
        $builder = $this->db->table($this->table);
        $builder->select('kyc.id, users.username as name, users.email, kyc.kyc_status, kyc.doc');
        $builder->join('users', 'users.id = kyc.user_id');
        $builder->orderBy('kyc.created_at', 'DESC');
        $result = $builder->get();

        return $result->getResultArray();
    }

    public function approveKyc($id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update(['kyc_status' => 'approved']);
    }

    public function rejectKyc($id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update(['kyc_status' => 'rejected']);
    }

    public function deleteKycById($id)
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }

    public function updateKyc($userId, $kycData)
    {
        // Ensure $kycData is not empty
        if (empty($kycData)) {
            return false;
        }

        // Remove any null or empty values
        $kycData = array_filter($kycData, function ($value) {
            return $value !== null && $value !== '';
        });

        // Check if there are any valid data to update
        if (empty($kycData)) {
            return false;
        }

        // Use query builder to ensure update works
        return $this->db->table($this->table)
            ->where('user_id', $userId)
            ->update($kycData);
    }
}
