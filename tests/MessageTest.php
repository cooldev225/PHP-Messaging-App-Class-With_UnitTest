<?php
    require_once './vendor/autoload.php';
    require_once './src/Message.php';

    use PHPUnit\Framework\TestCase;
    
    class MessageTest extends TestCase
    {
        public function testGetFullNameOfSender()
        {
            $sender = new User(UserType::Parent, 1, 'John', 'Doe', 'johndoe@example.com', DEFAULT_AVATAR_URL, 'Mr.');
            $receiver = new User(UserType::Teacher, 2, 'Jane', 'Smith', 'janesmith@example.com', DEFAULT_AVATAR_URL, 'Ms.');
            $message = new Message($sender, $receiver, 'Hello', MessageType::System);
    
            $this->assertEquals('Mr., John Doe', $message->getFullNameOfSender());
        }
    
        public function testGetFullNameOfReceiver()
        {
            $sender = new User(UserType::Parent, 1, 'John', 'Doe', 'johndoe@example.com', DEFAULT_AVATAR_URL, 'Mr.');
            $receiver = new User(UserType::Teacher, 2, 'Jane', 'Smith', 'janesmith@example.com', DEFAULT_AVATAR_URL, 'Ms.');
            $message = new Message($sender, $receiver, 'Hello', MessageType::System);
    
            $this->assertEquals('Ms., Jane Smith', $message->getFullNameOfReceiver());
        }
    
        public function testGetType()
        {
            $sender = new User(UserType::Parent, 1, 'John', 'Doe', 'johndoe@example.com', DEFAULT_AVATAR_URL, 'Mr.');
            $receiver = new User(UserType::Teacher, 2, 'Jane', 'Smith', 'janesmith@example.com', DEFAULT_AVATAR_URL, 'Ms.');
            $message = new Message($sender, $receiver, 'Hello', MessageType::Manual);
    
            $this->assertEquals(MessageType::Manual, $message->getType());
        }
    
        public function testSaveMessage()
        {
            $teacher = new User(UserType::Teacher, 2, 'Jane', 'Smith', 'janesmith@example.com', DEFAULT_AVATAR_URL, 'Ms.');
            $student = new User(UserType::Student, 3, 'Jack', 'Johnson', 'jackjohnson@example.com');
            $message = new Message($teacher, $student, 'Hello', MessageType::System);
    
            $this->assertTrue($message->saveMessage());
    
            $student2 = new User(UserType::Student, 4, 'John', 'Smith', 'jackjohnson@example.com');
            $message2 = new Message($student2, $teacher, 'Hello', MessageType::Manual);
    
            $this->assertTrue($message2->saveMessage());
        }
    }
?>