$(".loginForm form").submit(function(e) {
    e.preventDefault();
  });
  $(".button-createRole").click(function() {
    $(".loginBox").css({ display: "none" });
    $(".newCharacter").css({ display: "flex" });
  });