<?php
    require_once __DIR__ . './constants/UserType.php';
    require_once __DIR__ . './constants/constants.php';
    require_once __DIR__ . './Message.php';

    class User {
        private int $id;
        private string $firstName;
        private string $lastName;
        private string $email;
        private string $avatarUrl;
        private string $salutation;
        private UserType $userType;

        public function __construct(UserType $userType, int $id, string $firstName, string $lastName, string $email, string $avatarUrl = DEFAULT_AVATAR_URL, string $salutation = null) {
            $this->userType = $userType;
            $this->id = $id;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->avatarUrl = $avatarUrl;
            switch ($userType) {
                case UserType::Parent:
                case UserType::Teacher:
                    $this->salutation = $salutation;
                    break;
                case UserType::Student:
                default:
                    break;
            }
        }

        public function getFullName() {
            switch ($this->userType) {
                case UserType::Parent:
                case UserType::Teacher:
                    return "{$this->salutation}, {$this->firstName} {$this->lastName}";
                case UserType::Student:
                    return "{$this->firstName} {$this->lastName}";
                default:
                    break;
            }
        }

        public function getAvatarUrl() {
            return $this->avatarUrl;
        }

        public function getId() {
            return $this->id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function saveUser() {
            if ($this->email && str_ends_with($this->avatarUrl, '.jpg')) return true;
            return false;
        }

        public function getUserType() {
            return $this->userType;
        }

        public function sendMessage(User $receiver, string $text, MessageType $type) {
            $message = new Message($this, $receiver, $text, $type);
            return $message->saveMessage();
        }
    }
