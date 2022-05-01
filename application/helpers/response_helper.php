<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function sendError($error)
{
    header('Content-Type: application/json');
    header('HTTP/1.1 401 Unauthorized', true, 401);
    echo json_encode(array("error" => $error));

}

function sendSuccess($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);

}

function sendSuccessResult($message)
{
    header('Content-Type: application/json');
    echo json_encode(array('result' => $message));
}

