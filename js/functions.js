function isInteger(n) {
    return n == +n && n == (n|0);
}

function updateValidationState(formGroup, validate) {
    if (validate()) {
        formGroup.removeClass("has-error");
        formGroup.addClass("has-success");
    } else {
        formGroup.removeClass("has-success");
        formGroup.addClass("has-error");
    }
}

function animateOneByOne(elements, delay, predelay, animation) {
    elements.each(function(index) {
        // Based on http://stackoverflow.com/a/4661858/3806231
        $(this).delay((delay * index) + predelay);
        animation($(this));
    });
}
