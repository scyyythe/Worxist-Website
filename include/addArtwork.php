<?php
session_start();


function randomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstunvwxyzABCDEFGHIJKLMNOPQRSTUNVWXYZ';
    $str = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}

if (isset($_POST['uploadArt'])) {
    $result = [];


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // create file directory
        if (!is_dir('files')) {
            mkdir('files');
        }

        $a_status = 'Pending';
        $u_id = $_SESSION['u_id'];

        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        // Insert image
        $file = $_FILES['file'] ?? null;
        $filePath = '';

        if ($file && $file['tmp_name']) {
            $filePath = 'files/' . randomString(8) . '/' . $file['name'];

            // create the directory
            mkdir(dirname($filePath));

            //move image to directory
            move_uploaded_file($file['tmp_name'], $filePath);
        }

        //insert art detais sa database
        $statement = $conn->prepare("INSERT INTO art_info (u_id, title, description, category, file, a_status) VALUES (:u_id, :title, :description, :category, :file, :a_status)");

        //bind value
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':file', $filePath);
        $statement->bindValue(':a_status', $a_status);

        $result = $statement->execute();

        if ($result) {
            $_SESSION['u_id'] = $u_id;
            $_SESSION['title'] = $title;
            $_SESSION['description'] = $description;
            $_SESSION['category'] = $category;
            $_SESSION['file'] = $filePath;
            $_SESSION['a_status'] = $a_status;

            header("Location: dashboard.php");
            die;
        }
    }
}
?>
