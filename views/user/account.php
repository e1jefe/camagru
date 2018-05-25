<section class="login-page">
    <div class="form">
        <form class="login-form" action="account">
            <p class="register-form_title">
                Personal page
            </p>
            <p>Your id: <?= $user_id ?></p>
            <p>Account name: <?= $user_login ?></p>
            <button name="submit"/>Change Account name</button>
            <p>Email: <?= $email ?></p>
            <button name="submit1"/>Change email</button>
            <button formaction="changepass"/>Change password</button>
        </form>
    </div>
</section>
<!--<html>-->
<!--<head>-->
<!--    <title>test</title>-->
<!--    <script type="text/javascript">-->
<!--        function modify_qty(val) {-->
<!--            var qty = parseInt(document.getElementById("qty").value, 10);-->
<!--            var new_qty = qty + val;-->
<!--            document.getElementById("qty").value = new_qty;-->
<!--            return new_qty;-->
<!--        }-->
<!--    </script>-->
<!--    <style>-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<form name="form">-->
<!--    <label>Quantity</label>-->
<!--    <input type="text" id="qty" value="0" />-->
<!--    <input type="button" value="-1" onClick="modify_qty(+1)">-->
<!--</form>-->
<!--</body>-->
<!--</html>-->
