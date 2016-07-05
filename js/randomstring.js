$(document).ready(function() {
    function generateRandomString(length, chars, charCase) {
        var string = "";
        if (charCase === charCases.UPPER) {
            chars = chars.toUpperCase();
        } else {
            chars = chars.toLowerCase();
        }
        if (charCase === charCases.RANDOM) {
            for (i = 0; i < length; i++) {
                var char = chars[Math.floor(Math.random() * chars.length)];
                if (Math.random() < 0.5) {
                    char = char.toUpperCase();
                }
                string += char;
            }
        } else {
            for (i = 0; i < length; i++) {
                string += chars[Math.floor(Math.random() * chars.length)];
            }
        }
        return string;
    }

    function isLengthValid() {
        var length = $("#length").val();
        return length.length > 0 && length.length <= 4 && isInteger(length) && length > 0;
    }

    var charCases = Object.freeze({
        LOWER: 0,
        UPPER: 1,
        RANDOM: 2
    });
    $("#length").on("input", function() {
        updateValidationState($(this).parent(), isLengthValid);
    });

    $("#mainform").submit(function(event) {
        event.preventDefault();

        var stringElement = $("#string");
        if (isLengthValid()) {
            var length = $("#length").val();
            var chars;
            if ($("#chars0-9").prop("checked")) {
                chars = "0123456789";
            } else if ($("#charsa-z").prop("checked")) {
                chars = "abcdefghijklmnopqrstuvwxyz";
            } else {
                chars = "0123456789abcdefghijklmnopqrstuvwxyz";
            }
            var charCase;
            if ($("#caselower").prop("checked")) {
                charCase = charCases.LOWER;
            } else if ($("#caseupper").prop("checked")) {
                charCase = charCases.UPPER;
            } else {
                charCase = charCases.RANDOM;
            }
            stringElement.html(generateRandomString(length, chars, charCase));
        } else {
            stringElement.html("");
        }
    });
});
