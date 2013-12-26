$(document).ready(function () {
// Handler for .ready() called.
    //settinp data objects to receive Json
    $('#score').click(function () {
        var device_type_id = $('#device_type').val();
        var company_id = $('#company_id').val();
        $.ajax({
            type: 'POST',
            url: '/rankings/ranking',
            data: {
                //Post_object data that is passed to the controller with matching parameters of the user_devices columns
                device_type_id: device_type_id,
                company_id: company_id
            },

            success: function (response) {

                // For debugging purposes
                //console.log(response);

                // Example response: {"post_count":"9","user_count":"13","most_recent_post":"May 23, 2012 1:14am"}

                // Parse the JSON results into an array
                var data = $.parseJSON(response);


                // Inject the data into the page
                $('#company_score').html("company score: ");
                $('#result').html(data['comapny_score']);

                //set the class of the session_status div  setting the value of a the attribute we want to pass in a
                //new value  and pass in the original name

                $('.session_status').attr("class", "user_status " + data['score_status']);

                //set the class of the session_status div
            }
        });


    });


});





