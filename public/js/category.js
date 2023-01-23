$(document).ready(function () {
    $('#CategoryForm').validate({ // initialize the plugin

        rules: {

            name: {
                required : true ,
                String   : true ,

            },
            options: {
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
