//import * as mdc from "material-components-web"
$(document).ready(function (){
    var buttons = document.querySelectorAll('.mdc-button, .mdc-fab');
    for (var i = 0, button; button = buttons[i]; i++) {
        mdc.ripple.MDCRipple.attachTo(button);
    }
    const topAppBarElement = document.querySelector('.mdc-top-app-bar');
    const topAppBar = new mdc.topAppBar.MDCTopAppBar(topAppBarElement);
});