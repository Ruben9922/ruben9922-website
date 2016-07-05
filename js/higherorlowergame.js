$(document).ready(function() {
    function generateNumber(max) {
        return Math.ceil(Math.random() * max);
    }

    function update(guess) {
        var nextNumber = generateNumber(max);
        var actualResult = nextNumber < currentNumber ? gameResults.LOWER :
                (nextNumber > currentNumber ? gameResults.HIGHER : gameResults.SAME);
        var resultMessageElement = $("#resultmessage");
        if (round === 1) {
            resultMessageElement.fadeIn(300);
        }
        if (guess === actualResult) {
            var scoreIncrease;
            if (actualResult === gameResults.SAME) {
                scoreIncrease = 20;
            } else {
                scoreIncrease = 1;
            }
            resultMessageElement.clearQueue().removeClass("alert-danger").addClass("alert-success").html("<span class=\"glyphicon glyphicon-ok-circle\" aria-hidden=\"true\"></span> <b>Correct!</b> +" + scoreIncrease).fadeIn(300).delay(1000).fadeOut(300);
            score += scoreIncrease;
            $("#score").html(score);
        } else {
            resultMessageElement.clearQueue().removeClass("alert-success").addClass("alert-danger").html("<span class=\"glyphicon glyphicon-remove-circle\" aria-hidden=\"true\"></span> <b>Incorrect!</b>")
            .fadeIn(300).delay(1000).fadeOut(300);
        }
        currentNumber = nextNumber;
        $("#number").stop().fadeOut(300, function() { $(this).html(currentNumber); }).fadeIn(300);
        round++;
        $("#round").html(round);
    }

    var gameResults = Object.freeze({
        LOWER: 0,
        SAME: 1,
        HIGHER: 2
    });
    var introContainerChildren = $("#introcontainer").children();
    var gameContainerChildren = $("#gamecontainer").children();
    var currentNumber;
    var max = 100;
    var score = 0;
    var round = 1;
    $("#startbutton").click(function() {
        animateOneByOne($(introContainerChildren.get().reverse()), 200, 0, function(element) { element.fadeOut(200); });
        animateOneByOne(gameContainerChildren, 400, 1000, function(element) { element.fadeIn(300); });
        $("#roundcontainer").delay(2200).fadeIn(300);
        $("#scorecontainer").delay(2200).fadeIn(300);
        currentNumber = generateNumber(max);
        $("#number").html(currentNumber);
    });
    $("#lowerbutton").click(function() {
        update(gameResults.LOWER);
    });
    $("#samebutton").click(function() {
        update(gameResults.SAME);
    });
    $("#higherbutton").click(function() {
        update(gameResults.HIGHER);
    });

    animateOneByOne(introContainerChildren, 400, 200, function(element) { element.fadeIn(300); });
});
