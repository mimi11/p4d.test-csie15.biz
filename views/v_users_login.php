<?php if ($user): ?>

    <p> You are logged in as <?= $user->first_name ?> <?= $user->last_name ?> </p>
    <p> Check out your profile <a href='/users/profile'> here</a> Or Follow the Chatters community
        <a href='/posts/users'>here</a></p> to hear about the lattest chatters

    <!-- Menu options for users who are not logged in -->
<?php else: ?>
    <div class="login">

        <form class='login_form' id='validate_login' method='POST' action='/users/p_login'>
            <p>
                <label for="cemail">* E-Mail </label>
                <br>
                <input id="cemail" type="email" name="email" required/>
            </p>

            <p>
                <label for="password"> * Password (at least 4 characters)</label>
                <br>
                <input id="password" name="password" minlength="4" type="password" required/>
            </p>

            <?php if ($error == 'password_error'): ?>
                <div class='error' style="color: red; line-height: 1.2">
                    Login failed. Please double check your password.
                </div>
                <br>
            <?php endif; ?>

            <?php if ($error == 'email_error'): ?>
                <div class='error' style="color: red; line-height: 1.2">
                    Login failed. Please double check your email.
                </div>
                <br>
            <?php endif; ?>

            <input type='submit' value='Sign in'>
        </form>

        <!--Jquery validation begins here-->


    </div><!--end of Loging div-->


<?php endif; ?>
