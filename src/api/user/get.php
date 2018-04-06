<?php
    require_once("../../config.php");
    require_once(CLASSES_ROOT . "user.php");

    $requestedId = null;
    $requestedUsername = null;

    if (isset($_GET['id']))
    {
        $requestedId = $_GET['id'];
        $u = User::fromId($requestedId);

        if ($u == null)
        {
            $response = array("status" => "error", "result" => null, "description" => "User not found with ID.");
            echo json_encode($response);
        }
        else
        {
            $response = array("status" => "success", "result" => $u);
            echo json_encode($response);
        }
    }
    elseif (isset($_GET['username']))
    {
        $requestedUsername = $_GET['username'];
        $u = User::fromUsername($requestedUsername);

        if ($u == null)
        {
            $response = array("status" => "error", "result" => null, "description" => "User not found with username.");
            echo json_encode($response);
        }
        else
        {
            $response = array("status" => "success", "result" => $u);
            echo json_encode($response);
        }
    }
    else
    {
        $response = array("status" => "error", "description" => "Missing parameter 'id' AND 'username'");
        echo json_encode($response);
    }
?>