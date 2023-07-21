<?php
header("Access-Control-Allow-Origin: *");
include './connection.php';


if (isset($_POST['id']) && isset ($_POST['user_id'])) {
    $id = $_POST['id'];
    $userId = $_POST['user_id'];
    $sql = "DELETE FROM todos WHERE id = '$id' && user_id='$userId'";
    $result = $conn->query($sql);

    if ($result) {
        $data['success'] = true;
        $data['message'] = 'Todo deleted successfully';
    } else {
        $data['success'] = false;
        $data['message'] = 'Deleting failed';
    }

    echo json_encode($data);
} else {
    $data['success'] = false;
    $data['message'] = 'Please fill all the fields';
    echo json_encode($data);
}