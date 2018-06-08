<section class="login-page">
    <div class="form">
        <form class="login-form" action="account" method="post">
            <p class="register-form_title">
                Personal page
            </p>
            <p>ID: <?= $user_id ?></p>
            <p><b>Login: <?= $user_login ?></b></p>
            <input type="text" name="login" placeholder="enter new login" value=""/>
            <button name="submit"/>Change login</button>
            <p><b>Email: <?= $email ?></b></p>
            <input type="text" name="email" placeholder="enter new email" value=""/>
            <button name="submit1"/>Change email</button>
            <button formaction="changepass"/>Change password</button>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <p>Status notification:<b><?= $notific?> </b></p>
            <button name="submit2"/>On</button>
            <button name="submit3"/>Off</button>
         </form>
    </div>
</section>