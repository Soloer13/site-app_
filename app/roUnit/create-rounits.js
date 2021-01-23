$(document).ready(function () {

    console.log('got inside create-rounits');

    // show html form when 'create roUnit' button was clicked
    $(document).on('click', '.create-roUnit-button', function () {

        console.log('got inside create button');

        // we have our html form here where roUnit information will be entered
        // we used the 'required' html5 property to prevent empty fields
        var create_roUnit_html = `

        <!-- 'read roUnits' button to show list of roUnits -->
        <div id='read-roUnits' class='btn btn-primary pull-right m-b-15px read-roUnits-button'>
            <span class='glyphicon glyphicon-list'></span> Read RO Units
        </div>

        <!-- 'create roUnit' html form -->
        <form id='create-roUnit-form' action='#' method='post' border='0'>
            <table class='table table-hover table-responsive table-bordered'>
        
                <!-- name field -->
                <tr>
                    <td>Unit Name</td>
                    <td><input type='text' name='name' class='form-control' required /></td>
                </tr>
    
                <!-- button to submit form -->
                <tr>
                    <td></td>
                    <td>
                        <button type='submit' class='btn btn-primary'>
                            <span class='glyphicon glyphicon-plus'></span> Create New Unit
                        </button>
                    </td>
                </tr>
        
            </table>
        </form>`;

        // inject html to 'page-content' of our app
        $("#page-content").html(create_roUnit_html);

        // chage page title
        changePageTitle("Create New RO Unit");


    // });


});

// 'create roUnit form' handle will be here
// will run if create roUnit form was submitted
$(document).on('submit', '#create-roUnit-form', function () {
    // form data will be here
    // get form data
    var form_data = JSON.stringify($(this).serializeObject());

    // submit form data to api
    $.ajax({
        url: "http://localhost/masirah/site-app/api/roUnit/create.php",
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



});