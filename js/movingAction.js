$(window).on("keydown", moveSquid);

let map = $(".gameWorld_bgImage");
let mpo = map.position();
let r0 = {
  x: 0,
  y: 0,
  w: map.width(),
  h: map.height()
};

if (innerWidth > 768) {
  r0.h += 80;
}

console.log(r0.w, r0.h);

let i = 0;
function moveSquid(e) {
  //   e.preventDefault();
  i++;
  //   console.log(i);
  //   const myImgMoving =
  let myImg = document.querySelector("#myRole").src;
  if (myImg.indexOf("myRole") != -1) {
    if (i % 5 == 0 && i % 10 != 0) {
      myImg = myImg.replace("myRole", "myRole_moving");
      $("#myRole").attr("src", myImg);
    } else if (i % 10 == 0) {
      myImg = myImg.replace("myRole_moving", "myRole");
      $("#myRole").attr("src", myImg);
    }
  } else {
    if (i % 5 == 0 && i % 10 != 0) {
      myImg = myImg.replace("Squid", "SquidMoving");
      $("#myRole").attr("src", myImg);
    } else if (i % 10 == 0) {
      myImg = myImg.replace("SquidMoving", "Squid");
      $("#myRole").attr("src", myImg);
    }
  }

  const house = $(".gameWorld_house");
  let hpo = house.position();
  let r3 = {
    x: hpo.left,
    y: hpo.top,
    w: house.width(),
    h: house.height()
  };

  const fountain = $(".gameWorld_fountain");
  let fpo = fountain.position();
  let r2 = {
    x: fpo.left,
    y: fpo.top,
    w: fountain.width(),
    h: fountain.height()
  };

  const bus = $(".gameWorld_bus");
  let bpo = bus.position();
  let r4 = {
    x: bpo.left,
    y: bpo.top,
    w: bus.width(),
    h: bus.height()
  };

  const cup = $(".gameWorld_cup");
  let cpo = cup.position();
  let r5 = {
    x: cpo.left,
    y: cpo.top,
    w: cup.width(),
    h: cup.height()
  };

  let squid = $(".loginSquid");
  //   console.log(squid);
  let spo = squid.position();
  let r1 = {
    x: spo.left,
    y: spo.top,
    w: squid.width(),
    h: squid.height()
  };

  //   console.log(r1);
  //   console.log(r2);

  let moveSpeed = 10;
  let backSpeed = 30;
  if (window.innerWidth <= 767) {
    moveSpeed = 5;
    backSpeed = 10;
  }

  if (e.keyCode == 37) {
    // console.log("Left Arrow");
    if (
      (r1.y > r0.y - r1.h &&
        r1.y < r0.y + r0.h &&
        r0.x - r1.x < r1.w &&
        r0.x - r1.x > 0) ||
      (r2.y > r1.y - r2.h &&
        r2.y < r1.y + r1.h &&
        r1.x - r2.x < r2.w &&
        r1.x - r2.x > 0) ||
      (r3.y > r1.y - r3.h &&
        r3.y < r1.y + r1.h &&
        r1.x - r3.x < r3.w &&
        r1.x - r3.x > 0) ||
      (r4.y > r1.y - r4.h &&
        r4.y < r1.y + r1.h &&
        r1.x - r4.x < r4.w &&
        r1.x - r4.x > 0) ||
      (r5.y > r1.y - r5.h &&
        r5.y < r1.y + r1.h &&
        r1.x - r5.x < r5.w &&
        r1.x - r5.x > 0)
    ) {
      //   console.log("edge_left");
      squid.css({ left: `+=${backSpeed}` });
    } else {
      squid.css({ left: `-=${moveSpeed}` });
    }
  } else if (e.keyCode == 38) {
    // console.log("Up Arrow");
    if (
      (r1.x > r0.x - r1.w &&
        r1.x < r0.x + r0.w &&
        r0.y - r1.y < r1.h &&
        r0.y - r1.y > 0) ||
      (r2.x > r1.x - r2.w &&
        r2.x < r1.x + r1.w &&
        r1.y - r2.y < r2.h &&
        r1.y - r2.y > 0) ||
      (r3.x > r1.x - r3.w &&
        r3.x < r1.x + r1.w &&
        r1.y - r3.y < r3.h &&
        r1.y - r3.y > 0) ||
      (r4.y > r1.y - r4.h &&
        r4.y < r1.y + r1.h &&
        r1.x - r4.x < r4.w &&
        r1.x - r4.x > 0) ||
      (r5.y > r1.y - r5.h &&
        r5.y < r1.y + r1.h &&
        r1.x - r5.x < r5.w &&
        r1.x - r5.x > 0)
    ) {
      squid.css({ top: "+=30px" });
      //   console.log(`ed${backSpeed}`p");
    } else {
      squid.css({ top: `-=${moveSpeed}` });
    }
  } else if (e.keyCode == 39) {
    // console.log("Right Arrow");
    if (
      (r1.y > r0.y - r1.h &&
        r1.y < r0.y + r0.h &&
        r1.x > r0.x + r0.w - r1.w &&
        r1.x < r0.x + r0.w) ||
      (r2.y > r1.y - r2.h &&
        r2.y < r1.y + r1.h &&
        r2.x > r1.x + r1.w - r2.w &&
        r2.x < r1.x + r1.w) ||
      (r3.y > r1.y - r3.h &&
        r3.y < r1.y + r1.h &&
        r3.x > r1.x + r1.w - r3.w &&
        r3.x < r1.x + r1.w) ||
      (r4.y > r1.y - r4.h &&
        r4.y < r1.y + r1.h &&
        r1.x - r4.x < r4.w &&
        r1.x - r4.x > 0) ||
      (r5.y > r1.y - r5.h &&
        r5.y < r1.y + r1.h &&
        r1.x - r5.x < r5.w &&
        r1.x - r5.x > 0)
    ) {
      //   console.log("edge_right");
      squid.css({ left: `-=${backSpeed}` });
    } else {
      squid.css({ left: `+=${moveSpeed}` });
    }
  } else if (e.keyCode == 40) {
    // console.log("Down Arrow");
    if (
      (r1.x > r0.x - r1.w &&
        r1.x < r0.x + r0.w &&
        r1.y + 0 > r0.y + r0.h - r1.h &&
        r1.y < r0.y + r0.h) ||
      (r2.x > r1.x - r2.w &&
        r2.x < r1.x + r1.w &&
        r2.y + 0 > r1.y + r1.h - r2.h &&
        r2.y < r1.y + r1.h) ||
      (r3.x > r1.x - r3.w &&
        r3.x < r1.x + r1.w &&
        r3.y + 0 > r1.y + r1.h - r3.h &&
        r3.y < r1.y + r1.h) ||
      (r4.y > r1.y - r4.h &&
        r4.y < r1.y + r1.h &&
        r1.x - r4.x < r4.w &&
        r1.x - r4.x > 0) ||
      (r5.y > r1.y - r5.h &&
        r5.y < r1.y + r1.h &&
        r1.x - r5.x < r5.w &&
        r1.x - r5.x > 0)
    ) {
      //   console.log("edge_bottom");
      squid.css({ top: `-=${backSpeed}` });
    } else {
      squid.css({ top: `+=${moveSpeed}` });
    }
  }
}
