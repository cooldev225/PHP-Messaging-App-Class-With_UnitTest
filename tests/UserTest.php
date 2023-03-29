<?php
    require_once './vendor/autoload.php';
    require_once './src/User.php';

    use PHPUnit\Framework\TestCase;

    class UserTest extends TestCase {
        public function testGetFullNameReturnsCorrectFormatForParentOrTeacher() {
            $user = new User(UserType::Parent, 1, 'John', 'Doe', 'johndoe@example.com', DEFAULT_AVATAR_URL, 'Mr.');
            $this->assertEquals('Mr., John Doe', $user->getFullName());
    
            $user = new User(UserType::Teacher, 2, 'Jane', 'Smith', 'janesmith@example.com', DEFAULT_AVATAR_URL, 'Ms.');
            $this->assertEquals('Ms., Jane Smith', $user->getFullName());
        }
    
        public function testGetFullNameReturnsCorrectFormatForStudent() {
            $user = new User(UserType::Student, 3, 'Jack', 'Johnson', 'jackjohnson@example.com');
            $this->assertEquals('Jack Johnson', $user->getFullName());
        }
    
        public function testSaveUserReturnsTrueIfEmailAndAvatarUrlAreValid() {
            $user = new User(UserType::Parent, 1, 'John', 'Doe', 'johndoe@example.com', 'https://example.com/avatar.jpg', 'Mr.');
            $this->assertTrue($user->saveUser());
        }
    
        public function testSaveUserReturnsFalseIfEmailIsInvalid() {
            $user = new User(UserType::Parent, 1, 'John', 'Doe', '', 'https://example.com/avatar.jpg', 'Mr.');
            $this->assertFalse($user->saveUser());
        }
    
        public function testSaveUserReturnsFalseIfAvatarUrlIsInvalid() {
            $user = new User(UserType::Parent, 1, 'John', 'Doe', 'johndoe@example.com', 'https://example.com/avatar.gif', 'Mr.');
            $this->assertFalse($user->saveUser());
        }
    }
?>