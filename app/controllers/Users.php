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
        if ($this->userModel->register($username, $email, $password)) {
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
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      // Init data
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
      ];

      // Validate Email
      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter email';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      }
      if (empty($data['email_err']) && empty($data['password_err'])) {
        if ($this->userModel->checkEmail($data['email'])) 
        {
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
          if ($loggedInUser) {
            $this->createUserSession($loggedInUser);
          } else {
            // User Password incorrect
            $data['password_err'] = 'Password not correct';
            $data['display'] = 'login';
            $this->view('users/login', $data);
          }
        } else {
          // User not found
          $data['email_err'] = 'No user found';
          $data['display'] = 'login';
          $this->view('users/login', $data);
        }
      } else {
        $data['display'] = 'login';
        $this->view('users/login', $data);
      }
    } else {
      $data['display'] = 'login';
      $this->view('users/login', $data);
    }
  }

  public function createUserSession($user)
  {

    $_SESSION['id_user'] = $user->id;
    $_SESSION['username'] = $user->username;
    $_SESSION['email'] = $user->email;
    redirect('pages/index');
  }

  public function logout()
  {
    echo"zzz";
    unset($_SESSION['id_user']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    session_destroy();
    redirect('users/login');
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
                  if($this->userModel->addNotification($username))
                  {
                    // echo "zz";
                  }
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
        if ($this->userModel->checkEmail($email)) 
        {
        if ($this->userModel->editUser($id, $username, $email)) {
          // echo json_encode ($data);die;
          echo json_encode(['message' => true]);
        } else {
          echo json_encode(['message' => false]);
        }
      }
      } else {
        echo json_encode(['message' => 'invalid request']);
      }
    } 
  }


  // public function resetPassword()
  // {
  //     if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  //     {
  //         $email = $_POST['email'];
  //         $email_err = '';
  //         $token = bin2hex(random_bytes(16));

  //         $token_hash = hash("sha256", $token);

  //         $delai = time() + 1800; // Ajoute 30 minutes à l'heure actuelle

  //         if ($this->userModel->checkEmail($email)) 
  //         {
  //             if($this->userModel->resetPassword($email, $token_hash, $delai))
  //             {
  //                 $this->sendResetEmail($email, $token);
  //             }
  //         }
  //         else{
  //             $email_err = 'Email non existant' ;
  //         }
  //     }
  //     else {
  //         $this->view('users/reset_password');
  //     }
  // }

  // private function sendResetEmail($email, $token)
  // {
  //     require_once '../../vendor/autoload.php';

  //     $mail = new PHPMailer(true);

  //     try {
  //         $mail->isSMTP();
  //         $mail->Host = 'smtp.gmail.com';
  //         $mail->SMTPAuth   = true;
  //         $mail->Username   = 'alahcen2000@gmail.com'; 
  //         $mail->Password   = 'uyll kafu cmzt omyl'; 
  //         $mail->SMTPSecure = 'tls';
  //         $mail->Port       = 587;

  //         $mail->setFrom('alahcen2000@gmail.com', 'salma');
  //         $mail->addAddress($email);

  //         //Content
  //         $mail->isHTML(true);
  //         $mail->Subject = 'Réinitialisation du mot de passe';
  //         $mail->Body    = 'Pour réinitialiser votre mot de passe, cliquez sur ce lien : <a href="' . URLROOT . '/users/newpassword?token=' . $token . '">Réinitialiser le mot de passe</a>';

  //         $mail->send();
  //         echo 'rrr';
  //     } catch (Exception $e) {
  //         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  //     }
  // }

}
