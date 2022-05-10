var topAppBarElement;
var topAppBar;
var drawer;

$(document).ready(function () {
    var buttons = document.querySelectorAll('.mdc-button, .mdc-fab');
    for (var i = 0, button; button = buttons[i]; i++) {
        mdc.ripple.MDCRipple.attachTo(button);
    }
    topAppBarElement = document.querySelector('.mdc-top-app-bar');
    topAppBar = new mdc.topAppBar.MDCTopAppBar(topAppBarElement);
    drawer = new mdc.drawer.MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));

    var textFields = document.querySelectorAll('.mdc-text-field');
    for (var i = 0, textField; textField = textFields[i]; i++) {
        var _ = new mdc.textField.MDCTextField(textField);
    }

    let carousel = new bootstrap.Carousel(document.querySelector("#topGamesCarousel"), {
        interval: 8000,
        wrap: true
    });

    $("[data-shopbutton]").click(function() {
        $.ajax({
            type: "POST",
            url: "https://mayar.abertay.ac.uk/~cmp311g21c02/cmp311/controller/addToBasket.php",
            data: {
                gameID: $(this).attr("data-gameID")
            },
            success: function(text) {
                alert(text); // Function DOES reach here
            }
        });
    });


    const query = window.location.search;
    const params = new URLSearchParams(query);
    const pop = params.get('pop');
    console.log(pop);

    if (pop == 1) {
        document.getElementById("reg").click();
    } else if (pop == 2) {
        document.getElementById("log").click();
    } else if (pop == 3) {
        alert("Please log in to contribute");
    } else if (pop == 4) {
        alert("Please subscribe to access this feature");
    }


});

$(document).scroll(function () {
    try{
        document.getElementById("accountPopup").classList.remove("displayPopup");
    }
    catch (e){

    }

    try{
        document.getElementById("loginPopup").classList.remove("displayPopup");
    }
    catch (e){

    }
});


function showLoginBox(e) {
    document.getElementById("loginPopup").classList.toggle("displayPopup");
}

function showAccountBox(e) {
    document.getElementById("accountPopup").classList.toggle("displayPopup");
}

function navDrawerActivate(){
    topAppBar.open = !topAppBar.open;
    drawer.open = !drawer.open;
    console.log("Nav bar open: " + topAppBar.open);
    console.log("Drawer open: " + drawer.open);
}

//move all index code to here
$(document).ready(function(){

});