<?php

class Users extends Controller
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = $this->model('User');
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $email_err = '';

      if ($this->userModel->checkEmail($email)) {
        $email_err = 'Email is already taken';
        $this->view('users/register');
      } else {
        if ($this->userModel->addUsers($username, $email, $password)) {
          $this->view('users/login');
        } else {
          $this->view('users/register');
        }
      }
    } else {
      $this->view('users/register');
    }
  }


  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $email_err = '';
      $password_err = '';


      // Validate Email
      if (empty($email)) {
        $email_err = 'Please enter email';
      }

      // Validate Password
      if (empty($password)) {
        $password_err = 'Please enter password';
      }

      if (empty($email_err) && empty($password_err)) {
        $loggedInUser = $this->userModel->login($email, $password);
        if ($loggedInUser) {
          session_start();
          $_SESSION['id_user'] = $loggedInUser['id_user'];
          $_SESSION['username'] = $loggedInUser['username'];
          $_SESSION['email'] = $loggedInUser['email'];
          $this->view('pages/index');
        } else {
          $password_err = 'Password not correct';
          $this->view('users/login');
        }
      } else {
        // User not found
        $email_err = 'No user found';
      }
    } else {

      return $this->view('users/login');
    }
  }


  public function addUsers()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $postData = file_get_contents("php://input");
      $data = json_decode($postData);

      if (is_array($data) && count($data) > 0) {
        $response = array();

        foreach ($data as $userData) {
          $usernames = $userData->usernames;
          $emails = $userData->emails;
          $passwords = $userData->passwords;

          for ($i = 0; $i < count($usernames); $i++) {
            $username = $usernames[$i];
            $email = $emails[$i];
            $password = $passwords[$i];

            if (!empty($username) && !empty($email) && !empty($password)) {
              if ($this->userModel->checkEmail($email)) {
                $response[] = array('message' => 'email déjà existant');
              } else {
                if ($this->userModel->addUsers($username, $email, $password)) {
                  $response[] = array('message' => true);
                } else {
                  $response[] = array('message' => false);
                }
              }
            } else {
              $response[] = array('message' => 'invalid request');
            }
          }
        }

        echo json_encode($response);
      }
    } else {
      return $this->view('users/add');
    }
  }

  public function displayAll()
  {
    $users = $this->userModel->allUsers();
    echo json_encode($users);
  }

  public function deleteUser($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
      if ($this->userModel->deleteUsers($id)) {
        echo json_encode(['message' => 'User deleted successfully']);
      } else {
        echo json_encode(['message' => 'Invalid request method']);
      }
    }
  }

  public function editUsers($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $postData = file_get_contents("php://input");
      $data = json_decode($postData, true);
      $username = $data['username'];
      $email = $data['email'];
      // echo json_encode ($data);die;

      if (!empty($username && $email)) {
        // echo json_encode ($data);die;
        if ($this->userModel->editUser($id, $username, $email)) {
          // echo json_encode ($data);die;
          echo json_encode(['message' => true]);
        } else {
          echo json_encode(['message' => false]);
        }
      } else {
        echo json_encode(['message' => 'invalid request']);
      }
    } else {
      echo json_encode(['message' => 'error']);
    }
  }


  public function logout()
  {
    session_start();
    $_SESSION = array();
    session_destroy();
    return $this->view('users/add');
  }
}
