$(document).ready(function () {

    // show html form when 'update waterAnalysis' button was clicked
    $(document).on('click', '.update-waterAnalysis-button', function () {
        // waterAnalysis ID will be here

        // get waterAnalysis id
        var id = $(this).attr('data-id');


        // read one record based on given waterAnalysis id
        $.getJSON("http://localhost/masirah/site-app/api/waterAnalysis/read_one.php?id=" + id, function (data) {

            // values will be used to fill out our form
            let id = data.Id;
            let unit = data.unit;
            let date = data.date;
            let Shift = data.shift;
            let cond = data.cond;
            let temp = data.temp;
            let ph = data.ph;
            let orp = data.orp;
            let productFlow = data.productFlow;
            let roin = data.ROin;
            let roout = data.ROout;
            let createdOn = data.created_on;
            let modifiedOn = data.modified_on;


            // update waterAnalysis html will be here

            // store 'update waterAnalysis' html to this variable
            var update_waterAnalysis_html = `
                    <div id='read-waterAnalysis' class='btn btn-primary pull-right m-b-15px read-waterAnalysis-button'>
                        <span class='glyphicon glyphicon-list'></span> Read waterAnalysis
                    </div>
                    
                    <!-- build 'update waterAnalysis' html form -->
                    <!-- we used the 'required' html5 property to prevent empty fields -->
                    <form id='update-waterAnalysis-form' action='#' method='post' border='0'>
                        <table class='table table-hover table-responsive table-bordered'>
                    
                            <!-- Id field -->
                            <tr>
                                <td>Id</td> <!-- don't know why but not read in submit as form_data -->
                                <td><input value=\"` + id + `\" type='number' name='ROId' class='form-control' disabled /></td>
                            </tr>
                    
                            <!-- date field -->
                            <tr>
                                <td>Date</td> <!-- don't know why but not read in submit as form_data -->
                                <td><input value=\"` + date + `\" type='date' name='date' class='form-control' id='date_id' required /></td>
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
                                <td><input value=\"` + unit + `\" type='text' name='unit' class='form-control' required /></td>
                            </tr>    
                            <tr>


                            <!-- Conductivity field -->
                            <tr>
                                <td>Conductivity</td>
                                <td><input value=\"` + cond + `\" type='text' name='cond' class='form-control' required /></td>
                            </tr>    
                            <tr>


                            <!-- Temperature field -->
                            <tr>
                                <td>Temperature</td>
                                <td><input value=\"` + temp + `\" type='text' name='temp' class='form-control' required /></td>
                            </tr>    
                            <tr>


                            <!-- Ph field -->
                            <tr>
                                <td>PH</td>
                                <td><input value=\"` + ph + `\" type='text' name='ph' class='form-control' required /></td>
                            </tr>    
                            <tr>


                            <!-- ORP field -->
                            <tr>
                                <td>ORP</td>
                                <td><input value=\"` + orp + `\" type='text' name='orp' class='form-control' required /></td>
                            </tr>    
                            <tr>


                            <!-- productFlow field -->
                            <tr>
                                <td>Product Flow</td>
                                <td><input value=\"` + productFlow + `\" type='text' name='productFlow' class='form-control' required /></td>
                            </tr>    
                            <tr>


                            <!-- RO inlet field -->
                            <tr>
                                <td>RO inlet</td>
                                <td><input value=\"` + roin + `\" type='text' name='roin' class='form-control' required /></td>
                            </tr>    
                            <tr>

                            <!-- RO outlet field -->
                            <tr>
                                <td>RO outlet</td>
                                <td><input value=\"` + roout + `\" type='text' name='roout' class='form-control' required /></td>
                            </tr>

                            <tr>
                                <!-- hidden 'waterAnalysis id' to identify which record to updated and to be read in form_data-->
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
            $("#page-content").html(update_waterAnalysis_html);

            //this section for changes after injecting the html!


            // set the value of shift select menu according to it's value from JSON
            if(data.shift == 0){
                $('#shift_id').val('0');
                console.log(data.shift);
            }else if(data.shift == 1){
                $('#shift_id').val('1');
                console.log(data.shift);
            }else if(data.shift == 2){
                $('#shift_id').val('2');
                console.log(data.shift);
            }

            if($('#shift select').val('2')){
                $("#shift_id").css("background-color","yellow");
                $("#date_id").css("background-color", "yellow");
                alert("selected ");
            }
            // $('#shift_id').val('val2');

            // chage page title
            changePageTitle("Update waterAnalysis");



        });


    });
});

// 'update waterAnalysis form' submit handle will be here

// will run if 'create waterAnalysis' form was submitted
$(document).on('submit', '#update-waterAnalysis-form', function () {

    // get form data will be here 
    // get form data
    var form_data = JSON.stringify($(this).serializeObject());
    console.log(form_data);

    // submit form data to api
    $.ajax({
        url: "http://localhost/masirah/site-app/api/waterAnalysis/update.php",
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

    // console.log(form_data);

    return false;
});