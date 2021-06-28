<?php

class Admin extends Controller
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = $this->model('Task');
    }

    public function index($page_id = 1){
        if (!isset($_SESSION['login'])){
            redirect();
        }

        $count = $this->taskModel->count();
        if ($count >= 1){
            $limit = 3;
            $sort = 'created_at DESC';
            if(isset($_GET['sort'])){
                switch ($_GET['sort']){
                    case 'name':
                        $sort = 'user_name ASC';
                        break;
                    case 'dname':
                        $sort = 'user_name DESC';
                        break;
                    case 'email':
                        $sort = 'user_email ASC';
                        break;
                    case 'demail':
                        $sort = 'user_email DESC';
                        break;
                    case 'fulfilled':
                        $sort = 'fulfilled ASC';
                        break;
                    case 'dfulfilled':
                        $sort = 'fulfilled DESC';
                        break;
                    default:
                        $sort = 'created_at DESC';
                }
            }
            $page_id = is_null($page_id) ? 1 : intval($page_id);
            if (empty($page_id) || $page_id < 0) $page_id = 1;
            $pages  = ceil(intval($count) / $limit);
            if ($page_id > $pages) redirect();
            $offset = ($page_id - 1) * $limit;
            if($tasks = $this->taskModel->getTasks($offset, $limit, $sort)){
                $data = [
                    'tasks' => $tasks,
                    'pagination' => [$page_id, $pages]
                ];
                $this->view('admin/index', $data);
            }
        }
        $data = [
            'tasks' => '',
            'pagination' => ''
        ];
        $this->view('admin/index', $data);
    }

    public function login()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = [
                'login' => trim($_POST['login']),
                'password' => trim($_POST['password']),
                'login_err' => '',
                'password_err'  => '',
            ];

            if($data['login'] !== ADMINLOGIN){
                $data['login_err'] = 'Неправильный Логин';
            }

            if($data['password'] !== ADMINPASSWORD ){
                $data['password_err'] = 'Неправильный Пароль';
            }

            if(empty($data['login_err']) && empty($data['password_err'])){
                $_SESSION['login'] = $data['login'];
                flash('login_success', 'Вы вошли Как Админ');
                redirect('admin/index');
            }else{
                return $this->view('admin/login', $data);
            }
        }
        $data = [
            'login' => '',
            'password' => '',
            'login_err' => '',
            'password_err'  => '',
        ];
        return $this->view('admin/login',$data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST['check'])){
                if ($_POST['check'] === 'on'){
                    $fulfilled = 'Да';
                }
            }else{
                $fulfilled = 'Нет';
            }
            $data = [
                'id' => $id,
                'username' => trim($_POST['username']),
                'useremail' => trim($_POST['useremail']),
                'task' => trim($_POST['task']),
                'fulfilled' => $fulfilled,
            ];

            if ($this->taskModel->updateTask($data)) {
                flash('task_message', 'Обновление');
                redirect('admin');
            }else{
                die('Something went wrong');
            }
        }else{
            $post = $this->taskModel->getTaskById($id);
            $data = [
                'id' => $id,
                'username' => $post->user_name,
                'useremail' => $post->user_email,
                'task' => $post->task,
                'fulfilled' => $post->fulfilled,
            ];
            $this->view('admin/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->taskModel->deleteTaskById($id)) {
                flash('task_message', 'Задача удалена.');
                redirect('admin');
            }else{
                die('Something went wrong');
            }
        }else{
            redirect('admin');
        }
    }

    public function logout()
    {
        unset($_SERVER['login']);
        session_destroy();
        redirect('');
    }

}