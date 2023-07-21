<?php
header("Access-Control-Allow-Origin: *");
include './connection.php';


if (isset ($_POST['user_id']) && isset ($_POST['title']) && isset($_POST['description'])) {
    $userId = $_POST['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('y-m-d');

    if (!filter_var($userId, FILTER_VALIDATE_INT)) {
        $data = [
            'success' => false,
            'message' => 'invalid user id'
        ];
    } else {
        $sql = "UPDATE todos SET title='$title', description='$description', date='$date' WHERE user_id='$userId'";
        $result = $conn->query($sql);

        if ($result) {
            $data = [
                'success' => true,
                'message' => 'todo updated successfully'
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'todo updating failed'
            ];
        }
    }
    echo json_encode($data);
} else {
    $data = [
        'successe' => false,
        'message' => 'please fill all the fields'
    ];
    echo json_encode($data);
}

?>