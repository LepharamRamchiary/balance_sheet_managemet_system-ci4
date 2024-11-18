<?php
namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    // The table name
    protected $table = 'wallet';

    // Method to get the balance of a user
    public function getBalance($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $userId);
        $builder->orderBy('created_at', 'DESC');
        $result = $builder->get();

        if ($result->getNumRows() > 0) {
            return $result->getRow();
        } else {
            return false;
        }
    }

    // Method to process a transaction (deposit or withdrawal)
    public function processTransaction($userId, $amount, $transactionType)
    {
        // Retrieve the wallet of the user
        $wallet = $this->getBalance($userId);

        // If no wallet found, create a new wallet entry
        if (!$wallet) {
            $builder = $this->db->table($this->table);
            $data = [
                'user_id' => $userId,
                'balance' => 0.00,  // Default balance is 0.00
                't_type' => $transactionType,
                'amount' => $amount,
            ];
            $builder->insert($data);  // Insert initial transaction
            $wallet = $this->getBalance($userId);  // Retrieve updated wallet info
        }

        // Process deposit and withdrawal logic
        if ($transactionType === 'deposit') {
            $newBalance = $wallet->balance + $amount;  // Add the amount to the balance
        } elseif ($transactionType === 'withdraw') {
            // Ensure sufficient funds for withdrawal
            if ($wallet->balance < $amount) {
                return false;  // Insufficient funds
            }
            $newBalance = $wallet->balance - $amount;  // Subtract the amount from the balance
        } else {
            return false;  // Invalid transaction type
        }

        // Update the wallet balance in the database
        $builder = $this->db->table($this->table);
        $transactionData = [
            'user_id' => $userId,
            'balance' => $newBalance,
            't_type' => $transactionType,
            'amount' => $amount,
        ];
        $builder->insert($transactionData);  // Insert the new transaction record

        return true;  // Return success
    }

    // Method to get all transactions for a user
    public function getTransactionsByUserId($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $userId);
        $builder->orderBy('created_at', 'DESC');
        $result = $builder->get();

        if ($result->getNumRows() > 0) {
            return $result->getResult();  // Return all transactions for the user
        } else {
            return false;  // No transactions found
        }
    }
}

?>