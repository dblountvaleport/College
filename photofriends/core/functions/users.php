<?php

function change_password($user_id, $password) {
    $user_id = (int)$user_id;
    $password = md5($password);
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');

    $sql = "UPDATE users SET password = '$password' WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "Password successfully changed.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function register_user($register_data) {
    array_walk($register_data, 'array_sanitize');
    $register_data['password'] = md5($register_data['password']);

    $fields = '`' . implode('`, `', array_keys($register_data)) . '`';
    $data = '\'' . implode('\', \'', $register_data) . '\'';

    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
    $sql = "INSERT INTO `users` ($fields) VALUES ($data)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function user_count() {
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
    $query = mysqli_query($conn,"SELECT COUNT(user_id) AS mycount FROM users");
    $res = mysqli_fetch_object($query);
    $count = $res->mycount;
    return $count;
}

function user_data($user_id) {
    $data = array();
    $user_id = (int)$user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 1) {
        unset($func_get_args[0]);

        $fields = '`' . implode('`, `', $func_get_args) . '`';
        $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
        $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT $fields FROM users WHERE user_id = $user_id"));

        return $data;
    }
}

function logged_in() {
    return (isset($_SESSION['user_id'])) ? true : false;
}

function user_exists($username) {
    $username = sanitize($username);
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
    $query = mysqli_query($conn,"SELECT COUNT(user_id) AS mycount FROM users WHERE username = '$username'");
    $res = mysqli_fetch_object($query);
    $count = $res->mycount;
    if ($count == 0)
    {
        return false;
    }
    if ($count == 1)
    {
        return true;
    }
}

function email_exists($email) {
    $username = sanitize($email);
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
    $query = mysqli_query($conn,"SELECT COUNT(user_id) AS mycount FROM users WHERE email = 'email'");
    $res = mysqli_fetch_object($query);
    $count = $res->mycount;
    if ($count == 0)
    {
        return false;
    }
    if ($count == 1)
    {
        return true;
    }
}

function user_id_from_username($username) {
    $username = sanitize($username);
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
    $query = mysqli_query($conn,"SELECT user_id FROM users WHERE username = '$username'");
    $res = mysqli_fetch_object($query);
    $result = $res->user_id;
    return $result;
}

function login($username, $password) {
    $user_id = user_id_from_username($username);

    $username = sanitize($username);
    $password = md5($password);

    //return (mysql_result(mysql_query("SELECT COUNT(user_id) as mycount FROM users WHERE username = '$username' AND password = '$password'"), 0) == )1 ? $user_id : false;

    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
    $query = mysqli_query($conn,"SELECT COUNT(user_id) as mycount FROM users WHERE username = '$username' AND password = '$password'");
    $res = mysqli_fetch_object($query);
    $count = $res->mycount;
    if ($count == 1)
    {
        $query = mysqli_query($conn,"SELECT user_id FROM users WHERE username = '$username' AND password = '$password'");
        $res = mysqli_fetch_object($query);
        $result = $res->user_id;
        return $result;
    } else {
        return false;
    }
}

?>