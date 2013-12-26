<?php
/*-------------------------------------------------------------------------------------------------
Name: Carine Melhorn
Project Name: p4.test-csie15.biz
Rankings Controller is the controller that provides 2012 Conflict Minerals Company Rankings from
http://www.raisehopeforcongo.org/companyrankings
This project is designed for academic purposes and all sources to compute ranking and scores derived from the Enough Project campaign.
   -------------------------------------------------------------------------------------------------*/
class rankings_controller extends base_controller
{

    public function __construct()
    {
        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if (!$this->user) {

            Router::redirect('/users/login');

        }
    }

    /*----------------------------------------------------------------------------------------------------------------------
    Index is the landing page that will list the company profiles information
    And provides the view to use the conflict Minerals tool that will allow users to find out the score of the manufacturer
    that produced their devices. Each Manufacturer is assigned a score between 0 and 60 ->

    0-15: status Red- not compliant - supply chain is probably contains conflict minerals within their inventory.

    16-29: Status Yellow - company is making some progress to comply their supply chain tracking mineral resources and
    attempting to eliminate conflict minerals.

    30-60: Status Green: -company is adopting a transparent process and filing/reporting data on their supply chain so that conflict
     mineral resources can be traced out of their inventory

    -----------------------------------------------------------------------------------------------------------------------*/

    public function index()
    {
        # setup views to load specific js
        # Create an array of 1 or many client files to be included before the closing </body> tag
        $client_files_body = Array(
            '/js/rankings.js'

        );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Set up the View
        $this->template->content = View::instance('v_rankings_index');
        $this->template->title = "Company Rankings";


       /*_______________________________________________________________________________________________________________
       Conflict Mineral Tool logic begins here
       ----------------------------------------------------------------------------------------------------------------*/
        # 1.Query to select a device_type from the db
        $q = 'SELECT *
        FROM device_type
        Order by name';

        # 2.Run the query, to display  the results in the variable $device_type that will be loaded in the select form
        $device_type = DB::instance(DB_NAME)->select_rows($q);


        # 3.Pass data to the View
        $this->template->content->device_types = $device_type;

        # 6.setup query for retrieving manufacturer
        # Query
        $q2 = 'SELECT *
        FROM company_rankings
        Order by company_name';

        #7. Run the query, store the results in the variable $posts
        $company_name = DB::instance(DB_NAME)->select_rows($q2);

        # 8.Pass data to the View
        $this->template->content->company_names = $company_name;


        # 8.Render the View
        echo $this->template;
    }
    /*---------------------------------------------------------------------------------------------------------------------
     Ranking control is the function that
    1) Does a lookup to the company_rankings table to obtain score, when a user click on a score button (after filling out form)
    2) Store all _POST[] information collected via the form into users_devices table
    -------------------------------------------------------------------------------------------------------------------------*/
    public function ranking()
    {
        $company_id = $this->sanitize_id($_POST['company_id']);

     // Step 1 - Insert information collected from the user selection into the devices table

        $_POST['user_id']=$this->user->user_id;
        $user_device_info = DB::instance(DB_NAME)->insert("users_devices", $_POST);

        //setting up JSon/building data object
        $data = Array();


        #Refreshing user status once they add a new device
            #step 1 - get status from user
            $status = $this->status($this->user->user_id);
            #step 2 - storing inside session
            $_SESSION['status'] = $status;
            $data['score_status'] = $status;

        //step 2 - Read operation

        # setup query for retrieving manufacturer
        # Query
        $q2 = 'SELECT *
        FROM company_rankings
        WHERE company_id =' . $company_id;

        # Run the query, store the results in the variable $posts
        $companies = DB::instance(DB_NAME)->select_rows($q2);

        if (count($companies) == 1) {
            //    echo $companies[0]['score'];
            $company = $companies[0];
            $data['comapny_score'] = $company['score'];

        } else {

            $data['comapny_score'] =-1;
        }
        echo json_encode($data);



    }

    public function control_panel() {

        # Setup view
        $this->template->content = View::instance('v_rankings_control_panel');
        $this->template->title   = "Control Panel";

        # JavaScript files
        $client_files_body = Array(
            '/js/jquery.form.js',
            '/js/rankings_control_panel.js');
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
        echo $this->template;
    }





    public function p_control_panel() {

        $data = Array();

        # Find out how many posts there are
        $q = "SELECT count(post_id) FROM posts where user_id =".$this->user->user_id;
        $data['post_count'] = DB::instance(DB_NAME)->select_field($q);

        # Find out how many posts there are
        $q = "SELECT count(device_id) FROM users_devices where user_id =".$this->user->user_id;
        $data['device_count'] = DB::instance(DB_NAME)->select_field($q);

        # Find out how many users there are
        $q = "SELECT count(user_id_followed) FROM users_users where user_id =".$this->user->user_id;;
        $data['users_followed'] = DB::instance(DB_NAME)->select_field($q);

        # Find out when the last post was created
        $q = "SELECT created FROM posts ORDER BY created DESC LIMIT 1";
        $data['most_recent_post'] = Time::display(DB::instance(DB_NAME)->select_field($q));

        # Send back json results to the JS, formatted in json
        echo json_encode($data);
    }




    public function ranking_user (){
          # Setup view
          $this->template->content = View::instance('v_rankings_users');
          $this->template->title = "About CMBuzz";


          # Render template
          echo $this->template;


      }
}#eoc
