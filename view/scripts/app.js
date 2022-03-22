//import * as mdc from "material-components-web"
$(document).ready(function () {
    var buttons = document.querySelectorAll('.mdc-button, .mdc-fab');
    for (var i = 0, button; button = buttons[i]; i++) {
        mdc.ripple.MDCRipple.attachTo(button);
    }
    const topAppBarElement = document.querySelector('.mdc-top-app-bar');
    const topAppBar = new mdc.topAppBar.MDCTopAppBar(topAppBarElement);
    var textFields = document.querySelectorAll('.mdc-text-field');
    for (var i = 0, textField; textField = textFields[i]; i++) {
        var _ = new mdc.textField.MDCTextField(textField);
    }
});

$(document).scroll(function () {
    document.getElementById("loginPopup").classList.remove("displayPopup");
    document.getElementById("accountPopup").classList.remove("displayPopup");
});


function showLoginBox(e) {
    document.getElementById("loginPopup").classList.toggle("displayPopup");
}

function showAccountBox(e) {
    document.getElementById("accountPopup").classList.toggle("displayPopup");
}