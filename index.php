<?php
require_once 'core/init.php';

if (Session::exists('home')) {
    echo '<p>'. Session::flash('home') .'</p>';
}

$user = new User();

if ($user->isLoggedIn()) {
?>
    <p>Hello, <a href="profile.php?user=<?php echo escape($user->data()->name); ?>"><?php echo escape($user->data()->name); ?></a>!</p>

    <ul>
        <li><a href="logout.php">Log out</a></li>
        <li><a href="update.php">Update details</a></li>
        <li><a href="change_password.php">Change password</a></li>
    </ul>

<?php
    if ($user->hasPermission('admin')) {
        echo '<p>Welcome, Admin!</p>';
    } 
} else {
    echo '<p>You need to <a href="login_process.php">log in</a></p>';
}