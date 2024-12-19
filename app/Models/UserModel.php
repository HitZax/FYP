<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model
{
    protected $table = 'users';
    
    protected $allowedFields = [
        'id',
        'fullname',
        'email',
        'password',
        'studentid',
        'role',
        'status',
        'last2FA'
    ];

    public function login($auth)
    {
        $sql = "SELECT * FROM users JOIN student ON users.studentid = student.studentid WHERE email = $auth OR studentid  = $auth ";
        return $this->db->query($sql)->getRowArray();
    }

    public function checkBruteForce($userId)
    {
        // Define the maximum number of allowed failed attempts
        $maxAttempts = 5;
    
        // Get the last attempt number for the user
        $lastAttempt = $this->db->table('audit_log')
                                ->where('user_id', $userId)
                                ->orderBy('timestamp', 'DESC')
                                ->get()
                                ->getRowArray();
    
        // Check if the last attempt number exceeds the maximum allowed attempts
        if ($lastAttempt && $lastAttempt['attempt_number'] >= $maxAttempts) {
            // Update the user's status to 'Inactive'
            $this->update($userId, ['status' => 'Inactive']);
        }
    }
}
