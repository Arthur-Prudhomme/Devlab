<?php

class User
{
    public string $id;

    public function __construct(
        public string $email,
        public string $username,
        public string $password,
        public string $password2,
    )
    {
    }

    public function verifyUser(): bool
    {
        $isValid = true;

        if ($this->email === '') {
            $isValid = false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
        }

        if ($this->password === '' || $this->password !== $this->password2) {
            $isValid = false;
        }

        return $isValid;
    }
}