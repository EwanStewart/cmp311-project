import * as mdc from './material-components-web';
$(document).ready(function (){
    attachRipple();
});

function attachRipple(){
    document.querySelectorAll('.mdc-button, .mdc-ripple-surface').forEach((elem) => {
        new mdc.ripple.MDCRipple(elem)
    });
}