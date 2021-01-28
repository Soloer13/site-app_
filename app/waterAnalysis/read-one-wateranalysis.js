$(document).ready(function () {

    // handle 'read one' button click
    $(document).on('click', '.read-one-waterAnalysis-button', function () {
        // waterAnalysis ID will be here

        console.log("read-one-waterAnalysis-button was clicked sir,");

        // get waterAnalysis id
        var id = $(this).attr('data-id');
        // read waterAnalysis record based on given ID
        $.getJSON("http://localhost/masirah/site-app/api/waterAnalysis/read_one.php?id=" + id, function (data) {
            // read waterAnalysis button will be here

            // start html
            var read_one_waterAnalysis_html = `
            <!-- when clicked, it will show the waterAnalysis's list -->
            <div id='read-waterAnalysis' class='btn btn-primary pull-right m-b-15px read-waterAnalysis-button'>
                <span class='glyphicon glyphicon-list'></span> Read waterAnalysis
            </div>

            <!-- waterAnalysis data will be shown in this table -->
            <table class='table table-bordered table-hover'>

                <!-- waterAnalysis id -->
                    <tr>
                        <td class='w-30-pct'>Id</td>
                        <td class='w-70-pct'>` + data.Id + `</td>
                    </tr>

                    <!-- waterAnalysis date -->
                    <tr>
                        <td>Date</td>
                        <td>` + data.date + `</td>
                    </tr>

                <!-- waterAnalysis Shift -->
                    <tr>
                        <td>Shift</td>
                        <td>` + data.shift + `</td>
                    </tr>

                <!-- waterAnalysis unit -->
                <tr>
                    <td>Unit</td>
                    <td>` + data.unit + `</td>
                </tr>

                <!-- waterAnalysis Conductivity -->
                    <tr>
                        <td>Cond</td>
                        <td>` + data.cond + `</td>
                    </tr>

                <!-- waterAnalysis temperature -->
                <tr>
                    <td>Temp</td>
                    <td>` + data.temp + `</td>
                </tr>

                <!-- waterAnalysis PH -->
                    <tr>
                        <td>PH</td>
                        <td>` + data.ph + `</td>
                    </tr>

                <!-- waterAnalysis ORP -->
                <tr>
                    <td>ORP</td>
                    <td>` + data.orp + `</td>
                </tr>

                <!-- waterAnalysis Product Flow -->
                <tr>
                    <td>Product Flow</td>
                    <td>` + data.productFlow + `</td>
                </tr>

                <!-- waterAnalysis RO inlet -->
                    <tr>
                        <td>RO Inlet</td>
                        <td>` + data.ROin + `</td>
                    </tr>

                <!-- waterAnalysis RO outlet -->
                <tr>
                    <td>RO Outlet</td>
                    <td>` + data.ROout + `</td>
                </tr>
            </table>`;

            // inject html to 'page-content' of our app
            $("#page-content").html(read_one_waterAnalysis_html);

            // chage page title
            changePageTitle("Read one waterAnalysis");

        });


    });

});