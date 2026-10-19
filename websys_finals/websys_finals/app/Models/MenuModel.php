<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'price', 'image'];

    public function getMenuItems($search = null)
    {
        $query = $this->db->table($this->table);
        if ($search) {
            $query->like('name', $search);
        }

        return $query->get()->getResultArray();
    }
}
