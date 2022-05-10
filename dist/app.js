"use strict";

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

  var carousel = new bootstrap.Carousel(document.querySelector("#topGamesCarousel"), {
    interval: 8000,
    wrap: true
  });
  topAppBar.setScrollTarget(document.getElementById('main-content'));
  topAppBar.listen('MDCTopAppBar:nav', function () {
    topAppBar.open = !topAppBar.open;
  });
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

function navDrawerActivate() {
  topAppBar.open = !topAppBar.open;
  drawer.open = !drawer.open;
  console.log("Nav bar open: " + topAppBar.open);
  console.log("Drawer open: " + drawer.open);
}
//# sourceMappingURL=app.js.map