$(document).ready(function() {
    // Might change this function
    function calculateOctalDigit(firstPerm, secondPerm, thirdPerm) {
        var digit = 0;
        if (firstPerm) {
            digit += 4;
        }
        if (secondPerm) {
            digit += 2;
        }
        if (thirdPerm) {
            digit += 1;
        }
        return digit;
    }

    function generatePermissionTriad(permissionClass, specialAttribute, usingStickyMode) {
        return (permissionClass.read ? "r" : "-") +
                (permissionClass.write ? "w" : "-") +
                (permissionClass.execute ?
                    (specialAttribute ? (usingStickyMode ? "t" : "s") : "x") :
                    (specialAttribute ? (usingStickyMode ? "T" : "S") : "-"));
    }

    // Form submit event handler
    $("#convertfromsymbolicform").submit(function(event) {
        event.preventDefault();

        var requiredPermissions = {
            special: {
                setuid: $("#setuid").prop("checked"),
                setgid: $("#setgid").prop("checked"),
                stickyMode: $("#stickymode").prop("checked")
            },
            user: {
                read: $("#userread").prop("checked"),
                write: $("#userwrite").prop("checked"),
                execute: $("#userexecute").prop("checked")
            },
            group: {
                read: $("#groupread").prop("checked"),
                write: $("#groupwrite").prop("checked"),
                execute: $("#groupexecute").prop("checked")
            },
            other: {
                read: $("#otherread").prop("checked"),
                write: $("#otherwrite").prop("checked"),
                execute: $("#otherexecute").prop("checked")
            }
        };
        var octalNotation = "" +
            calculateOctalDigit(requiredPermissions.special.setuid, requiredPermissions.special.setgid, requiredPermissions.special.stickyMode) +
            calculateOctalDigit(requiredPermissions.user.read, requiredPermissions.user.write, requiredPermissions.user.execute) +
            calculateOctalDigit(requiredPermissions.group.read, requiredPermissions.group.write, requiredPermissions.group.execute) +
            calculateOctalDigit(requiredPermissions.other.read, requiredPermissions.other.write, requiredPermissions.other.execute);
        $("#octalnotation").html(octalNotation);
        $("#octalnotationexample").html(octalNotation);
        $("#symbolicnotation").html(
            generatePermissionTriad(requiredPermissions.user, requiredPermissions.special.setuid, false) +
            generatePermissionTriad(requiredPermissions.group, requiredPermissions.special.setgid, false) +
            generatePermissionTriad(requiredPermissions.other, requiredPermissions.special.stickyMode, true)
        );
    });

    // Clear button click event handler
    $("#convertfromsymbolicformclearbutton").click(function() {
        // Uncheck all checkboxes
        $("#setuid").prop("checked", false);
        $("#setgid").prop("checked", false);
        $("#stickymode").prop("checked", false);
        $("#userread").prop("checked", false);
        $("#userwrite").prop("checked", false);
        $("#userexecute").prop("checked", false);
        $("#groupread").prop("checked", false);
        $("#groupwrite").prop("checked", false);
        $("#groupexecute").prop("checked", false);
        $("#otherread").prop("checked", false);
        $("#otherwrite").prop("checked", false);
        $("#otherexecute").prop("checked", false);

        // Reset outputs to default values
        $("#octalnotation").html("0000");
        $("#octalnotationexample").html("0000");
        $("#symbolicnotation").html("---------");
    });
});
