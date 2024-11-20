<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    // The table name
    protected $table = 'wallet';
    public function getBalance($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $userId);
        $builder->where('status', 'completed');
        $builder->orderBy('created_at', 'DESC');
        $result = $builder->get();

        if ($result->getNumRows() > 0) {
            return $result->getRow();
        } else {
            return false;
        }
    }

    public function getTransactionsByUserId($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $userId);
        $builder->orderBy('created_at', 'DESC');
        $result = $builder->get();

        if ($result->getNumRows() > 0) {
            return $result->getResult();
        } else {
            return false;
        }
    }

    public function processTransaction($transactionId, $userId, $amount, $transactionType)
    {
        $builder = $this->db->table($this->table);
        
        // Start transaction
        $this->db->transStart();

        try {
            // Get current wallet balance
            $currentBalance = $this->getBalanceByUserId($userId);

            // Calculate new balance based on transaction type
            if ($transactionType === 'deposit') {
                $newBalance = $currentBalance + $amount;
            } elseif ($transactionType === 'withdraw') {
                if ($currentBalance < $amount) {
                    return false; // Insufficient funds
                }
                $newBalance = $currentBalance - $amount;
            } else {
                return false; // Invalid transaction type
            }

            // Update the transaction status to completed
            $builder->where('id', $transactionId);
            $builder->update([
                'status' => 'completed',
                'balance' => $newBalance,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Create a new transaction record with the updated balance
            $transactionData = [
                'user_id' => $userId,
                'balance' => $newBalance,
                't_type' => $transactionType,
                'amount' => $amount,
                'status' => 'completed',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $builder->insert($transactionData);

            // Commit transaction
            $this->db->transComplete();

            return $this->db->transStatus();
        } catch (\Exception $e) {
            log_message('error', 'Transaction processing failed: ' . $e->getMessage());
            return false;
        }
    }
    

    public function transactionRequest($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

   


    public function getBalanceByUserId($userId)
    {
        $result = $this->db->table($this->table)
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        return $result ? $result->balance : 0.00;
    }
    

    public function getTransactionById($transactionId)
    {
        return $this->db->table($this->table)
            ->where('id', $transactionId)
            ->get()
            ->getRow();
    }

    public function getAllWallets()
    {
        $builder = $this->db->table($this->table);
        $builder->select('wallet.*, users.username, users.email');
        $builder->join('users', 'wallet.user_id = users.id');
        $builder->where('wallet.status', 'pending');
        $builder->orderBy('wallet.created_at', 'DESC');
        return $builder->get()->getResultArray();
    }
}
