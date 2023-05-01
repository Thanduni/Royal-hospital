alert("Hai");
$(document).ready(function() {
    $('#department').change(function() {
        let depName = $(this).val();
        if (depName !== '') {
            $.ajax({
                url: '../Patient/getDoctorName.php',
                type: 'POST',
                data: {depName: depName},
                dataType: 'json',
                success: function(response) {
// update the department select element with the departments returned by the PHP file
                    $('#doctor').html('<option value="">Select a doctor</option>');
                    $.each(response, function(key, value) {
                        $('#doctor').append('<option value="' + value.doctorID + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + xhr.responseText);
                }
            });
        } else {
            // reset the department select element if no doctor is selected
            $('#department').html('<option value="">Select a department</option>');
        }
    });
});

$(document).ready(function() {
    $('#doctor').change(function() {
        let doctorID = $(this).val();
        let date = $('#date').val();
        if (doctorID !== '') {
            $.ajax({
                url: '../Patient/getSchedule.php',
                type: 'POST',
                data: {doctorID: doctorID,
                       date: date},
                dataType: 'json',
                success: function(response) {
// update the department select element with the departments returned by the PHP file
                    if(Object.keys(response).length > 0)
                        $('#time').html('<option value="">Please select a time slot</option>');
                    else
                        $('#time').html('<option value="">There are no free slots available.Try another date.</option>');
                    $.each(response, function(data) {
                        $('#time').append('<option value="' + response[data] + '">' + response[data] + '</option>');
                        // console.log(response[data])
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + xhr.responseText);
                }
            });
        } else {
            // reset the department select element if no doctor is selected
            $('#time').html('<option value="">Select a time slot</option>');
        }
    });
});