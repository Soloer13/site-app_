$(document).ready(function () {

    console.log("read waterAnalysis document.ready");
    // show list of waterAnalysis on first load
    showwaterAnalysis();

    // when a 'read waterAnalysiss' button was clicked
    $(document).on('click', '.read-waterAnalysis-button', function () {
        showwaterAnalysis();
    });
});

// function to show list of waterAnalysiss
function showwaterAnalysis() {
    // get list of waterAnalysiss from the API
    $.getJSON("http://localhost/masirah/site-app/api/waterAnalysis/read.php", function (data) {
        // console.log($data);
        // html for listing waterAnalysiss
        var read_waterAnalysiss_html = `
        <!-- when clicked, it will load the create waterAnalysis form -->
        <div id='create-waterAnalysis' class='btn btn-primary pull-right m-b-5px create-waterAnalysis-button'>
            <span class='glyphicon glyphicon-plus'></span> Create waterAnalysis
        </div> 


        <!-- start table -->
        <table class='table table-bordered table-hover'>
        
            <!-- creating our table heading -->
            <tr>
                <!-- <th class='w-5-pct text-align-center'>Id</th> -->
                <th class='w-0-pct text-align-center'>Date</th>
                <th class='w-0-pct text-align-center'>Shift</th>
                <th class='w-0-pct text-align-center'>Unit Name</th>
                <th class='w-0-pct text-align-center'>Cond</th>
                <th class='w-0-pct text-align-center'>Temp</th>
                <th class='w-0-pct text-align-center'>Ph</th>
                <th class='w-0-pct text-align-center'>ORP</th>
                <th class='w-0-pct text-align-center'>Product</th>
                <th class='w-0-pct text-align-center'>RO inlet</th>
                <th class='w-0-pct text-align-center'>RO outlet</th>
                <th class='w-0-pct text-align-center'>Created On</th> 
                <th class='w-0-pct text-align-center'>Modified on</th>  
            </tr>`;

        // loop through returned list of data
        $.each(data.records, function (key, val) {

            // creating new table row per record
            read_waterAnalysiss_html += `
            <tr>

                <!-- <td class='text-align-center'>` + val.Id + `</td> --> 
                <td class='text-align-center'>` + val.date + `</td>
                <td class='text-align-center'>` + val.shift + `</td>
                <td class='text-align-center'>` + val.unit + `</td>
                <td class='text-align-center'>` + val.cond + `</td>
                <td class='text-align-center'>` + val.temp + `</td>
                <td class='text-align-center'>` + val.ph + `</td>
                <td class='text-align-center'>` + val.orp + `</td>
                <td class='text-align-center'>` + val.productFlow + `</td>
                <td class='text-align-center'>` + val.ROin + `</td>
                <td class='text-align-center'>` + val.ROout + `</td>
                <td class='text-align-center'>` + val.created_on + `</td>
                <td class='text-align-center'>` + val.modified_on + `</td>

                <!-- 'action' buttons -->
                <td>
                    <!-- read waterAnalysis button -->
                    <button class='btn btn-primary m-r-3px m-l-3px read-one-waterAnalysis-button' data-id='` + val.Id + `'>
                        <span class='glyphicon glyphicon-eye-open'></span> Read
                    </button>

                    <!-- edit button -->
                    <button class='btn btn-info m-r-3px update-waterAnalysis-button' data-id='` + val.Id + `'>
                        <span class='glyphicon glyphicon-edit'></span> Edit
                    </button>

                    <!-- delete button -->
                    <button class='btn btn-danger delete-waterAnalysis-button' data-id='` + val.Id + `'>
                        <span class='glyphicon glyphicon-remove'></span> Delete
                    </button>
                </td>

            </tr>`;
        });

        // end table
        read_waterAnalysiss_html += `</table>`;

        // inject to 'page-content' of our app
        $("#page-content").html(read_waterAnalysiss_html);

        console.log("injection is done");
        // chage page title
        changePageTitle("Read the existing Water-Analysis");
    });


}