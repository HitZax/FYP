<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Lecturer implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (empty($arguments)) 
        {
            return;
        }
    
        if (!session()->get('role') == "Lecturer")
        {
            return redirect()->to('/dashboard');
        }

        
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}