<?php

class ChatMessage extends Generic{

	private $id;
	private $message;
	private $senderId;
	private $receiverid;
	private $dateSended;
	private $senderName;
	private $receiverName;

	function __construct(array $data = null){
			if($data){
				$this->hydrate($data);
			}
	}

	/*-----GETTERS AND SETTERS-----*/
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getReceiverid()
    {
        return $this->receiverid;
    }

    public function setReceiverid($receiverid)
    {
        $this->receiverid = $receiverid;

        return $this;
    }

    public function getDateSended()
    {
    	$date = new Datetime($this->dateSended);
        return $date->format("H:i d-m-Y");
    }

    public function setDateSended($dateSended)
    {
        $this->dateSended = $dateSended;

        return $this;
    }

    public function getSenderName()
    {
        return $this->sender;
    }

    public function setSenderName($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiverName()
    {
        return $this->receiver;
    }

    public function setReceiverName($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }
}