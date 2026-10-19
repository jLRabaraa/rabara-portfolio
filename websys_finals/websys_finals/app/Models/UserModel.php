<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 
        'email', 
        'password', 
        'user_role', 
        'image', 
        'status',
        'created_at', 
        'updated_at'
    ];

    /**
     * Retrieves a user by email.
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Retrieves all customers.
     */
    public function getCustomers()
    {
        return $this->where('user_role', 'user')->findAll();
    }
}
