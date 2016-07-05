$(document).ready(function() {
    var haveLoggedIn = false;
    // Define functions
    function authDataCallback(authData) {
        if (authData) {
            //console.log("User " + authData.uid + " is logged in with " + authData.provider);
            // If user exists, overwrite current progress with their stored progress
            // Otherwise save current progress
            var userRef = ref.child('users/' + authData.uid);
            userRef.once("value", function(snapshot) {
                if (snapshot.exists()) {
                    loadData(authData.uid);
                } else {
                    saveData(authData.uid);
                }
            });
            displayMessage("<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span> <span class=\"bold\">Successfully logged in!</span>");
            $("#loginbutton").hide();
            $("#savebutton").show();
            $("#logoutbutton").show();
            $("#loginstatus").html("Logged in as <span class=\"bold\">" + authData.facebook.displayName + "</span>");
            $(window).on("beforeunload", saveData);
            haveLoggedIn = true;
        } else {
            //console.log("User is logged out");
            resetData();
            if (haveLoggedIn) {
                displayMessage("<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span> <span class=\"bold\">Successfully logged out!</span>");
            }
            $("#savebutton").hide();
            $("#logoutbutton").hide();
            $("#loginbutton").show();
            $("#loginstatus").html("Currently not logged in. Log in to save your progress!");
            // Following doesn't seem to work
            $(window).on("beforeunload", function() {
                if (clickCount === 0 || totalClicksPerSec === 0) {
                    alert("Leaving the page without logging in will result in your progress being lost.");
                }
            });
        }
    }

    function saveData(uid) {
        var userRef = ref.child('users/' + uid);
        userRef.set({clickCount: clickCount, totalClickCount: totalClickCount});
        var userItemsRef = userRef.child('items');
        for (i = 0; i < items.length; i++) {
            var userItemRef = userItemsRef.child(items[i].id);
            userItemRef.set({qtyPurchased: items[i].qtyPurchased, qtyUpgraded: items[i].qtyUpgraded});
        }
        var userUpgradesRef = userRef.child('upgrades');
        for (i = 0; i < upgrades.length; i++) {
            var userUpgradeRef = userUpgradesRef.child(upgrades[i].id);
            userUpgradeRef.set({qtyPurchased: upgrades[i].qtyPurchased});
        }
        displayMessage("<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span> <span class=\"bold\">Saved!</span>"); // need to change this
    }

    function loadData(uid) {
        var userRef = ref.child('users/' + uid);
        userRef.once("value", function(snapshot) {
            var snapshotVal = snapshot.val();
            if (snapshotVal) {
                clickCount = snapshotVal.clickCount;
                totalClickCount = snapshotVal.clickCount;
                if (snapshotVal.items) {
                    console.log(snapshotVal.items);
                    for (var id in snapshotVal.items) { // Change this so for every item in array
                        var result = items.filter(function(item) { return item.id === id; });
                        var item = result? result[0] : null;
                        if (item) {
                            item.qtyPurchased = snapshotVal.items[id].qtyPurchased;
                            item.qtyUpgraded = snapshotVal.items[id].qtyUpgraded;
                        }
                    }
                }
                if (snapshotVal.upgrades) {
                    for (var id in snapshotVal.upgrades) {
                        var result = items.filter(function(upgrade) { return upgrade.id == id; });
                        var upgrade = result? result[0] : null;
                        if (upgrade) {
                            upgrade.qtyPurchased = snapshotVal.upgrades[id].qtyPurchased;
                        }
                    }
                }
                var savedTotalClicksPerSec = 0;
                for (i = 0; i < items.length; i++) {
                    savedTotalClicksPerSec += items[i].initialClicksPerSec;
                }
                for (i = 0; i < upgrades.length; i++) {
                    savedTotalClicksPerSec += upgrades[i].newClicksPerSec - upgrades[i].item.initialClicksPerSec;
                }
                if (totalClicksPerSec === 0 && savedTotalClicksPerSec >= 0) {
                    setUpdateScoreTimer();
                    totalClicksPerSec = savedTotalClicksPerSec;
                }
            }
            console.log("my object: %o", snapshotVal);
            updateAllData();
        });
    }

    function resetData() {
        clickCount = 0;
        totalClickCount = 0;
        totalClicksPerSec = 0;
        for (i = 0; i < items.length; i++) {
            items[i].qtyPurchased = 0;
            items[i].qtyUpgraded = 0;
        }
        for (i = 0; i < upgrades.length; i++) {
            upgrades[i].qtyPurchased = 0;
        }
        clearInterval(updateScoreTimerId); // Stop score updating every second as totalClicksPerSec has been reset to 0
        updateAllData();
    }

    function updateAllData() {
        //console.log("2");
        $("#clicks").html(clickCount);
        $("#clickspersec").html(totalClicksPerSec);
        for (i = 0; i < items.length; i++) {
            $("#item" + i).find(".qtypurchased").html(items[i].qtyPurchased);
        }
        for (i = 0; i < upgrades.length; i++) {
            $("#upgrade" + i).children(".qtypurchased").html(upgrades[i].qtyPurchased);
        }
    }

    function displayMessage(messageString) {
        var message = $("#message");
        message.html(messageString);
        message.stop().fadeIn(250);
        message.delay(750);
        message.fadeOut(250);
    }

    function setUpdateScoreTimer() {
        //purchased = 1;
        updateScoreTimerId = setInterval(function() {
            // Update score
            clickCount += totalClicksPerSec;
            $("#clicks").html(clickCount);
        }, 1000);
    }

    // Declare and initialise variables
    var INFLATION_MULTIPLIER = 0.23;
    var clickCount = 0;
    var totalClickCount = 0;
    var totalClicksPerSec = 0;
    var updateScoreTimerId;

    var Item = function(id, name, cost, initialClicksPerSec) {
        this.id = id;
        this.name = name;
        this.cost = cost;
        this.initialCost = this.cost;
        this.initialClicksPerSec = initialClicksPerSec;
        this.qtyPurchased = 0;
        this.qtyUpgraded = 0;
    }

    var Upgrade = function(id, name, cost, item, newClicksPerSec) {
        this.id = id;
        this.name = name;
        this.cost = cost;
        this.initialCost = this.cost;
        this.item = item;
        this.newClicksPerSec = newClicksPerSec;
        this.qtyPurchased = 0;
    }
    // Might eventually change this so this data is stored in a separate file
    var items = [
        new Item("it1", "testitem1", 6, 10),
        new Item("it2", "testitem2", 4, 1),
        new Item("i1", "Ball mouse", 50, 1),
        new Item("i2", "Optical mouse", 100, 2)
    ];
    var upgrades = [
        new Upgrade("ut1", "testupgrade1", 200, items[0], 20),
        new Upgrade("u1", "Upgrade a ball mouse to 1000 DPI", 200, items[2], 10)
    ];

    // Authentication, login and logout & saving and loading code
    var ref = new Firebase('https://ruben986clickcollectorgame.firebaseio.com/');
    ref.onAuth(authDataCallback);
    $("#loginbutton").click(function() {
        ref.authWithOAuthPopup("facebook", function(error, authData) {
            if (error) {
                if (error.code === "TRANSPORT_UNAVAILABLE") {
                    ref.authWithOAuthRedirect("facebook", function(error) {
                        if (error) {
                            //console.log("Login Failed!", error);
                        }
                    });
                } else {
                    //console.log("Login Failed!", error);
                }
            } else {
                //console.log("Authenticated successfully with payload:", authData);
            }
        },
        {
            remember: "default"
        });
    });
    $("#logoutbutton").click(function() {
        // Save data then perform logout
        var authData = ref.getAuth();
        if (authData) {
            saveData(authData.uid);
        }
        ref.unauth();
    });

    $("#savebutton").click(function() {
        var authData = ref.getAuth();
        if (authData) {
            saveData(authData.uid);
        }
    });

    // Code for filling shop with items and upgrades & providing main functionality
    for (i = 0; i < items.length; i++) {
        var thumbnailDiv = $("<div class=\"col-sm-4 col-md-3\"></div>");
        var itemDiv = $("<div class=\"thumbnail\" id=\"item" + i + "\"><h4>" + items[i].name + "</h4><p>Costs <span class=\"bold\"><span class=\"cost\">" + items[i].cost + "</span> clicks</span> per item</p><p>Additional <span class=\"bold\">" + items[i].initialClicksPerSec + " clicks/sec</span> per item</p><p><span class=\"bold\"><span class=\"qtypurchased\">" + items[i].qtyPurchased + "</span> purchased</span></p></div>");
        var itemButton = $("<button type=\"button\" class=\"btn btn-default btn-lg\"><span class=\"glyphicon glyphicon-usd\"></span> Purchase</button>");
        itemButton.on("click", {id: i}, function(e) {
            var item = items[e.data.id];
            //console.log(clickCount);
            //console.log(item.cost);
            //console.log(e.data.id);
            if (clickCount >= item.cost) {
                totalClickCount = clickCount;
                clickCount -= item.cost;
                item.cost += Math.round(item.initialCost * INFLATION_MULTIPLIER);
                item.qtyPurchased++;
                $("#clicks").html(clickCount);
                $("#item" + e.data.id).find(".qtypurchased").html(item.qtyPurchased);
                $("#item" + e.data.id).find(".cost").html(item.cost);
                if (totalClicksPerSec === 0) {
                    setUpdateScoreTimer();
                }
                totalClicksPerSec += item.initialClicksPerSec;
                $("#clickspersec").html(totalClicksPerSec);
            }
        });
        itemDiv.append(itemButton);
        thumbnailDiv.append(itemDiv);
        $("#items").append(thumbnailDiv);
    }
    for (i = 0; i < upgrades.length; i++) {
        var upgradeDiv = $("<div id=\"upgrade" + i + "\">&nbsp;<span class=\"bold\">" + upgrades[i].name + "</span> (costs <span class=\"cost\">" + upgrades[i].cost + "</span> clicks; upgrades " + upgrades[i].item.name + " to " + upgrades[i].newClicksPerSec + " clicks/sec; <span class=\"qtypurchased\">" + upgrades[i].qtyPurchased + "</span> purchased)" + "</div>");
        var upgradeButton = $("<input type=\"button\" value=\"Purchase\">");
        upgradeButton.on("click", {id: i}, function(e) {
            var upgrade = upgrades[e.data.id];
            if (clickCount >= upgrade.cost && upgrade.item.qtyUpgraded < upgrade.item.qtyPurchased) {
                totalClickCount = clickCount;
                clickCount -= upgrade.cost;
                upgrade.cost += Math.round(upgrade.initialCost * INFLATION_MULTIPLIER);
                upgrade.qtyPurchased++;
                upgrade.item.qtyUpgraded++;
                $("#clicks").html(clickCount);
                $("#upgrade" + e.data.id).children(".qtypurchased").html(upgrade.qtyPurchased);
                $("#upgrade" + e.data.id).children(".cost").html(upgrade.cost);
                totalClicksPerSec += upgrade.newClicksPerSec - upgrade.item.initialClicksPerSec;
                $("#clickspersec").html(totalClicksPerSec);
            }
        });
        upgradeDiv.prepend(upgradeButton);
        $("#upgrades").append(upgradeDiv);
    }

    $("#clickbutton").click(function() {
        clickCount++;
        $("#clicks").html(clickCount);
        $("#clickerror").html("");
    });

    $(window).keydown(function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            $("#clickerror").html("Pressing/holding the enter key is not allowed!");
            return false;
        }
    });
});
