$(document).ready(function () {
    $('#AdminForm').validate({ // initialize the plugin

        rules: {

            username: {
                required : true ,
                String   : true ,

            },
            email: {
                required : true ,
                email    : true
            },

            password: {
                required : true
            },


            role_id: {
                required : true ,
            },


           

        },


        errorElement: "span",
        errorLabelContainer: '.errorTxt',

        submitHandler: function(form) {
            form.submit();
        }
    });
});
