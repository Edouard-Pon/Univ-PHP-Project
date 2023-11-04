<?php

namespace config;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->init();
    }

    private function init(): void
    {
        $config = parse_ini_file('email.ini');
        if ($config === false) {
            die("Error loading configuration file.");
        }
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = $config['host'];
            $this->mailer->SMTPAuth = $config['SMTPAuth'];
            $this->mailer->SMTPSecure = $config['SMTPSecure'];
            $this->mailer->Port = $config['port'];
            $this->mailer->Username = $config['username'];
            $this->mailer->Password = $config['password'];
            $this->mailer->setFrom($config['emailSender'], $config['nameSender']);
        } catch (Exception $e) {
            throw new Exception('Email init failed: ' . $this->mailer->ErrorInfo);
        }
    }

    public function sendEmail($user, $subject, $message): bool
    {
        $this->mailer->addAddress($user);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $message;

        try {
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

