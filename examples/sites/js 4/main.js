/* 
 * StAuth10065: I Jobanpreet Singh Aulakh, 000381413 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.
 */
$(document).ready(function ()
{
    $("#InsertDefault").click(function ()
    {
        // make an AJAX call to retreive data from DefaultData array in backend.php and put that in form feilds.
        $.ajax({
            url: 'backend.php?act=default',
            dataType: 'json',
            success: function (result) {
                for (var data in result) {
                    var ID = "#" + data;
                    $(ID).val(result[data]);
                }
            }
        });
        // prevents link click default behaviour
        return false;
    });
    $("#PersonForm").submit(function ()
    {
        // Clear any success or error messages
        $("#success").html("");
        $("#errors").empty();
        
        // make an AJAX call here, and set error or success accordingly
        $.post('backend.php', {act: 'validate', name: $('#name').val(), postal: $('#postal').val(), phone: $('#phone').val(), address: $('#address').val()},
                function (result) {
                    var ErrorHeads = {name: "Name", postal: "Postal Code", phone: "Phone", address: "Address"};
                    var errors = [];
                    for (var data in result) {
                        if (result[data] === 0) {
                            errors[data] = ErrorHeads[data] + " is invalid!";
                        }
                    }
                    if (Object.keys(errors).length !== 0) {
                        for (var error in errors) {
                            $("#errors").append("<li>" + errors[error] + "</li>");
                        }
                    } else {
                        $("#success").text("Success!");
                    }
                }, 'json');
        // prevents submit button default behaviour
        return false;
    });
});
