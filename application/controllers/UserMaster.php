<?php 

    class UserMaster extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            $this->load->model('UserModel');
        }

        public function index(){
            $data['res']= $this->UserModel->getAll();
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/navbar.php');
            $this->load->view('dashboard/sidebar');
            $this->load->view('userView/index',$data);
            $this->load->view('dashboard/footer');
        }
        
        public function add_user(){
            //$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
            // $this->form_validation->set_rules('name','UserName','required|regex_match[/^[a-zA-Z\s]+$/]',array('required'=>'*User Name is required','regex_match'=>'* Only Character are Allowed'));
            // $this->form_validation->set_rules('email','Email','required|valid_email',array('required'=>'* Email is Required','vaid_email'=>'Enter a Valid Email'));
            // $this->form_validation->set_rules('phone','phone','required|regex_match[/^[0-9]+$/]|exact_length[10]',array('required'=>'Phone No is Required','regex_match'=>'Only Digit are Allowed','exact_length','Phone no is invalid'));
            // $this->form_validation->set_rules('password','password','required|alpha_numeric',array('required'=>'password is required','alpha_numeric_spaces'=>'Enter a Valid Password'));
            
            $config= array(
                    array(
                            'field'=>'name',
                            'label'=>'UserName',
                            'rules'=>'required|regex_match[/^[a-zA-Z\s]+$/]',
                            'errors'=>array('required'=>'*User Name is required','regex_match'=>'* Only Character are Allowed')
                    ),
                    array(
                            'field'=>'email',
                            'label'=>'email',
                            'rules'=>'required|valid_email',
                            'errors'=>array('required'=>'* Email is Required','vaid_email'=>'Enter a Valid Email')
                    ),
                    array(
                            'field'=>'phone',
                            'label'=>'phone',
                            'rules'=>'required|regex_match[/^[0-9]+$/]|exact_length[10]',
                            'errors'=>array('required'=>'Phone No is Required','regex_match'=>'Only Digit are Allowed','exact_length','Phone no is invalid')
                    ),
                    array(
                            'field'=>'password',
                            'label'=>'password',
                            'rules'=>'required|alpha_numeric',
                            'errors'=>array('required'=>'password is required','alpha_numeric_spaces'=>'Enter a Valid Password')
                    )
                    );
            
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==false){ 
                $array=array(
                    'error'=>true,
                    'name_error'=>form_error('name'),
                    'email_error'=>form_error('email'),
                    'phone_error'=>form_error('phone'),
                    'pass_error'=>form_error('password')
                ); 
                echo json_encode($array);                         
            }
            else{

                $userData=array();
                $userData['userName']=$this->input->post('name');
                $userData['email']=$this->input->post('email');
                $userData['phone']=$this->input->post('phone');
                $userData['pass']=$this->input->post('password');
                $userData['created_By'] = $this->session->userdata('UserName');
                $userData['created_Date'] = date('Y-m-d');   
                $this->UserModel->addUser($userData);
                $data['res']=$this->UserModel->getAll();
                $res=$this->load->view('userView/table',$data,true);
                $array = array(
                        'success' => '<div class="alert alert-success">Record Inserted </div>',
                        'html'=>$res
                    );
                 echo json_encode($array);  

            }

        }
        
        public function get_User(){
            $id=$this->input->post('userId');
            $res=$this->UserModel->get_user($id);
            $data=json_encode($res[0]);
            echo $data;
        }

        public function update_User(){
            $data=$this->input->post('userData');
            $data=json_decode(html_entity_decode($data));
            $userData=array();
            $userId=$data->userId;
            $userData['userName']=$data->userName;
            $userData['email']=$data->email;
            $userData['phone']=$data->phone;
            $userData['pass']=$data->password;
            $this->UserModel->updateUser($userId,$userData);
            $data=array();
            $data['res']= $this->UserModel->getAll();
            $res=$this->load->view('userView/table',$data,true);
            echo $res;
        }

        public function delete_User(){
            $id=$this->input->post('userId');
            $res=$this->UserModel->get_user($id);
           
            if($res[0]['userName']!=$_SESSION['UserName']){
                $this->UserModel->delete_User($id);
                $res=$this->UserModel->getAll();
                $data=array('users'=>$res);
            }
            else{
                
                $res=$this->UserModel->getAll();
                $data=array('users'=>$res,'msg'=>400);
            } 
            $data=json_encode($data);
            echo $data;
        }

        public function login(){
            $this->form_validation->set_error_delimiters('<span class="error" style="color:red;margin-left:20px;">','</span>');
            // $this->form_validation->set_rules('email','email','required|valid_email|callback_check_email',array('required'=>'* Email Id is required'));
            // $this->form_validation->set_rules('password','password','required',array('required'=>'* Password is required',));
               
            $config = array(
                        array(
                           'field' => 'email',
                            'label' => 'email',
                            'rules' => 'required|valid_email|callback_check_email',
                            'errors' =>array('required'=>'* Email Id is required','valid_email'=>'Enter  a valid email')
                        ),
                        array(
                            'field' => 'password',
                            'label' => 'password',
                            'rules' => 'required',
                            'errors' => array('required'=>'* Password is required')
                        ),
                    );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==false){
            
                $this->load->view('dashboard/header');
                $this->load->view('dashboard/index');
                $this->load->view('dashboard/footer');      
            }
            else{
                $email=$this->input->post('email');
                $pass=$this->input->post('pass');
                $res=$this->UserModel->user_by_email($email);
                
                $data=array('email'=>$email,'password'=>$pass,'UserName'=>$res[0]['userName']);
                $this->session->set_userdata($data);
                redirect('usermaster/dashboard');
            }
        }
        public function logout(){
            $this->session->sess_destroy();
            redirect('usermaster/login');
        }
        public function check_email($email){
            $res=$this->UserModel->user_by_email($email);
            if(empty($res)){
                $this->form_validation->set_message('check_email','* Email not Exists');
                return false;
            }
            else{
                $pass = $this->input->post('password');
                if($res[0]['pass']!=$pass){
                    $this->form_validation->set_message('password','Password not Matched');
                    return true;
                }
                else{
                    return true;
                }
            }
        } 
        public function dashboard(){
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/navbar.php');
            $this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/home');
            $this->load->view('dashboard/footer');
        }
       
    }
