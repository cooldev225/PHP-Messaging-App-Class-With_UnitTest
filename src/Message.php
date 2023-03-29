<?php
    require_once __DIR__ . './User.php';
    require_once __DIR__ . './constants/MessageType.php';

    class Message {
        private User $sender;
        private User $receiver;
        private string $text;
        private DateTime $createdAt;
        private MessageType $type;

        public function __construct(User $sender, User $receiver, string $text, MessageType $type) {
            $this->sender = $sender;
            $this->receiver = $receiver;
            $this->text = $text;
            $this->createdAt = new DateTime('now');
            $this->type = $type;
        }

        public function getFullNameOfSender() {
            return $this->sender->getFullName();
        }

        public function getFullNameOfReceiver() {
            return $this->receiver->getFullName();
        }

        public function getText() {
            return $this->text;
        }

        public function getType() {
            return $this->type;
        }

        public function getCreatedAt() {
            return $this->createdAt;
        }

        public function saveMessage() {
            if ($this->type == MessageType::System) {
                if ($this->sender->getUserType() == UserType::Teacher && $this->receiver->getUserType() == UserType::Student) return true; else return false;
            } else {
                if ($this->sender->getUserType() != UserType::Teacher && $this->receiver->getUserType() != UserType::Teacher) return false; else return true;
            }
        }
    }
