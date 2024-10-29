// menu.js
function toggleMenu() {
  const rightSection = document.getElementById('right-section');
  rightSection.classList.toggle('show');
}

document.getElementById('hamburger-menu').onclick = toggleMenu;
