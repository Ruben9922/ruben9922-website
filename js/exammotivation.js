$(document).ready(function() {
    var tips = [
        "You're probably doing better than you think!",
        "It'll be fine!",
        "You wouldn't be where you are now if you couldn't do it!"
    ];
    var usedIndices = [];
    var usedIndexCount = 0;
    var loadTip = function() {
        var index;
        var used;
        do {
            used = false;
            index = Math.floor(Math.random() * tips.length);
            for (i = 0; i < usedIndexCount; i++) {
                    console.log(used);
                if (index === usedIndices[i]) {
                    used = true;
                    break;
                }
            }
        } while (used);
        if (usedIndexCount >= tips.length - 1) {
            usedIndexCount = 0;
        }
        usedIndices[usedIndexCount] = index;
        usedIndexCount++;
        $("#tip").html(tips[index]);
        console.log(index);
        console.log(usedIndices);
        console.log(usedIndexCount);
    }
    loadTip();
    
    $("#nexttipbutton").click(function() {
        loadTip();
    });
});
