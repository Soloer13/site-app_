$(document).ready(function () {

    console.log("read roUnit document.ready");
    // show list of roUnit on first load
    showroUnits();

    // when a 'read roUnits' button was clicked
    $(document).on('click', '.read-roUnits-button', function () {
        showroUnits();
    });
});

// function to show list of roUnits
function showroUnits() {
    // get list of roUnits from the API
    $.getJSON("http://localhost/masirah/site-app/api/roUnit/read.php", function (data) {
        // console.log($data);
        // html for listing roUnits
        var read_roUnits_html = `
        <!-- when clicked, it will load the create roUnit form -->
        <div id='create-roUnit' class='btn btn-primary pull-right m-b-5px create-roUnit-button'>
            <span class='glyphicon glyphicon-plus'></span> Create roUnit
        </div> 


        <!-- start table -->
        <table class='table table-bordered table-hover'>
        
            <!-- creating our table heading -->
            <tr>
                <th class='w-10-pct text-align-center'>Id</th>
                <th class='w-15-pct text-align-center'>Unit Name</th>
                <th class='w-25-pct text-align-center'>Created On</th>
                <th class='w-25-pct text-align-center'>Modified on</th>
            </tr>`;

        // loop through returned list of data
        $.each(data.records, function (key, val) {

            // creating new table row per record
            read_roUnits_html += `
                <tr>

            <td class='text-align-center'>` + val.ROId + `</td>
            <td class='text-align-center'>` + val.unit + `</td>
            <td class='text-align-center'>` + val.created_on + `</td>
            <td class='text-align-center'>` + val.modified_on + `</td>

            <!-- 'action' buttons -->
            <td>
                <!-- read roUnit button -->
                <button class='btn btn-primary m-r-3px m-l-3px read-one-roUnit-button' data-id='` + val.ROId + `'>
                    <span class='glyphicon glyphicon-eye-open'></span> Read
                </button>

                <!-- edit button -->
                <button class='btn btn-info m-r-3px update-roUnit-button' data-id='` + val.ROId + `'>
                    <span class='glyphicon glyphicon-edit'></span> Edit
                </button>

                <!-- delete button -->
                <button class='btn btn-danger delete-roUnit-button' data-id='` + val.ROId + `'>
                    <span class='glyphicon glyphicon-remove'></span> Delete
                </button>
            </td>

            </tr>`;
        });

        // end table
        read_roUnits_html += `</table>`;

        // inject to 'page-content' of our app
        $("#page-content").html(read_roUnits_html);

        // chage page title
        changePageTitle("Read the existing RO-Units");
    });


}