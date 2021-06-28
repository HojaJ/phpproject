<?php

class Pages extends Controller
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = $this->model('Task');
    }

    public function index($page_id = 1){
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
                $this->view('pages/index', $data);
            };
        }
        $data = [
            'tasks' => '',
            'pagination' => ''
        ];
        $this->view('pages/index', $data);
    }

    public function add()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'task' => trim($_POST['task']),
            ];
            if (!empty($data['name']) && !empty($data['email']) && !empty($data['task'])){
                if($this->taskModel->addTask($data)){
                    redirect();
                }
            }
        }else{
            redirect();
        }
    }

}


