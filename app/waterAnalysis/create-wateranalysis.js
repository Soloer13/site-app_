$(document).ready(function () {

    console.log('got inside create-waterAnalysis');

    // show html form when 'create waterAnalysis' button was clicked
    $(document).on('click', '.create-waterAnalysis-button', function () {

        console.log('got inside create button');

        $.getJSON("http://localhost/masirah/site-app/api/roUnit/read.php", function (data) {
            // build categories option html
            // loop through returned list of data
            var roUnits_options_html = `<select class='custom-select custom-select-lg mb-3' name='unit' class='form-control'>`;
            $.each(data.records, function (key, val) {
                roUnits_options_html += `<option value='` + val.ROId + `'>` + val.unit + `</option>`;
            });
            roUnits_options_html += `</select>`;

            // we have our html form here where waterAnalysis information will be entered
            // we used the 'required' html5 property to prevent empty fields
            var create_waterAnalysis_html = `
                <div id='read-waterAnalysis' class='btn btn-primary pull-right m-b-15px read-waterAnalysis-button'>
                    <span class='glyphicon glyphicon-list'></span> Read waterAnalysis
                </div>
                
                <!-- build 'create waterAnalysis' html form -->
                <!-- we used the 'required' html5 property to prevent empty fields -->
                <form id='create-waterAnalysis-form' action='#' method='post' border='0'>
                    <table class='table table-hover table-responsive table-bordered'>
                

                        <!-- date field -->
                        <tr>
                            <td>Date</td> <!-- don't know why but not read in submit as form_data -->
                            <td><input type='date' name='date' class='form-control' id='date_id' required /></td>
                        </tr>

                        <tr>
                        <td id='shift_td'>shift</td>
                        <td>
                        <select class='custom-select custom-select-lg mb-3' name='shift' id='shift_id'>
                            <option value='0'>Morning Shift</option>
                            <option value='1'>Night Shift</option>
                            <option value='2'>Other</option>
                        </select>
                        </td>
                        </tr>

                        <!-- unit name field -->
                        <tr>
                            <td>Unit</td>
                            <td>`+ roUnits_options_html + `</td>
                        </tr>    
                        <tr>


                        <!-- Conductivity field -->
                        <tr>
                            <td>Conductivity</td>
                            <td><input type='text' name='cond' class='form-control' required /></td>
                        </tr>    
                        <tr>


                        <!-- Temperature field -->
                        <tr>
                            <td>Temperature</td>
                            <td><input type='text' name='temp' class='form-control' required /></td>
                        </tr>    
                        <tr>


                        <!-- Ph field -->
                        <tr>
                            <td>PH</td>
                            <td><input type='text' name='ph' class='form-control' required /></td>
                        </tr>    
                        <tr>


                        <!-- ORP field -->
                        <tr>
                            <td>ORP</td>
                            <td><input type='text' name='orp' class='form-control' required /></td>
                        </tr>    
                        <tr>


                        <!-- productFlow field -->
                        <tr>
                            <td>Product Flow</td>
                            <td><input type='text' name='productFlow' class='form-control' required /></td>
                        </tr>    
                        <tr>


                        <!-- RO inlet field -->
                        <tr>
                            <td>RO inlet</td>
                            <td><input type='text' name='roin' class='form-control' required /></td>
                        </tr>    
                        <tr>

                        <!-- RO outlet field -->
                        <tr>
                            <td>RO outlet</td>
                            <td><input type='text' name='roout' class='form-control' required /></td>
                        </tr>

                        <tr>
                            <!-- hidden 'waterAnalysis id' to identify which record to created and to be read in form_data-->
                            <!-- don't remove this section-->
                            <td><input name='ROId' type='hidden' /></td> 
                
                            <!-- button to submit form -->
                            <td>
                                <button type='submit' class='btn btn-info'>
                                    <span class='glyphicon glyphicon-edit'></span> create Product
                                </button>                                
                            </td>
                        </tr>            
                    </table>
                </form>`;



            // inject html to 'page-content' of our app
            $("#page-content").html(create_waterAnalysis_html);

            // chage page title
            changePageTitle("Create New RO Unit");


            // });


        });

        // 'create waterAnalysis form' handle will be here
        // will run if create waterAnalysis form was submitted
        $(document).on('submit', '#create-waterAnalysis-form', function () {
            // form data will be here
            // get form data
            var form_data = JSON.stringify($(this).serializeObject());
            console.log(form_data);

            // submit form data to api
            $.ajax({
                url: "http://localhost/masirah/site-app/api/waterAnalysis/create.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (result) {
                    // waterAnalysis was created, go back to waterAnalysis list
                    showwaterAnalysis();
                },
                error: function (xhr, resp, text) {
                    // show error to console
                    console.log(xhr, resp, text);
                }
            });

            return false;
        });

    });
});
