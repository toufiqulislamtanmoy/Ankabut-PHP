<?php
session_start();
class Main
{
    private $conn;
    function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "ankabut";
        $this->conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        if (!$this->conn) {
            echo "<script>";
            echo "alert('Connection Failed');";
            echo "</script>";
        }
    }

    // Sign up user
    function signUpUser($userData)
    {
        [$firstName, $lastName, $phoneNumber, $email, $password, $confirmPassword] = [
            $userData['firstName'],
            $userData['lastName'],
            $userData['phoneNumber'],
            $userData['email'],
            $userData['password'],
            $userData['confirmPassword']
        ];

        if (
            !empty($firstName) &&
            !empty($lastName) &&
            !empty($phoneNumber) &&
            !empty($email) &&
            !empty($password) &&
            !empty($confirmPassword)
        ) {
            if ($password != $confirmPassword) {
                return "Confirm password did not match";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO users(firstName, lastName, email, phoneNumber, password) VALUES(?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sssss", $firstName, $lastName, $email, $phoneNumber, $hashedPassword);
                if ($stmt->execute()) {
                    echo "<script>window.location.replace('login.php');</script>";
                } else {
                    return "Did not create account, try again!!";
                }
                $stmt->close();
            }
        } else {
            return "Fill all the required fields";
        }
    }

    // User login
    function userLogin($data)
    {
        [$email, $password] = [$data['email'], $data['password']];
        
        if (!empty($email) && !empty($password)) {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['UserName'] = $row['firstName'];
                    $_SESSION['email'] = $row['email'];
                    
                    echo "<script>window.location.replace('home.php');</script>";
                } else {
                    echo "<script>alert('Enter Valid Username or Password');</script>";
                }
            } else {
                echo "<script>alert('Enter Valid Username or Password');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Enter Valid Username or Password');</script>";
        }
    }
}
?>
