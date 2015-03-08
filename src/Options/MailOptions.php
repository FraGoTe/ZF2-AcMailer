<?php
namespace AcMailer\Options;

use Zend\Mail\Transport\FileOptions;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Stdlib\AbstractOptions;
use Zend\Mail\Transport\TransportInterface;
use AcMailer\Exception\InvalidArgumentException;

/**
 * Module options
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class MailOptions extends AbstractOptions
{
    /**
     * Standard adapters aliasses
     * @var array
     */
    private $adapterMap = [
        'sendmail'  => 'Zend\Mail\Transport\Sendmail',
        'smtp'      => 'Zend\Mail\Transport\Smtp',
        'null'      => 'Zend\Mail\Transport\Null',
        'file'      => 'Zend\Mail\Transport\File',
    ];
    
    /**
     * @var TransportInterface|string
     */
    protected $mailAdapter = '\Zend\Mail\Transport\Sendmail';
    /**
     * @var MessageOptions;
     */
    private $messageOptions;
    /**
     * @var SmtpOptions;
     */
    private $smtpOptions;
    /**
     * @var FileOptions
     */
    private $fileOptions;
    
    /**
     * @return TransportInterface|string
     */
    public function getMailAdapter()
    {
        return $this->mailAdapter;
    }

    /**
     * @param string|TransportInterface $mailAdapter
     * @return $this
     * @throws \AcMailer\Exception\InvalidArgumentException
     */
    public function setMailAdapter($mailAdapter)
    {
        // Map adapter aliases to the real class name
        if (is_string($mailAdapter) && array_key_exists(strtolower($mailAdapter), $this->adapterMap)) {
            $mailAdapter = $this->adapterMap[strtolower($mailAdapter)];
        }

        $this->mailAdapter = $mailAdapter;
        return $this;
    }

    /**
     * @return MessageOptions
     */
    public function getMessageOptions()
    {
        if (! isset($this->messageOptions)) {
            $this->setMessageOptions([]);
        }

        return $this->messageOptions;
    }

    /**
     * @param MessageOptions|array $messageOptions
     * @return $this
     */
    public function setMessageOptions($messageOptions)
    {
        if (is_array($messageOptions)) {
            $this->messageOptions = new MessageOptions($messageOptions);
        } elseif ($messageOptions instanceof MessageOptions) {
            $this->messageOptions = $messageOptions;
        } else {
            throw new InvalidArgumentException(sprintf(
                'MessageOptions should be an array or an AcMailer\Options\MessageOptions object. %s provided.',
                is_object($messageOptions) ? get_class($messageOptions) : gettype($messageOptions)
            ));
        }

        return $this;
    }

    /**
     * @return SmtpOptions
     */
    public function getSmtpOptions()
    {
        if (! isset($this->smtpOptions)) {
            $this->setSmtpOptions([]);
        }

        return $this->smtpOptions;
    }

    /**
     * @param SmtpOptions|array $smtpOptions
     * @return $this
     */
    public function setSmtpOptions($smtpOptions)
    {
        if (is_array($smtpOptions)) {
            $this->smtpOptions = new SmtpOptions($smtpOptions);
        } elseif ($smtpOptions instanceof SmtpOptions) {
            $this->smtpOptions = $smtpOptions;
        } else {
            throw new InvalidArgumentException(sprintf(
                'SmtpOptions should be an array or an Zend\Mail\Transport\SmtpOptions object. %s provided.',
                is_object($smtpOptions) ? get_class($smtpOptions) : gettype($smtpOptions)
            ));
        }

        return $this;
    }

    /**
     * @return FileOptions
     */
    public function getFileOptions()
    {
        if (! isset($this->fileOptions)) {
            $this->setFileOptions([]);
        }

        return $this->fileOptions;
    }

    /**
     * @param FileOptions|array $fileOptions
     * @return $this
     */
    public function setFileOptions($fileOptions)
    {
        if (is_array($fileOptions)) {
            $this->fileOptions = new FileOptions($fileOptions);
        } elseif ($fileOptions instanceof FileOptions) {
            $this->fileOptions = $fileOptions;
        } else {
            throw new InvalidArgumentException(sprintf(
                'FileOptions should be an array or an Zend\Mail\Transport\FileOptions object. %s provided.',
                is_object($fileOptions) ? get_class($fileOptions) : gettype($fileOptions)
            ));
        }

        return $this;
    }
}
