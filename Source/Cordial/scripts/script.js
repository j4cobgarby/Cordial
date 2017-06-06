var position = 'up';

function scrollup() {
  position = 'up';
  var panel = document.getElementById("panel");
  panel.classList.remove("scrolldown");
  panel.classList.add("scrollup");
}

function scrolldown() {
  position = 'down';
  var panel = document.getElementById("panel");
  panel.classList.remove("scrollup");
  panel.classList.add("scrolldown");
}

function togglescroll() {
  if (position == 'up') {
    scrolldown();
  } else {
    scrollup();
  }
}
