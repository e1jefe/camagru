
<section class="changepassmail">
    <div class="form">
        <form class="register-form" action="changepassmail" method="post">
            <p class="register-form_title">
                Change password
            </p>
            <input type="password" name="pass" placeholder="enter password" value=""/>
            <input type="password" name="newpass" placeholder="confirm password" value=""/>
            <input type="hidden" name="email" value="" />
            <input type="hidden" name="token" value="" />
            <button name="submit" value="OK" />Submit</button>
<!--            <p class="message">Already registered? <a href="login">Sign In</a></p>-->
        </form>
    </div>
</section>
    <script>
        document.addEventListener("DOMContentLoaded", function (e) {
            console.log("here");
            let url = new URL(window.location.href);
            let email = url.searchParams.get("email");
            let token = url.searchParams.get("token");
            console.log("email:", email, "token:", token);
            let emailInput = document.getElementsByName("email")[0];
            let tokenInput =  document.getElementsByName("token")[0];
            console.log("emailInput:", emailInput, "tokenInput:", tokenInput);
            emailInput.value = email;
            tokenInput.value = token;
        });
    </script>
