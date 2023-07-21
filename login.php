<?php
header("Access-Control-Allow-Origin: *");
include './connection.php';

if (isset ($_POST['email']) && isset ($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $data = [
            'success' => false,
            'message' => 'invalid email'
        ];
    } else {
        $checksql = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $checksql);

        if ($checkResult->num_rows == 0) {
            $data = [
                'success' => false,
                'message' => 'invalid email'
            ];
        } else {
            $row = $checkResult->fetch_assoc();
            if ($password = password_hash($_POST['password'], PASSWORD_DEFAULT)) {
                $data = [
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $row,
                ];
                
            } else {
                $data = [
                    'success' => false,
                    'message' => 'invalid password'
                ];
            };
        };
    }
    echo json_encode($data);
} else {
    $data = [
        'success' => false,
        'message' => 'please fill all the informations'
    ];
    echo json_encode($data);
}


?>
