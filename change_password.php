<?php
require_once 'core/init.php';

$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('csrf_token'))) {
        
        $validate   = new Validate();
        $validation = $validate->check($_POST, array(
            'old_password'      => array(
                'required'  => 'true',
                'min'       => 6
            ),
            'password'          => array(
                'required'  => 'true',
                'min'       => 6
            ),
            'confirm_password'  => array(
                'required'  => 'true',
                'min'       => 6,
                'matches'   => 'confirm_password'
            )
        ));
    }
    
    if ($validation->passed()) {
        
        if (Hash::make(Input::get('old_password'), $user->data()->salt) !== $user->data()->password) {
            echo 'Your current password is incorrect';
        } else {
            $salt = Hash::salt(32);
            $user->update(array(
                'password'  => Hash::make(Input::get('password'), $salt),
                'salt'      => $salt
            ));
            
            Session::flash('home', 'Your password has been successfully updated!');
            Redirect::to('index.php');
        }
        
    } else {
        foreach($validation->errors() as $error) {
            echo $error, '<br>';
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="username">Enter Current Password</label>
        <input type="password" name="old_password" id="old_password">
    </div>
    
    <div class="field">
        <label for="password">New Password</label>
        <input type="password" name="password" id="password">
    </div>
    
    <div class="field">
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" name="confirm_password" id="confirm_password">
    </div>
    
    <input type="hidden" name="csrf_token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Update Password">
</form>