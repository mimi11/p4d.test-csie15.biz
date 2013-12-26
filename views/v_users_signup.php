<div class='signup'>
    <p> * Denotes all required fields for registration, your email will be used as your login id</p>

    <form class='signup_form' id='validate_signup' method='POST' action='/users/p_signup'>

        <p>
            <label for="first_name"> * Firstname</label>
            <input id="first_name" name="first_name" type="text" required/>
        </p>

        <p>
            <label for="last_name">* Lastname</label>
            <input id="last_name" name="last_name" type="text" required/>
        </p>

        <p>
            <label for="password"> *Password</label>
            <input id="password" name="password" minimum-legnth="4" type="password" required/>
        </p>

        <p>
            <label for="email">* Email</label>
            <input id="email" name="email" type="email" required>
        </p>
        <?php if ($error == 'duplicate_email_error'): ?>
            <div class='error' style="color: red; line-height: 1.2">
                Sign up failed. E-Mail address already registered.
            </div>
            <br>
        <?php endif; ?>

        <?php if ($error == 'blank_fields_error'): ?>
            <div class='error' style="color: red; line-height: 1.2">
                Sign up failed. All fields must have a value
            </div>
            <br>

        <?php endif; ?>

        <br><br>
        <input type='submit' value='Sign up'>

    </form>

</div>
