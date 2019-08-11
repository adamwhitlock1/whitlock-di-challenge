<?php

namespace App\Model;

use \Exception;

/**
 * Class FormEntry
 * Responsible for opening db connection and
 * writing the entry to the db.
 *
 * @package App\Model
 */
class FormEntry
{
    private $_host;
    private $_user;
    private $_password;
    private $_dbname;

    /**
     * FormEntry constructor.
     * set up config for db connection
     */
    public function __construct()
    {
        $this->_host = getenv('DB_HOST');
        $this->_user = getenv('DB_USER');
        $this->_password = getenv('DB_PASS');
        $this->_dbname = getenv('DB_NAME');
    }

    /**
     * Create an instance of PDO
     * @return object|\PDO
     */
    public function createPDO()
    {
        $dsn = 'mysql:host='.$this->_host.';port=8889;dbname='.$this->_dbname;
        try {
            $pdo = new \PDO($dsn, $this->_user, $this->_password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            return $pdo;
        } catch (\PDOException $e) {
            $pdo = (object) array(
            'result' => 'error',
            'message' => $e->getMessage(),
            );
            return $pdo;
        }
    }

    /**
     * @param $formData - all form data to add to db
     * @param $pdo - PDO instance
     * @return mixed - form data appended with result of db write
     */
    public function addEntry($formData, $pdo)
    {
        if ($formData['failures'] === 0 && !isset($pdo->result)) {
            $data = array(
                'name' => $formData['name']['value'],
                'email' => $formData['email']['value'],
                'phone' => $formData['phone']['value'],
                'message' => $formData['message']['value'],
            );

            $sql = 'INSERT INTO form_submissions(name, phone, email, message) VALUES(:name, :phone, :email, :message)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);

            $formData['db'] = array(
            'result' => true,
            'message' => 'Message sent successfully. Thank you for contacting us.',
            );
        } else {
            $formData['failures'] = 1;
            $formData['db'] = array(
            'result' => false,
            'message' => $pdo->message,
            );
        }

        return $formData;
    }

    /**
     * Run function to be entry function call on this class
     *
     * @param array $result - all field results and messages to send client as response
     * @return array $results
     */
    public function run($result)
    {
        // $this->getAllSubmissions($pdo);
        if ($result['failures'] === 0) {
            // create PDO to write to db
            $pdo = $this->createPDO();
            $entry = $this->addEntry($result, $pdo);
            return $entry;
        } else {
            return $result;
        }
    }
}
