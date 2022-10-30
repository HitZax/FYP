<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model
{
    protected $table = 'users';
    
    protected $allowedFields = [
        'fullname',
        'email',
        'password',
        'studentid',
        'role'
    ];

    public function login($auth)
    {
        $sql = "SELECT * FROM users JOIN student ON users.studentid = student.studentid WHERE email = $auth OR studentid  = $auth ";
        return $this->db->query($sql)->getRowArray();
    }
}
