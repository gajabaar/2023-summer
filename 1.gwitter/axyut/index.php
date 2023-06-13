<?php
require_once 'includes/header.php';
?>
<div class="auth-page">
    
<div class="container">
       <h3>Login to your account</h3>
    <form method="POST" action="login.php">
        <div class="inputFields">
       
        <input type="text" name="username" placeholder="Username"/>
       
        <input type="text" name="password" placeholder="Password"/>
        <button class="active-btn" type="submit"> <span>Login</span></button></div>
        
    </form>
    </div>
    
    <div class="container">
        
       <h3>Create new Account</h3>
    
    <form method="POST" action="register.php">
    <div class="inputFields"><input type="text" name="username" placeholder="Username"/>
        <input type="text" name="password" placeholder="Password"/>
        <input type="text" name="cPassword" placeholder="Confirm password"/>
         <button class="active-btn" type="submit"><span>Register</span></button></div>
       
    </form>
    </div>
</div>
<div class="container"><h2>About gwitter</h2></div>
    



<?php
require_once 'includes/footer.php';
?>