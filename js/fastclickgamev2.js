$(document).ready(function() {
    var clickCount = 0;
    var timeLeft = 10;
    var timeStarted = 0;
    var finished = 0;
    var welcomeMessage;
    
    $("#clickbutton").click(function() {
        $("#clickerror").html("");
        //if (!Boolean(finished)) {
        clickCount++;
        $("#clicks").html(clickCount);
        if (!Boolean(timeStarted)) {
            welcomeMessage = $("#welcomemessage");
            welcomeMessage.remove();
            $("#timeleft").html(timeLeft - 1);
            var timerId = setInterval(function() {
                $("#timeleft").html(--timeLeft - 1);
                if (timeLeft <= 0) {
                    finished = 1;
                    $("#clickerror").html("");
                    timeLeft = 10;
                    $("#clickbutton").prop("disabled", true);
                    var container = $("#container");
                    var gameOverMessage = $("<div><h2>Game over!</h2><p>Number of clicks: <span class=\"bold\">" + clickCount + "</span></p></div>");
                    var playAgainButton = $("<button type=\"button\" class=\"btn btn-default\" id=\"playagainbutton\">Play again</button>");
                    playAgainButton.click(function() {
                        finished = 0;
                        clickCount = 0;
                        timeStarted = 0;
                        $("#clicks").html(clickCount);
                        $("#clickerror").html("");
                        $("#clickbutton").prop("disabled", false);
                        $(this).remove();
                        gameOverMessage.remove();
                        $("#addtoleaderboardcontainer").remove();
                        container.append(welcomeMessage);
                    });
                    var addToLeaderboardContainer = $("<div id=\"addtoleaderboardcontainer\"><h3>Submit Score to Leaderboard <small>(Optional)</small></h3><form class=\"form-inline\"><div class=\"form-group\"><input type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Name\" maxlength=\"30\"></div></form></div>");
                    var addToLeaderboardButton = $("<button type=\"button\" class=\"btn btn-default\" id=\"addtoleaderboard\">Submit</button>");
                    addToLeaderboardButton.click(function() {
                        var nameTextBox = $("#name");
                        var name = nameTextBox.val();
                        if (name.length === 0) {
                            return;
                        }
                        
                        var scoreListRef = new Firebase('https://rdougallfastclickgamev2.firebaseio.com/');
                        var scoreRef = scoreListRef.push({name: name, score: clickCount});
                        scoreRef.setPriority(clickCount);
                        addToLeaderboardContainer.fadeOut(300, function() {
                            addToLeaderboardContainer.empty();
                            var confirmMessage = $("<p class=\"green\">Added score to database</p>" + name);
                            addToLeaderboardContainer.append(confirmMessage);
                            addToLeaderboardContainer.fadeIn(300);
                        });
                    });
                    addToLeaderboardContainer.children("form").append(addToLeaderboardButton);
                    container.append(gameOverMessage);
                    container.append(addToLeaderboardContainer);
                    container.append(playAgainButton);
                    $("#timeleft").html(timeLeft);
                    clearInterval(timerId);
                }
            }, 1000);
        }
        //}
        timeStarted = 1;
    });
    
    $(window).keydown(function(event) {
        if(event.keyCode == 13 && !Boolean(finished)) {
            event.preventDefault();
            $("#clickerror").html("Pressing/holding the enter key is not allowed!");
            return false;
        }
    });
});
