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
        </form>
    </div>
</section>