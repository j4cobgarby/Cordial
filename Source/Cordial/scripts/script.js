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

function flashId(id) {
  var el = document.getElementById('comment-'+id);
  el.classList.add("flash");
  window.setTimeout(() => el.classList.remove("flash"), 1000)
}
