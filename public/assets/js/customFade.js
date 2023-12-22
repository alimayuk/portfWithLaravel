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