"use strict";

//import * as mdc from "material-components-web"
$(document).ready(function () {
  var buttons = document.querySelectorAll('.mdc-button, .mdc-fab');

  for (var i = 0, button; button = buttons[i]; i++) {
    mdc.ripple.MDCRipple.attachTo(button);
  }

  var topAppBarElement = document.querySelector('.mdc-top-app-bar');
  var topAppBar = new mdc.topAppBar.MDCTopAppBar(topAppBarElement);
});
//# sourceMappingURL=app.js.map