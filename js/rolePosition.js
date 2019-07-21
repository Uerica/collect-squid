const randPos = () => {
  const x = Math.random() * (innerWidth - 200);
  const y = 100 + Math.random() * (innerHeight - 300);
  return { x, y };
};

console.log(innerHeight);

console.log(randPos().x, randPos().y);

// $(".otherSquid").css({
//   top: randPos().y,
//   left: randPos().x
// });
