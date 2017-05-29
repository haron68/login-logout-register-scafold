<?php
require_once 'core/init.php';

if (!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    $user = new User();
    $db   = DB::getInstance();
    
    if (!$user->hasPermission('admin')) { // For the non adminstrator user
        $name = '';

        $session_user = $db->action('SELECT *', 'users', array('name', '=', $_GET['user']));

        foreach($session_user->results() as $row) {
            $name = $row->name;
        }

        if ($session_exists = Session::exists('user')) {
            if ($name == ($user->data()->name)) {
                $userData = $user->data()->name;
?>
<h3><?php echo $userData; ?></h3>
<?php
            } else {
                echo 'User does not exist!';
            }
        } else {
            echo 'false';
        }
    } else { // For the adminstrator
        $name = '';
        $employee = new User(8);

        $session_user = $db->action('SELECT *', 'users', array('name', '=', 'test'));

        foreach($session_user->results() as $row) {
            $name = $row->name;
        }

        if ($session_exists = Session::exists('user')) {
            if ($name == ($employee->data()->name)) {
                $employeeData = $employee->data()->name;
?>
<h3><?php echo $employeeData; ?></h3>
<?php
            } else {
                echo 'User does not exist!';
            }
        } else {
            echo 'false';
        }
    }
}