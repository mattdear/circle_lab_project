<?php
include("drug.php");
include("functions.php");
class drugDAO
{
    private $table, $conn;

    public function __construct($conn, $t)
    {
      $this->conn = $conn;
      $this->table = $t;
    }

    public function addDrug(drug $drugObj)
    {
      $query = $this->conn->prepare("INSERT INTO " . $this->table .  "(name) VALUES (?)");
      $query->execute([$drugObj->getName()]);
      return $drugObj;
    }

    public function modifyDrug($drugObj)
    {
      $query = $this->conn->prepare("UPDATE " . $this->table .  " SET name=? WHERE id=?");
      $query->execute([$drugObj->getName(), $drugObj->getId()]);
    }

    public function deleteDrug($drugObj)
    {
      $query = $this->conn->prepare("DELETE FROM " . $this->table .  " WHERE id=?");
      $query->execute([$drugObj->getId()]);
      $count = $query->rowCount();
    }

    public function findDrug($drugObj)
    {
      $query = $this->conn->prepare("SELECT * FROM " . $this->table .  " WHERE TRUE=TRUE");
      if($drugObj->getName!=null){
          $query = $query + " AND name = ?";
      }
      $drugRet = $query->execute([$drugObj->getName()]);
      return $drugRet;
    }

    public function findDrugById($id)
    {
      $query = $this->conn->prepare("SELECT * FROM " . $this->table .  " WHERE id=?");
      $drugRet = $query->execute([$id]);
      return $drugRet;
    }

    public function findAll()
    {
      $query = $this->conn->prepare("SELECT * FROM " . $this->table);
      $query->execute();
      $drugs = [];
      while($row = $query->fetch()) {
          $drug = new drug($row["name"]);
          $drug->setId($row["id"]);
          $drugs[] = $drug;
      }
      return $drugs;
    }

}
