<?php
namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\InternModel;
use CodeIgniter\Controller;
use App\Models\LogbookModel;
use App\Models\StudentModel;
use App\Models\AuditLogModel;
use App\Models\LecturerModel;
use App\Models\ActiveSessionModel;
use App\Controllers\BaseController;

class Admin extends Controller
{
    public function dashboard()
    {
        $internmodel = new InternModel();
        $intern = $internmodel->detail(session()->get('id'));
    
        // Get current and end time
        $now = date("Y-m-d"); 
        $startdate = $intern->startdate ? date("Y-m-d", strtotime($intern->startdate)) : "None";
        $enddate = $intern->enddate ? date("Y-m-d", strtotime($intern->enddate)) : "None";
    
        // Calculate days remaining
        $daysRemaining = ($enddate !== "None") ? (strtotime($enddate) - strtotime($now)) / (60 * 60 * 24) : "None";
    
        // Calculate current week
        $currentWeek = ($startdate !== "None" && $startdate !== "None") ? ceil((strtotime($now) - strtotime($startdate)) / (60 * 60 * 24 * 7)) : "None";
    
        // Get total number of lecturers
        $lecturerModel = new LecturerModel();
        $totalLecturers = $lecturerModel->countAllResults();
    
        // Get total number of students
        $studentModel = new StudentModel();
        $totalStudents = $studentModel->countAllResults();
    
        $data = [
            'title' => 'Dashboard Admin',
            'intern' => $intern,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'daysRemaining' => $daysRemaining,
            'currentWeek' => $currentWeek,
            'totalLecturers' => $totalLecturers,
            'totalStudents' => $totalStudents,
        ];
    
        return view('admin/dashboard', $data);
    }

    public function changeEndDate()
    {
        $newEndDate = $this->request->getPost('endDate');
        $internModel = new InternModel();
        $internModel->updateAllEndDates($newEndDate);

        return redirect()->to(base_url('admin/dashboard'))->with('status', 'End date updated successfully');
    }

    public function changeStartDate()
    {
        $newStartDate = $this->request->getPost('startDate');
        $internModel = new InternModel();
        $internModel->updateAllStartDates($newStartDate);

        return redirect()->to(base_url('admin/dashboard'))->with('status', 'Start date updated successfully');
    }

    public function studentlist()
    {
        $studentModel = new \App\Models\StudentModel();
        $search = $this->request->getGet('search');
    
        if ($search) {
            $students = $studentModel->like('sname', $search)
                                    ->orLike('studentid', $search)
                                    ->orLike('sprogram', $search)
                                    ->join('lecturer', 'student.lid = lecturer.lid', 'left')
                                    ->join('users', 'student.id = users.id', 'left')
                                    ->select('student.*, lecturer.lname as lecturer_name, users.status as user_status')
                                    ->findAll();
        } else {
            $students = $studentModel->join('lecturer', 'student.lid = lecturer.lid', 'left')
                                    ->join('users', 'student.id = users.id', 'left')
                                    ->select('student.*, lecturer.lname as lecturer_name, users.status as user_status')
                                    ->findAll();
        }
    
        $lecturerModel = new \App\Models\LecturerModel();
        $lecturers = $lecturerModel->findAll();
    
        $data = [
            'title' => 'Student List',
            'students' => $students,
            'lecturers' => $lecturers,
            'search' => $search
        ];
    
        return view('admin/student_list', $data);
    }

    public function reset($userId)
    {
        $auditLogModel = new AuditLogModel();
        $userModel = new UserModel();
        $activeSessionModel = new ActiveSessionModel();
    
        // Create a new entry in the audit log with the action of "reset"
        $auditLogModel->insert([
            'user_id' => $userId,
            'action' => 'Reset',
            'status' => 'Success',
            'attempt_number' => 0,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent(),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    
        // Change the user's status to active
        $userModel->update($userId, ['status' => 'Active']);
    
        // Delete the sessions belonging to the user
        $activeSessions = $activeSessionModel->where('user_id', $userId)->findAll();
        foreach ($activeSessions as $session) {
            $activeSessionModel->delete($session['id']);
        }
    
        return redirect()->back()->with('message', 'User reset successfully');
    }

    public function assignLecturer()
    {
        $studentId = $this->request->getPost('student_id');
        $lecturerId = $this->request->getPost('lecturer_id');
    
        $studentModel = new \App\Models\StudentModel();
        $logbookModel = new \App\Models\LogbookModel();
        $chatModel = new \App\Models\ChatModel();
        $lecturerModel = new \App\Models\LecturerModel();
    
        // Update the lecturer ID in the student table
        $studentModel->update($studentId, ['lid' => $lecturerId ? $lecturerId : null]);
    
        // Update the lecturer ID in the logbook table
        $logbookModel->where('sid', $studentId)->set(['lid' => $lecturerId ? $lecturerId : null])->update();
    
        // Get the lecturer's user ID from the lecturer table
        $lecturer = $lecturerModel->find($lecturerId);
        $lecturerUserId = $lecturer ? $lecturer['id'] : null;
    
        // Update the user ID in the chat table
        $chatModel->where('sid', $studentId)->set(['id' => $lecturerUserId])->update();
    
        return redirect()->to('/admin/student')->with('message', 'Lecturer assignment updated successfully');
    }

    public function deleteStudent($sid)
    {
        $studentModel = new \App\Models\StudentModel();
        $userModel = new \App\Models\UserModel();
        $logbookModel = new \App\Models\LogbookModel();
        $chatModel = new \App\Models\ChatModel();
        $internModel = new \App\Models\InternModel();

        // Get the student record
        $student = $studentModel->where('sid', $sid)->first();

        if ($student) {
            // Delete the user record
            $userModel->delete($student['id']);

            // Delete the student record
            $studentModel->where('sid', $sid)->delete();

            // Delete the logbook records
            $logbookModel->where('sid', $sid)->delete();

            // Delete the chat records
            $chatModel->where('sid', $sid)->delete();

            // Delete the intern records
            $internModel->where('sid', $sid)->delete();

            return redirect()->to('/admin/student')->with('message', 'Student and related records deleted successfully');
        } else {
            return redirect()->to('/admin/student')->with('error', 'Student not found');
        }
    }

    public function lecturerlist()
    {
        $lecturerModel = new \App\Models\LecturerModel();
        $search = $this->request->getGet('search');
    
        if ($search) {
            $lecturers = $lecturerModel->like('lname', $search)
                                       ->orLike('lemail', $search)
                                       ->join('users', 'lecturer.id = users.id', 'left')
                                       ->select('lecturer.*, users.status as user_status')
                                       ->findAll();
        } else {
            $lecturers = $lecturerModel->join('users', 'lecturer.id = users.id', 'left')
                                       ->select('lecturer.*, users.status as user_status')
                                       ->findAll();
        }
    
        $studentModel = new \App\Models\StudentModel();
        foreach ($lecturers as &$lecturer) {
            $lecturer['total_students'] = $studentModel->where('lid', $lecturer['lid'])->countAllResults();
            $lecturer['students'] = $studentModel->where('lid', $lecturer['lid'])->findAll();
        }
    
        $data = [
            'title' => 'Lecturer List',
            'lecturers' => $lecturers,
            'search' => $search
        ];
    
        return view('admin/lecturer_list', $data);
    }

    public function deleteLecturer($lid)
    {
        $lecturerModel = new \App\Models\LecturerModel();
        $userModel = new \App\Models\UserModel();
        $internModel = new \App\Models\InternModel();
    
        // Get the lecturer record
        $lecturer = $lecturerModel->where('lid', $lid)->first();
    
        if ($lecturer) {
            // Delete the user record
            $userModel->delete($lecturer['id']);
    
            // Delete the lecturer record
            $lecturerModel->where('lid', $lid)->delete();
    
            // Delete the intern records
            $internModel->where('id', $lecturer['id'])->delete();
    
            return redirect()->to('/admin/lecturer')->with('message', 'Lecturer and related records deleted successfully');
        } else {
            return redirect()->to('/admin/lecturer')->with('error', 'Lecturer not found');
        }
    }

    public function auditLog()
    {
        $auditLogModel = new AuditLogModel();
        $search = $this->request->getGet('search');
    
        // Get total number of active sessions
        $activeSessionModel = new ActiveSessionModel();
        $totalActiveSessions = $activeSessionModel->countAllResults();
    
        // Fetch active sessions with user details
        $activeSessions = $activeSessionModel->select('active_session.*, users.fullname')
                                             ->join('users', 'active_session.user_id = users.id')
                                             ->findAll();
    
        if ($search) {
            $logs = $auditLogModel->select('audit_log.*, users.fullname, users.email, users.role, users.status as user_status, users.last2FA')
                                  ->join('users', 'audit_log.user_id = users.id')
                                  ->like('users.fullname', $search)
                                  ->orLike('audit_log.action', $search)
                                  ->orLike('audit_log.status', $search)
                                  ->orLike('audit_log.timestamp', $search)
                                  ->orderBy('audit_log.timestamp', 'DESC')
                                  ->findAll();
        } else {
            $logs = $auditLogModel->select('audit_log.*, users.fullname, users.email, users.role, users.status as user_status, users.last2FA')
                                  ->join('users', 'audit_log.user_id = users.id')
                                  ->orderBy('audit_log.timestamp', 'DESC')
                                  ->findAll();
        }
    
        $data = [
            'title' => 'Audit Log',
            'logs' => $logs,
            'search' => $search,
            'totalActiveSessions' => $totalActiveSessions,
            'activeSessions' => $activeSessions,
        ];
    
        return view('admin/audit_log', $data);
    }

    public function getActiveSessions()
    {
        $activeSessionModel = new ActiveSessionModel();
        $activeSessions = $activeSessionModel->select('active_session.*, users.fullname')
                                             ->join('users', 'active_session.user_id = users.id')
                                             ->findAll();
    
        return $this->response->setJSON($activeSessions);
    }

    public function deleteActiveSession($id)
    {
        $activeSessionModel = new ActiveSessionModel();
        $activeSessionModel->delete($id);
    
        return redirect()->to('/admin/auditlog')->with('message', 'Session deleted successfully');
    }
}