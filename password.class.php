<?php

class AddPass {
    public $password;
    public $success;
    public $error;
    private $storage = "C:\\wamp64\\www\\las205proj\\pass.json";
    private $stored_pass;
    private $new_pass;

    public function __construct($password) {
        $this->password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->stored_pass = json_decode(file_get_contents($this->storage), true);

        if ($this->stored_pass === null) {
            $this->stored_pass = [];
        }

        $this->new_pass = [
            "password" => $this->password,
        ];

        if ($this->checkFieldValues()) {
            $this->insertPassword();
        }
    }

    private function checkFieldValues() {
        if (empty($this->password)) {
            $this->error = "Password is required";
            return false;
        } else {
            return true;
        }
    }

    private function insertPassword() {
        array_push($this->stored_pass, $this->new_pass);
        if (file_put_contents($this->storage, json_encode($this->stored_pass, JSON_PRETTY_PRINT))) {
            return $this->success = "Your input was successful";
        } else {
            return $this->error = "Something went wrong, please try again";
        }
    }
}