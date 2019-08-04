<?php
namespace App\Database\FormEntry;
use App\Form\EmailForm\SendEmail;
use \Exception;

class FormEntry {
  private $host;
  private $user;
  private $password;
  private $dbname;
  private $email;

  public function __construct()
  {
    $this->host     = getenv('DB_HOST');
    $this->user     = getenv('DB_USER');
    $this->password = getenv('DB_PASS');
    $this->dbname     = getenv('DB_NAME');
    $this->email    = new SendEmail();
  }

  public function createPDO() {
    $dsn = 'mysql:host=' . $this->host . ';port=8889;dbname=' . $this->dbname;
    try {
      $pdo = new \PDO($dsn, $this->user, $this->password);
      $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
      return $pdo;
    }
    catch(\PDOException $e)
    {
      $pdo['result'] = 'error';
      $pdo['message'] = $e->getMessage();
      return $pdo;
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

    if ($formData['failures'] === 0 && $pdo['result'] !== 'error') {

      $data = array(
        'name'    => $formData['name']['value'],
        'email'   => $formData['email']['value'],
        'phone'   => $formData['phone']['value'],
        'message' => $formData['message']['value']
      );

      $sql = 'INSERT INTO form_submissions(name, phone, email, message) VALUES(:name, :phone, :email, :message)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute($data);

      $this->email->setSubject("New homepage contact form submission.");
      $this->email->setHeaders("From: {$data['email']}");
      $this->email->setBody($data['name'], $data['message'], $data['phone']);
      $this->email->send();

    } else {
      $formData['failures'] = 1;
      $formData['db'] = array(
        'result' => false,
        'message' => $pdo['message']
      );
    }
    return json_encode($formData);
  }

  public function run($result) {

    // $this->getAllSubmissions($pdo);
    if ($result['failures'] === 0) {
      $pdo = $this->createPDO();
      echo $this->addEntry($result, $pdo);
    } else {
      echo json_encode($result);
    }
  }

}