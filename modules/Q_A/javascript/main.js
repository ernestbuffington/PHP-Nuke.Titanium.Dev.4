BASE_URL = '...';

$(document).ready(function() {
  initMessageClosers();
});

function initMessageClosers() {
  $('.close').click(function() {
    $(this).parent().fadeOut();
  });
}

