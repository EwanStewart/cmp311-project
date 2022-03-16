"use strict";

$(document).ready(function () {
  var buttons = document.querySelectorAll('.mdc-button, .mdc-fab');

  for (var i = 0, button; button = buttons[i]; i++) {
    mdc.ripple.MDCRipple.attachTo(button);
  }
});
//# sourceMappingURL=app.js.map