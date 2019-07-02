$(".loginForm form").submit(function(e) {
    e.preventDefault();
  });
  $(".createRole").click(function() {
    $(".loginBox").css({ display: "none" });
    $(".createBox").css({ display: "flex" });
  });