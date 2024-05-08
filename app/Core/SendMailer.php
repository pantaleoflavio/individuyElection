<?php

    namespace App\Core;

    use Dotenv;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . '/../../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    class SendMailer {
        protected $mailer;

        public function __construct() {
            $this->mailer = new PHPMailer(true);
            $this->configure();
        }

        protected function configure() {
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['SMTP_HOST']; // the host that you use
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['SMTP_USERNAME']; //use your email
            $this->mailer->Password = $_ENV['SMTP_PASSWORD']; //use your password from your host generate
            $this->mailer->SMTPSecure = 'tls';
            $this->mailer->Port = $_ENV['SMTP_PORT'];
            // $this->mailer->SMTPDebug = 2; // Abilita l'output di debug dettagliato

            
            // Mittente
            $this->mailer->setFrom('exam@ple.com', 'Individuy Italiani'); //example of sender
        }

        public function sendPasswordResetEmail($recipientEmail, $resetLink) {
            try {
                $this->mailer->addAddress($recipientEmail);
                $this->mailer->isHTML(true);
                $this->mailer->Subject = 'Recupero Password Individuy Election';
                $this->mailer->Body    = "<html><body><h1>Recupero Password</h1><p>Ciao,</p><p>Hai richiesto di reimpostare la tua password. Clicca sul link qui sotto per procedere:</p><a href='{$resetLink}'>Reimposta la tua password</a><p>Se non hai richiesto il recupero della password, ignora questa email.</p></body></html>";
                $this->mailer->AltBody = 'Per reimpostare la tua password, copia e incolla il seguente link nel tuo browser: ' . $resetLink;
    
                $this->mailer->send();
                return true;
            } catch (Exception $e) {
                error_log("Mailer Error: " . $this->mailer->ErrorInfo);
                return false;
            }
        }


        
    }
?>