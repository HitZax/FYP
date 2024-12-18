<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TaskModel;
use App\Models\UserModel;
use App\Models\InternModel;
use App\Models\LogbookModel;
use App\Models\StudentModel;
use App\Models\LecturerModel;
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
                                    ->select('student.*, lecturer.lname as lecturer_name')
                                    ->findAll();
        } else {
            $students = $studentModel->join('lecturer', 'student.lid = lecturer.lid', 'left')
                                    ->select('student.*, lecturer.lname as lecturer_name')
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

    public function assignLecturer()
    {
        $sid = $this->request->getPost('sid');
        $lid = $this->request->getPost('lecturer');

        $logbookModel = new \App\Models\LogbookModel();
        $logbook = $logbookModel->where('sid', $sid)->first();

        if ($logbook) {
            $logbookModel->update($logbook['lbid'], ['lid' => $lid]);
        } else {
            $logbookModel->insert(['sid' => $sid, 'lid' => $lid]);
        }

        return redirect()->back()->with('message', 'Lecturer assigned successfully');
    }

    public function lecturerlist()
    {
        $lecturerModel = new \App\Models\LecturerModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $lecturers = $lecturerModel->like('lname', $search)
                                       ->orLike('lemail', $search)
                                       ->findAll();
        } else {
            $lecturers = $lecturerModel->findAll();
        }

        $logbookModel = new \App\Models\LogbookModel();
        foreach ($lecturers as &$lecturer) {
            $lecturer['total_students'] = $logbookModel->where('lid', $lecturer['lid'])->countAllResults();
        }

        $data = [
            'title' => 'Lecturer List',
            'lecturers' => $lecturers,
            'search' => $search
        ];

        return view('admin/lecturer_list', $data);
    }

}