<?php
/*-------------------------------------------------------------------------------------------------
Name: Carine Melhorn
Project Name: p4.test-csie15.biz
github username: mimi11
   -------------------------------------------------------------------------------------------------*/
class users_controller extends base_controller
{

    public function __construct()
    {
        parent::__construct();
        # echo "users_controller construct called<br><br>";
    }

    public function index()
    { # If user is blank, they're not logged in; redirect them to the login page
        if (!$this->user) {

            Router::redirect('/users/login');
        } else {
            Router::redirect('/users/profile');


        }
        #set up views

        $this->template->content = View::instance('v_index_index');

        # View within a view
        $this->template->content->signup = View::instance('v_signup');

    }

    public function signup($error = NULL)
    {

        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = "Sign Up";


        #Pass data to the view
        $this->template->content->error = $error;


        # Render template
        echo $this->template;

    }

    public function p_signup()
    {

        # More data we want stored with the user
        $_POST['created'] = Time::now();
        $_POST['modified'] = Time::now();


        # Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT . $_POST['password']);

        # Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT . $_POST['email'] . Utils::generate_random_string());


        # Confirm if duplicate email
        $email = $_POST['email'];


        # Signup form error checking

        # 1.Confirming if they have a duplicate email

        if ($this->userObj->confirm_unique_email($email) == False) {
            Router::redirect("/users/signup/duplicate_email_error");

        }

        #2. Check for Required field names blank fields
        $required = array('first_name', 'last_name', 'email', 'password');

        # Loop over field names, make sure each one exists and is not empty
        $error = false;

        foreach ($required as $field) {

            if (empty($_POST[$field])) {
                $error = true;
            }
        }
        # 3.Redirect in case of error

        if ($error) {
            Router::redirect("/users/signup/blank_fields_error");
        } else {

            # But if no errors exist - sign-up succeeded!Insert this user into the database
            $new_user = DB::instance(DB_NAME)->insert("users", $_POST);


            # Send an email to the user's email address.
            # Build a multi-dimension array of recipients of this email
            $to[] = Array("name" => $_POST['first_name'], "email" => $_POST['email']);

            # Build a single-dimension array of who this email is coming from
            # note it's using the constants we set in the configuration above)
            $from = Array("name" => APP_NAME, "email" => APP_EMAIL);

            # Subject
            $subject = "Welcome to CMBUZZ";

            # You can set the body as just a string of text
            $body = "This is just a message to confirm your registration at CMBUZZ.biz";

            # if email is complex and involves HTML/CSS, you can build the body via a View like we do in our controllers
            # $body = View::instance('e_users_welcome');

            # Build multi-dimension arrays of name / email pairs for cc / bcc if you want to
            $cc = "";
            $bcc = "";

            # With everything set, send the email
            $email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);

            # Confirm they've signed up -


            # log in users after successful sign-up)
            if ($new_user) {
                setcookie('token', $_POST['token'], strtotime('+1 year'), '/');
            }

            # Send them to their profile
            Router::redirect('/users/profile');
        }
    }

    public function login($login_error = NULL)
    {


        # Setup view
        $this->template->content = View::instance('v_users_login');

        $this->template->title = "login";
        $this->template->content->error = $login_error;

        # Render template
        echo $this->template;


    }

    public function p_login()
    {
        # check if user is already logged in, if yes redirect to profile
        if ($this->user) {

            # send them back to their profile
            Router::redirect('/users/profile');


        } else {
            # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);

            # Hash submitted password so we can compare it against one in the db
            $_POST['password'] = sha1(PASSWORD_SALT . $_POST['password']);

            # Search the db for this email and password
            # Retrieve the token if it's available

            $q = "SELECT token
        FROM users
        WHERE email = '" . $_POST['email'] . "'
        AND password = '" . $_POST['password'] . "'";

            $token = DB::instance(DB_NAME)->select_field($q);

            #--Check if email is empty
            $q1 = "SELECT email
        FROM users
        WHERE email = '" . $_POST['email'] . "'";


            $email = DB::instance(DB_NAME)->select_field($q1);


        }


        # If we didn't find a matching token in the database, it means login failed
        if (!$token) {
            if (!$email) {
                Router::redirect("/users/login/email_error");
            } else {
                # Send them back to the login page

                Router::redirect("/users/login/password_error");
            }

            # But if we did, login succeeded!

        } else {


            /*
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+2 weeks'), '/');



            # Send them to the main page - or whever you want them to go
            Router::redirect('/');

        }


    }

    protected function getAvatarFileName()
    {
        //get the name of the file from the db select image where user -.this user.id
        $q= 'SELECT image
                From users
                WHERE user_id = '
            . "'"
            .$this->user->user_id
            . "'";
        $avatar =DB::instance(DB_NAME)->select_field($q);


        if ($avatar == true) {


           return $avatar;

        } # Means there is something went wrong - e.g parameter is wrong since update() should only update a single row.
        else {
             return "avatar.jpg";

        }
    }


     public function getControl_panel(){
        //view for user to provide information about a device they own
         # Setup view
         $this->template->content = View::instance('v_users_control_panel');
         $this->template->title   = "Control Panel";

         # JavaScript files
         $client_files_body = Array(
             '/js/jquery.form.js',
             '/js/rankings_control_panel.js');
         $this->template->client_files_body = Utils::load_client_files($client_files_body);

         # Render template
         echo $this->template;
     }





      public function p_user_device(){
       // form to process user devices information

      }



    public function logout()
    {
        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT . $this->user->email . Utils::generate_random_string());
        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '" . $this->user->token . "'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        #Send them back to the main index.
        Router::redirect("/");

    }

    public function bio()
    {
        $profile_id = DB::instance(DB_NAME)->select_row('SELECT * FROM users WHERE user_id = ' . $this->user->user_id);

        # Setup view
        $this->template->content = View::instance('v_users_bio');

        #select all from user-id from db
        $this->template->title = "View/Edit Bio Info";

        #pass data to the view
        $this->template->content->post = $profile_id;

        $this->template->content->avatar = $this->getAvatarFileName();


        # Render template
        echo $this->template;


    }

    public function p_bio()
    {

        $bio = array();

        # Unix timestamp of when this post was modified
        $bio['modified'] = Time::now();

        # This variable will update the content from the user update
        $bio['first_name'] = $_POST['first_name'];
        # This variable will update the content from the user update
        $bio['last_name'] = $_POST['last_name'];
        # This variable will update the content from the user update
        $bio['password'] = $_POST['password'];
        # This variable will update the content from the user update
        $bio['email'] = $_POST['email'];

        #storing into user object $post and passing back to the DB










        # Update this user into the database

        $number_of_rows_updated = DB::instance(DB_NAME)->update('users', $bio,
            "WHERE user_id = '"
            . $this->user->user_id
            . "'");


        if ($number_of_rows_updated == 1) {
            echo "Your bio  has been updated <a href='/users/profile'>Back to your post</a>";
        } # Means there is something went wrong - e.g parameter is wrong since update() should only update a single row.
        else {
            echo "Unable to update your bio <a href='/users/p_bio'>Back to your post</a>";
        }

    }

/*This function serves to upload users profile new avatar picture
 *
 */
    public function bio_update(){
        // if user specified a new image file, upload it
        if ($_FILES['file']['error'] == 0)
        {
            //upload an image
            $avatar = Upload::upload($_FILES, "/uploads/avatars/", array("JPG", "JPEG", "jpg", "jpeg", "gif", "GIF", "png", "PNG"), $this->user->user_id);

            if($avatar == 'Invalid file type.') {
                // return an error
                #  Router::redirect("/users/profile/error");
                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            }
            else {
                // process the upload
                $data = Array("image" => $avatar);
                DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);

                // resize the image
                $image = new Image($_SERVER["DOCUMENT_ROOT"]. '/uploads/avatars/' . $avatar);
                $image->resize(100,100, "crop");
                $image->save_image($_SERVER["DOCUMENT_ROOT"]. '/uploads/avatars/' . $avatar);


            }


        }
        else
        {
            // return an error
            Router::redirect("/users/profile/error");
        }

        // Redirect back to the profile page
        router::redirect('/users/profile');
    }



    public function profile()
    {


        # If user is blank, they're not logged in; redirect them to the login page
        if (!$this->user) {
            Router::redirect('/users/login');
        }


        $this->template->title = "Profile";


        # If they weren't redirected away, continue:

        # Setup view
        $this->template->content = View::instance('v_users_profile');
        # JavaScript files
        $client_files_body = Array(
            '/js/jquery.form.js',
            '/js/rankings_control_panel.js');
        $this->template->client_files_body = Utils::load_client_files($client_files_body);



        # Query for all posts information pertinent to the user only
        $q = 'SELECT
            posts.content,
            posts.post_id,
            posts.created,
            posts.user_id AS post_user_id,
            users.first_name,
            users.last_name,
            users.user_id
        FROM posts
        INNER JOIN users
            ON posts.user_id = users.user_id
        WHERE users.user_id = ' . $this->user->user_id;


        # Run the query, store the results in the variable $posts
        $post_profile = DB::instance(DB_NAME)->select_rows($q);


        # Pass data to the View
        $this->template->content->posts = $post_profile;
        $this->template->content->avatar = $this->getAvatarFileName();



        # Render template
        echo $this->template;


    }


} # end of the class
