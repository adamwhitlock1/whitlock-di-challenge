<?php
namespace App\Database\FormEntry;

class FormEntry {
  private $host     = '127.0.0.1';
  private $user     = 'root';
  private $password = 'root';
  private $dbname   = 'dealer_inspire';

  public function createPDO() {
    $dsn = 'mysql:host=' . $this->host . ';port=8889;dbname=' . $this->dbname;
    try {
      $pdo = new \PDO($dsn, $this->user, $this->password);
      // set the PDO error mode to exception
      $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
      return $pdo;
    }
    catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function getAllSubmissions($pdo){
    $sql = 'SELECT * FROM form_submissions';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $prop) {
      echo $prop->name . $prop->email . $prop->phone . $prop->message;
    }
  }

  public function addEntry($formData, $pdo) {
    if ($formData['failures'] === 0) {
      $sql = 'INSERT INTO form_submissions(name, phone, email, message) VALUES(:name, :phone, :email, :message)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute(
        array(
          'name'    => $formData['name']['value'],
          'email'   => $formData['email']['value'],
          'phone'   => $formData['phone']['value'],
          'message' => $formData['message']['value']
          )
        );
    }
    return json_encode($formData);
  }

  public function run($result) {
    $pdo = $this->createPDO();
    // $this->getAllSubmissions($pdo);
    if ($result['failures'] === 0) {
      echo $this->addEntry($result, $pdo);
    } else {
      echo json_encode($result);
    }
  }

}