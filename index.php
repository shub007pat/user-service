<?php
// Include database configuration
require 'config/database.php';

// Get the HTTP method and path
$method = $_SERVER['REQUEST_METHOD'];

$request_uri = $_SERVER['REQUEST_URI'];

// Extract the path from REQUEST_URI
$path = parse_url($request_uri, PHP_URL_PATH);

// Remove any base path from the path
$base_path = '/user-service'; // Update this to your actual base path
$path = str_replace($base_path, '', $path);

// Parse the path to determine the request
$request = explode('/', trim($path, '/'));


// Connect to the database
$db = new Database();

if ($method === 'POST' && $request[0] === 'users') {
    // Add a new user
    $input = json_decode(file_get_contents('php://input'), true);
    $user_id = $db->addUser($input);
    echo json_encode(array('user_id' => $user_id));
} elseif ($method === 'POST' && $request[0] === 'login') {
    // User login
    $input = json_decode(file_get_contents('php://input'), true);
    $user = $db->loginUser($input);
    if ($user) {
        echo json_encode(array('message' => 'Login successful'));
    } else {
        echo json_encode(array('message' => 'Login failed'));
    }
} elseif ($method === 'GET' && $request[0] === 'users') {
    // To get the user details, pass the id as a query parameter
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if ($id) {
        $user = $db->getUserDetails($id);
        echo json_encode($user);
    } else {
        // Return an error or handle the case where id is missing
        echo json_encode(array('error' => 'User ID is missing'));
    }
}
