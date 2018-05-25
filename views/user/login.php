<section class="login-page">
    <div class="form">
        <form class="login-form" action="login" method="post">
            <p class="register-form_title">
                Sign in
            </p>
            <input type="text" name="login" placeholder="username" value="" />
            <input type="password" name="passwd" placeholder="password" value="" />
            <button name="submit" value="OK" />login</button>
            <p class="message">Not registered? <a href="registration">Create your account</a></p>
            <p class="message"><a href="passwordrecovery">Forgot password?</a></p>
            <a href=" https://www.facebook.com/v2.9/dialog/oauth?client_id=<?=ID?>&redirect_uri=<?=URL?>&response_type=code&scope=public_profile,email">Войти через ФБ</a>
        </form>
    </div>
</section>