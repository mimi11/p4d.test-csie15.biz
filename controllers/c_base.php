<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
						
		# Instantiate User obj
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();					
						
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
			
	}

    /*___________________________________________________________________________________________
    The purpose of this function is to ensure that we sanitize user input throughout the application


   _____________________________________________________________________________________________
   */
    protected function sanitize_id($id){
        #this check for SQL injection attack by eliminating text from the input variable.
        if(is_numeric($id)){
            return intval($id);
        }

        return -1;
    }

    /*This method calculates average score for each devices owned by a user. The average score will equate to the user status as being
     * green -compliant, yellow - some effort toward CM free and red - devices is using conflict mineral resources
     * status follow user during a session variable
     */
    protected function status($user_id)
    {
        #step1 - query db to compute average score for devices owned by user

        $q= 'Select avg (b.score) as average_score
        from users_devices a,company_rankings b
        where a.company_id = b.company_id
        AND a.user_id='.$user_id;


        #step2 - run query
        $average_score= DB::instance(DB_NAME)->select_rows($q);

        #Return status



        if(count($average_score)==1){
           if( $average_score[0]['average_score'] === null){
               return "";
           }

            $calculated_score= floatval($average_score[0]['average_score']);


            #assuming at least 1 device
            if($calculated_score>= 30){
                return "status_green";
            }
            if($calculated_score>=16){
                return "status_yellow";
            }
            return "status_red";

        }else{
            return "";
        }


    }


} # eoc
