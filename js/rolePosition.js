const randPos = () => {
  const x = Math.random() * (innerWidth - 200);
  const y = 100 + Math.random() * (innerHeight - 300);
  return { x, y };
};

console.log(innerHeight);
console.log(randPos().x, randPos().y);

// function placeSquids() {
//   const otherSquids = document.querySelectorAll(".otherSquid");
//   console.log(otherSquids);
//   for (let i = 0; i < otherSquids.length; i++) {
//     otherSquids[i].style.position = "absolute";
//     otherSquids[i].style.top = `${randPos().y}px`;
//     otherSquids[i].style.left = `${randPos().x}px`;
//     // console.log(otherSquids[i]);
//   }
// }

// setTimeout(placeSquids, 10);
