<?php

/**
 * @author Sibbir Ahmed <sibbirahmed.ahmed@gmail.com>
 * @version 1.0
 * 
 * Date : 16.02.2014
 * Class Email - Send an Email
 */
class Email extends Helper {

    /** @var String The Email Address of Send to */
    private $_to = null;

    /** @var String The Email Address of CC to */
    private $_cc = null;

    /** @var String The Email Address Emaill of BCC to */
    private $_bcc = null;

    /** @var String Subject of the Email */
    public $_subject = null;

    /** @var String The Email Address of Senders */
    private $_from = null;

    /** @var String The Email Address of Senders */
    private $_replyto = null;

    /** @var String Headers of the Email */
    private $_headers = null;
    public $_content = null;

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $to
     */
    public function sendTo($to) {
        $this->_to = $to;
    }

    /**
     * 
     * @param type $replyTo
     */
    public function replyTo($replyTo = NULL) {
        if (!empty($replyTo))
            $this->_replyto = $replyTo;
        else
            $this->_replyto = ADMIN_EMAIL;
        return TRUE;
    }

    /**
     * 
     * @param type $sendFrom
     */
    public function sendFrom($sendFrom = NULL) {
        if (!empty($sendFrom))
            $this->_from = $sendFrom;
        else
            $this->_from = ADMIN_EMAIL;
        return TRUE;
    }

    /**
     * 
     * @param type $subject
     */
    public function setSubject($subject = NULL) {
        if (!empty($subject))
            $this->_subject = $subject;
        else
            $this->_subject = "Support advort.com";
        return TRUE;
    }

    /**
     * Set The Header of the Email
     */
    public function setHeader() {

        $this->_headers = 'From: ' . $this->_from . "\r\n";
        $this->_headers.= 'Reply-To: ' . $this->_replyto . "\r\n";
        $this->_headers.= 'MIME-Version: 1.0' . "\r\n";
        $this->_headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$this->_headers.= 'X-Mailer: PHP/' . phpversion();
    }

    /**
     * 
     * @param String $to Reciever Email Address
     * @param String $from Senders Email Address
     * @param String $replyto Reply To Email Address
     * @param String $subject Subject Of Email Sending
     * @return boolean If Success The returns true else returns false
     */
    public function sendMail($to = NULL, $from = NULL, $replyto = NULL) {
        $this->sendTo($to);
        $this->sendFrom($from);
        $this->replyTo($replyto);

        if (empty($this->_subject)) {
            $this->setSubject($subject);
        }

        $this->setHeader();

        if (mail($this->_to, $this->_subject, $this->_content, $this->_headers))
            return TRUE;
        else
            return FALSE;
    }

}
