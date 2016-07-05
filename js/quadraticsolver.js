$(document).ready(function() {
    function isAValid() {
        var a = $("#a").val();
        return isInteger(a) && a != 0;
    }

    function isBValid() {
        var b = $("#b").val();
        return b.length > 0 && isInteger(b);
    }

    function isCValid() {
        var c = $("#c").val();
        return c.length > 0 && isInteger(c);
    }

    $("#a").keyup(function() {
        updateValidationState($(this).parent(), isAValid);
    });

    $("#b").keyup(function() {
        updateValidationState($(this).parent(), isBValid);
    });

    $("#c").keyup(function() {
        updateValidationState($(this).parent(), isCValid);
    });

    $("#mainform").submit(function(event) {
        event.preventDefault();

        if (isAValid() && isBValid() && isCValid()) {
            // Calculate and display result
        }
    });
});
