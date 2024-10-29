// menu.js
function toggleMenu() {
  const rightSection = document.getElementById('right-section');
  const hamburgerMenu = document.getElementById('hamburger-menu');
  
  rightSection.classList.toggle('show');

  // Toggle text between hamburger and cross
  if (rightSection.classList.contains('show')) {
    hamburgerMenu.innerHTML = '✖'; // Cross
  } else {
    hamburgerMenu.innerHTML = '☰'; // Hamburger
  }
}

document.getElementById('hamburger-menu').onclick = toggleMenu;
