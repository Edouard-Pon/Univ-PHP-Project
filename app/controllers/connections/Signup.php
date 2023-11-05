<?php

namespace app\controllers\connections;

use app\models\User as UserModel;
use app\models\Email as EmailModel;
use app\views\connections\Signup as SignupView;
use config\DataBase;
use config\EmailService;
use PDO;
use DateTime;

class Signup
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        if (isset($_SESSION['password'])) {
            header('Location: /home');
            exit();
        }
        (new SignupView())->show(true);
    }

    public function signup(array $postData): void
    {
        $emailVerification = new EmailModel($this->PDO);
        $user = new UserModel($this->PDO);
        $emailData = null;
        $isAccountExist = null;
        $isExpired = null;
        $isUsernameTaken = null;

        if (isset($postData['email'])) {
            $postData['email'] = $this->cleanEmail($postData['email']);
            $emailData = $emailVerification->getEmail(htmlspecialchars($postData['email']));
            $isAccountExist = $user->isUserEmailExist(htmlspecialchars($postData['email']));
            $isExpired = $this->isVerificationLinkExpired($emailData['request_date']);
        }

        if (isset($postData['username'])) {
            $isAccountExist = $user->isUsernameExist(strtolower(htmlspecialchars($postData['username'])));
            $isUsernameTaken = $isAccountExist;
        }

        if (!$isAccountExist && isset($emailData['verified']) && !$emailData['verified'] && isset($postData['password']) && !$isExpired) {
            $emailVerification->setVerified(htmlspecialchars($emailData['email']), true, $emailData['url']);

            $data = [
                'username' => strtolower(htmlspecialchars($postData['username'])),
                'nickname' => htmlspecialchars($postData['nickname']),
                'password' => sha1($postData['password']),
                'email' => htmlspecialchars($postData['email']),
                'number' => htmlspecialchars($postData['number']),
                'location' => htmlspecialchars($postData['location']),
                'gender' => htmlspecialchars($postData['gender']),
            ];
            if (!empty($data['username']) &&
                !empty($data['nickname']) &&
                !empty($data['password']) &&
                !empty($data['email']) &&
                !empty($data['number']) &&
                !empty($data['location']) &&
                !empty($data['gender']))
            {
                $user->setUser($data);
                $userData = $user->getUser($data['username'], $data['password']);
                if ($userData !== null)
                {
                    $_SESSION['username'] = $userData['username'];
                    $_SESSION['password'] = $userData['password'];
                    $_SESSION['id'] = $userData['id'];
                    $_SESSION['admin'] = $userData['admin'];
                    $user->setLastConnection();
                    header('Location: /home');
                    exit();
                } else {
                    $errorMessage = 'Error cannot get User! Please try to login!';
                    $_SESSION['errorMessage'] = $errorMessage;
                    header('Location: /login');
                }
                exit();
            } else {
                $errorMessage = 'Veuillez compléter tous les champs...';
                $_SESSION['errorMessage'] = $errorMessage;
            }
            exit();
        }

        if (!$isAccountExist && isset($emailData['verified']) && !$emailData['verified'] && !$isExpired) {
            $errorMessage = 'Please visit your email to access the registration page!';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /signup');
            exit();
        }

        if (!$isAccountExist && !isset($emailData['email'])) {
            $verificationURL = $this->generateVerificationURL();
            $emailVerification->setEmail(htmlspecialchars($postData['email']), false, $verificationURL);
            $user = htmlspecialchars($postData['email']);

            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'];

            $subject = 'Verify your email';
            $message = 'Please visit the following link to verify your email address: ' . $protocol . $host . '/verification/' . $verificationURL . '. If you received this verification email in error, please ignore it!';
            if ((new EmailService())->sendEmail($user, $subject, $message)) {
                $errorMessage = 'Please check your email to complete the registration process!';
            } else {
                $errorMessage = 'Please check your email to access the registration page!';
            }
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /signup');
            exit();
        }

        if ($isExpired && !$isAccountExist) {
            $errorMessage = 'The link is expired, please try again!';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /signup');
            exit();
        }

        if ($isAccountExist && $isUsernameTaken) {
            $errorMessage = 'Account with this username already exist!';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        if ($isAccountExist) {
            $errorMessage = 'Account with this email already exist!';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /login');
        }
        exit();
    }

    private function generateVerificationURL(): string
    {
        return rtrim(strtr(base64_encode(random_bytes(16)), '+/', '-_'), '=');
    }

    public function emailVerification($route): void
    {
        $email = new EmailModel($this->PDO);
        $emailData = null;

        if (isset($route[1])) $emailData = $email->getEmailByURL(htmlspecialchars($route[1]));

        if (isset($emailData['email'])) {

            $isExpired = $this->isVerificationLinkExpired($emailData['request_date']);

            if (!$isExpired) {
                (new SignupView())->show(false, htmlspecialchars($emailData['email']));
                exit();
            }

            $email->deleteEmail(htmlspecialchars($emailData['email']));
            $errorMessage = 'The link is expired, please try again!';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /signup');
        } else {
            header('Location: /');
        }
        exit();
    }

    private function isVerificationLinkExpired($timeStamp): bool
    {
        $limitHours = 1;
        $dbTimestamp = new DateTime($timeStamp);
        $currentTime = new DateTime();

        $interval = $currentTime->diff($dbTimestamp);

        if ($interval->d > 0 || $interval->h >= $limitHours) {
            return true;
        } else {
            return false;
        }
    }

    private function cleanEmail($email): string
    {
        return preg_replace('/\+[^\@]*\@/', '@', $email);
    }
}
