const cursor = document.querySelector(".customCursorDot");
const cursorOutline = document.querySelector(".customCursorOurline");
document.addEventListener("mousemove", function(e) {
  const pageX = e.clientX
  const pageY = e.clientY

  cursor.style.left = `${pageX}px`;
  cursor.style.top = `${pageY}px`;
  cursorOutline.animate({
    left:`${pageX}px`,
    top:`${pageY}px`,
  },{duration:500, fill:"forwards"})
});