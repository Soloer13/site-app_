$(document).ready(function () {

    // handle 'read one' button click
    $(document).on('click', '.read-one-roUnit-button', function () {
        // roUnit ID will be here

        // console.log('got inside readonce-rounits')
        // get roUnit id
        var id = $(this).attr('data-id');

        // console.log($(this).attr('data-ROId'));
        console.log('id ', id);

        // read roUnit record based on given ID
        $.getJSON("http://localhost/masirah/site-app/api/rounit/read_one.php?id=" + id, function (data) {
            // read roUnits button will be here

            console.log("got json ", data);

            // start html
            var read_one_roUnit_html = `
            <!-- when clicked, it will show the roUnit's list -->
            <div id='read-roUnits' class='btn btn-primary pull-right m-b-15px read-roUnits-button'>
                <span class='glyphicon glyphicon-list'></span> Read roUnits
            </div>

            <!-- roUnit data will be shown in this table -->
            <table class='table table-bordered table-hover'>

                <!-- roUnit id -->
                    <tr>
                        <td class='w-30-pct'>Id</td>
                        <td class='w-70-pct'>` + data.ROId + `</td>
                    </tr>

                    <!-- roUnit unit -->
                    <tr>
                        <td>unit</td>
                        <td>` + data.unit + `</td>
                    </tr>

                <!-- roUnit created_on -->
                    <tr>
                        <td>Created On</td>
                        <td>` + data.created_on + `</td>
                    </tr>

                <!-- roUnit Modified_on -->
                <tr>
                    <td>Modified on</td>
                    <td>` + data.modified_on + `</td>
                </tr>

            </table>`;

            // inject html to 'page-content' of our app
            $("#page-content").html(read_one_roUnit_html);

            // chage page title
            changePageTitle("Read one RO Unit");

        });


    });

});