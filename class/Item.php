<?php

class Item extends Generic{

	private $id;
	private $ownerId;
    private $ownerNickname;
	private $name;
	private $description;
	private $picture;
	private $addingDate;


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

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }
    public function getOwnerNickname()
    {
        return htmlspecialchars($this->ownerNickname);
    }

    public function setOwnerNickname($ownerNickname)
    {
        $this->ownerNickname = $ownerNickname;

        return $this;
    }

    public function getName()
    {
        return htmlspecialchars($this->name);
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    public function getDescription()
    {
        return htmlspecialchars($this->description);
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAddingDate()
    {
        return $this->addingDate;
    }

    public function setAddingDate($addingDate)
    {
        $this->addingDate = $addingDate;

        return $this;
    }
}