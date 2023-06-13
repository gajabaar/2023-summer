<?php
require_once 'includes/header.php';
?>
<div class="auth-page">
    
<div class="container">
       <h3>Login to your account</h3>
    <form method="POST" action="login.php">
        <div class="inputFields">
       
        <input  class="input-field"  type="text" name="username" placeholder="Username"/>
       
        <input  class="input-field" type="text" name="password" placeholder="Password"/>
        <button class="active-btn" type="submit"> <span>Login</span></button></div>
        
    </form>
    </div>
    
    <div class="container">
        
       <h3>Create new Account</h3>
    
    <form method="POST" action="register.php">
    <div class="inputFields">
        <input class="input-field" type="text" name="username" placeholder="Username"/>
        <input class="input-field" type="text" name="password" placeholder="Password"/>
        <input class="input-field"  type="text" name="cPassword" placeholder="Confirm password"/>
         <button class="active-btn" type="submit"><span>Register</span></button></div>
       
    </form>
    </div>
</div>
<div class="container"><h2>About gwitter</h2>
    <h3>
    
    An application with similar in features of twitter,
but we will call it gwitter. Users will be able to sign up, sign in and sign out.
Once signed in, they will be able to follow other users.
On their home page, they will be able to see the feed
of tweets from people that they follow.
Your users should also be able to see their own profile
and tweets.

    </h3>

   
    <h2>SQLite Database</h2> 
    <h3>
SQLite is used primarily because
it's light-weight and easy to get up and running.

All the application data such as registered users, generated gweets, further comment gweets, your followers and whom you're following are implemented with sqlite3 database.
</h3>
<h2>PHP backend</h2>
<h3>

With PHP, user sign up, sign in, sign out, post gweets, follow eachother, connected to sqlite database.
</h3>
<h2>Gwitter Frontend (Html, Css, Js)</h2>
<h3>

A CSS framework to make it look prettier, added new features that hihglight the user experience and interface, and some bug fixes.

A Dockerfile is also setup that will install and run your application.
</h3>
<h2>Security and Tests</h2>
<h3>
A security scan of the application using openvas is to be done and then pick a vulnerability that openvas reports (or doesn't report but you know from reading their source code that it's a vulnerability)
then do a deep dive on how you can exploit that vulnerability.

    </h3>
</div>
    



<?php
require_once 'includes/footer.php';
?>