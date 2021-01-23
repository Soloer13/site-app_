$(document).ready(function () {

    // show html form when 'update roUnit' button was clicked
    $(document).on('click', '.update-roUnit-button', function () {
        // roUnit ID will be here

        // get roUnit id
        var id = $(this).attr('data-id');


        // read one record based on given roUnit id
        $.getJSON("http://localhost/masirah/site-app/api/roUnit/read_one.php?id=" + id, function (data) {

            // values will be used to fill out our form
            let id = data.ROId;
            let unit = data.unit;
            let createdOn = data.created_on;
            let modifiedOn = data.modified_on;

            // update roUnit html will be here

            // store 'update roUnit' html to this variable
            var update_roUnit_html = `
                    <div id='read-roUnits' class='btn btn-primary pull-right m-b-15px read-roUnits-button'>
                        <span class='glyphicon glyphicon-list'></span> Read roUnits
                    </div>
                    
                    <!-- build 'update roUnit' html form -->
                    <!-- we used the 'required' html5 property to prevent empty fields -->
                    <form id='update-roUnit-form' action='#' method='post' border='0'>
                        <table class='table table-hover table-responsive table-bordered'>
                    
                            <!-- Id field -->
                            <tr>
                                <td>Id</td> <!-- don't know why but not read in submit as form_data -->
                                <td><input value=\"` + id + `\" type='number' name='ROId' class='form-control' disabled /></td>
                            </tr>
                    
                            <!-- unit name field -->
                            <tr>
                                <td>Unit</td>
                                <td><input value=\"` + unit + `\" type='text' name='unit' class='form-control' required /></td>
                            </tr>    
                            <tr>
                                <!-- hidden 'roUnit id' to identify which record to updated and to be read in form_data-->
                    <!-- don't remove this section-->
                                <td><input value=\"` + id + `\" name='ROId' type='hidden' /></td> 
                    
                                <!-- button to submit form -->
                                <td>
                                    <button type='submit' class='btn btn-info'>
                                        <span class='glyphicon glyphicon-edit'></span> Update Product
                                    </button>
                                </td>
                    
                            </tr>            
                        </table>
                    </form>`;


            // inject to 'page-content' of our app
            $("#page-content").html(update_roUnit_html);

            // chage page title
            changePageTitle("Update roUnit");



        });


    });
});

// 'update roUnit form' submit handle will be here

// will run if 'create roUnit' form was submitted
$(document).on('submit', '#update-roUnit-form', function () {

    // get form data will be here 
    // get form data
    var form_data = JSON.stringify($(this).serializeObject());

    // submit form data to api
    $.ajax({
        url: "http://localhost/masirah/site-app/api/roUnit/update.php",
        type: "POST",
        contentType: 'application/json',
        data: form_data,
        success: function (result) {
            // roUnit was created, go back to roUnits list
            showroUnits();
        },
        error: function (xhr, resp, text) {
            // show error to console
            console.log(xhr, resp, text);
        }
    });

    return false;
});