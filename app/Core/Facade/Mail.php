<?php

namespace App\Core\Facade;

use App\Core\Store\Variable\Variable;
use Kentron\Facade\Hash;
use Kentron\Facade\Mail\Entity\MailTransportEntity;
use Kentron\Facade\Mail\PhpMailer;
use Kentron\Template\AAlert;

final class Mail extends AAlert
{
    private $mailEntity;

    public function __construct ()
    {
        $this->mailEntity = new MailTransportEntity();

        $this->mailEntity->setHost(Variable::getEmailSMTP());
        $this->mailEntity->setPort(Variable::getEmailPort());
        $this->mailEntity->setMethod(Variable::getEmailMethod());
        $this->mailEntity->setUsername(Variable::getEmailUsername());
        $this->mailEntity->setPassword(Variable::getEmailPassword());
        $this->mailEntity->setFromEmail(Variable::getEmailDefaultFrom());
        $this->mailEntity->setFromName(Variable::getSystemName());
        $this->mailEntity->setIsHtml();
    }

    public function setSubject (string $subject): void
    {
        $this->mailEntity->setSubject($subject);
    }

    public function setBody (string $body): void
    {
        $this->mailEntity->setBody($body);
    }

    public function addImage (string $imagePath): string
    {
        $cid = Hash::generateRandom(8);

        if ($this->mailEntity->embedFile($imagePath, null, $cid)) {
            $this->addError($this->mailEntity->getErrors());
        }

        return $cid;
    }

    public function send (string $target): bool
    {
        $this->mailEntity->addRecipient($target);

        if (!PhpMailer::sendMail($this->mailEntity)) {
            $this->addError($this->mailEntity->getErrors());
            return false;
        }

        return true;
    }

    /**
     * Factories
     */

    public static function getNewDeviceMail (string $userDisplayName, string $code): self
    {
        $mail = new self();

        $cid = $mail->addImage(PUBLIC_DIR . "/assets/img/logo_quarter.gif");
        $data = [
            "name" => $userDisplayName,
            "code" => $code,
            "logo_cid" => $cid
        ];

        $mail->setSubject("New Device");
        $mail->setBody(View::getNewDeviceEmail()->capture($data));

        return $mail;
    }
}
