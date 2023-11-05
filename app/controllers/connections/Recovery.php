<?php

namespace app\controllers\connections;

use app\models\User as UserModel;
use app\models\Email as EmailModel;
use app\views\connections\Recovery as RecoveryView;
use config\DataBase;
use config\EmailService;
use PDO;
use DateTime;

class Recovery
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = DataBase::getConnection();
    }

    public function execute(): void
    {
        (new RecoveryView())->show();
    }

    public function changePassword(array $postData): void
    {
        $emailVerification = new EmailModel($this->PDO);
        $user = new UserModel($this->PDO);
        $emailData = null;
        $isAccountExist = null;
        $isExpired = null;

        if (isset($postData['email'])) {
            $postData['email'] = $this->cleanEmail($postData['email']);
            $emailData = $emailVerification->getEmail(htmlspecialchars($postData['email']));
            $isAccountExist = $user->isUserEmailExist(htmlspecialchars($postData['email']));
            $isExpired = $this->isVerificationLinkExpired($emailData['request_date']);
        }

        if ($isAccountExist && isset($emailData['verified']) && !$emailData['verified'] && isset($postData['password']) && !$isExpired) {
            $emailVerification->deleteEmail($emailData['email']);

            $data = [
                'email' => htmlspecialchars($postData['email']),
                'password' => password_hash(htmlspecialchars($postData['password']), PASSWORD_DEFAULT)
            ];

            $user->changePassword($data);

            header('Location: /login');
            exit();
        }

        if ($isAccountExist && isset($emailData['verified']) && !$emailData['verified'] && !$isExpired) {
            $errorMessage = 'Please visit your email to access the recovery page!';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /recovery');
            exit();
        }

        if ($isAccountExist && !isset($emailData['email'])) {
            $verificationURL = $this->generateVerificationURL();
            $emailVerification->setEmail(htmlspecialchars($postData['email']), false, $verificationURL);
            $userEmail = htmlspecialchars($postData['email']);

            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'];

            $subject = 'Password recovery';
            $message = 'Please visit the following link to CHANGE YOUR PASSWORD: ' . $protocol . $host . '/recovery/' . $verificationURL . '. If you received this verification email in error, please ignore it!';
            if ((new EmailService())->sendEmail($userEmail, $subject, $message)) {
                $errorMessage = 'Please check your email to complete the password recovery process!';
            } else {
                $errorMessage = 'Please check your email to access the password recovery page!';
            }
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /recovery');
            exit();
        }

        if (!$isAccountExist) {
            $errorMessage = 'Account with this email does not exist!';
            $_SESSION['errorMessage'] = $errorMessage;
            header('Location: /recovery');
            exit();
        }
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
                (new RecoveryView())->show(true, htmlspecialchars($emailData['email']));
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
        $limitMin = 15;
        $dbTimestamp = new DateTime($timeStamp);
        $currentTime = new DateTime();

        $interval = $currentTime->diff($dbTimestamp);

        if ($interval->d > 0 || $interval->h > 0 || $interval->m > $limitMin) {
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