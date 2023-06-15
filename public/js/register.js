$(document).ready(function() {
    var select = $('#rol_user_id');
    var peopleFields = $('#people-fields');
    var companyFields = $('#company-fields');
    var registerButton = $('#register_button');
    //Hide register button
    registerButton.attr("disabled", true)
    // Hide additional fields
    peopleFields.hide();
    companyFields.hide();

    // show or hide additional fields and register button
    select.on('change', function() {
        var option = select.val();

        if (option === '2') {
            peopleFields.show();
            companyFields.hide();
            registerButton.attr("disabled", false);
        } else if (option === '3') {
            peopleFields.hide();
            companyFields.show();
            registerButton.attr("disabled", false);
        } else {
            peopleFields.hide();
            companyFields.hide();
            registerButton.attr("disabled", true)
        }
    });
});