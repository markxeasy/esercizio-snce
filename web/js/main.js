$( document ).ready(function() {
    $("#productTags").tagsInput({
        'minChars' : 0,
        'defaultText':'Tags..'
    });

    $("#submit-btn").click(function(e) {
        var errorCheck = false;
        if($("#productTags").val() === null || $("#productTags").val() === "") {
            $("#tag-error-msg").show();
            errorCheck = true;
        }
        if($("#productName").val() === null || $("#productName").val() === "") {
            $("#name-error-msg").show();
            errorCheck = true;
        }

        if(errorCheck) {
            e.preventDefault();
        }
    });
})
