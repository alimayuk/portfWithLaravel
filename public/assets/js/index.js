const body = document.querySelector("body");
const navbar = document.querySelector(".navbar");
const menuBtn = document.querySelector(".menu-btn");
const cancelBtn = document.querySelector(".cancel-btn");
const dynamicText = document.querySelector("h1 .textt");
const words = ["SoftWare", "Blogger"];

menuBtn.onclick = () => {
    navbar.classList.add("show");
    menuBtn.classList.add("hide");
    body.classList.add("disabled");
};
cancelBtn.onclick = () => {
    body.classList.remove("disabled");
    navbar.classList.remove("show");
    menuBtn.classList.remove("hide");
};
window.onscroll = () => {
    this.scrollY > 20
        ? navbar.classList.add("sticky")
        : navbar.classList.remove("sticky");
};


let wordIndex = 0;
let charIndex = 0;
let isDeleting = false;
const typeEffect = () => {
    const currentWord = words[wordIndex];
    const currentChar = currentWord.substring(0, charIndex);
    dynamicText.textContent = currentChar;
    dynamicText.classList.add("stop-blinking");
    if (!isDeleting && charIndex < currentWord.length) {
        charIndex++;
        setTimeout(typeEffect, 200);
    } else if (isDeleting && charIndex > 0) {
        charIndex--;
        setTimeout(typeEffect, 100);
    } else {
        isDeleting = !isDeleting;
        dynamicText.classList.remove("stop-blinking");
        wordIndex = !isDeleting ? (wordIndex + 1) % words.length : wordIndex;
        setTimeout(typeEffect, 1200);
    }
}
typeEffect();



function observeElements(elements, showClass, animationClass) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add(showClass, animationClass);
        } else {
          entry.target.classList.remove(showClass, animationClass);
        }
      });
    });
  
    elements.forEach((el) => observer.observe(el));
  }
  const showClass = document.querySelectorAll("aosShow");
  const hiddenBottomElements = document.querySelectorAll(".aosHiddenBottom");
  const hiddenLeftElements = document.querySelectorAll(".aosHiddenLeft");
  const hiddenRightElements = document.querySelectorAll(".aosHiddenRight");
  
  observeElements(hiddenBottomElements, "aosShow", "bottomToUp");
  observeElements(hiddenLeftElements, "aosShow", "LeftToMid");
  observeElements(hiddenRightElements, "aosShow", "RightToMid");
  
 
  const parentDiv = document.querySelector('.hParent').parentNode;
  parentDiv.style.overflow = 'hidden';



  const cursor = document.querySelector(".customCursorDot");
  const cursorOutline = document.querySelector(".customCursorOurline");
  document.addEventListener("mousemove", function(e) {
    const pageX = e.clientX
    const pageY = e.clientY

    cursor.style.left = `${pageX}px`;
    cursor.style.top = `${pageY}px`;

    // cursorOutline.style.left = `${pageX}px`;
    // cursorOutline.style.top = `${pageY}px`;
    cursorOutline.animate({
      left:`${pageX}px`,
      top:`${pageY}px`,
    },{duration:500, fill:"forwards"})
  });


 