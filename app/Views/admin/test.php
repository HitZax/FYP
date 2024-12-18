<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TasksController extends BaseController
{
    public function getUserTasks($userId)
    {
        // Create a TaskModel instance
        $model = new TaskModel();

        // Retrieve tasks using mySQL query
        $query = $model->db->table('tasks')
                          ->where('user_id', $userId)
                          ->get();

        // Fetch the results as an array of objects
        $tasks = $query->getResultArray();

        // Return the tasks as JSON response
        return $this->response->setJSON($tasks);
    }
}

<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TasksController extends BaseController
{
    public function getUserTasks($userId)
    {
        // Create a TaskModel instance
        $model = new TaskModel();

        // Retrieve tasks associated with the specified user ID
        $tasks = $model->where('user_id', $userId)->findAll();

        // You can customize the query further to include specific fields, sorting, or filtering as needed.
        // For example:
        // $tasks = $model->select('id, title, description')->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();

        // Return the tasks as JSON response
        return $this->response->setJSON($tasks);
    }
}