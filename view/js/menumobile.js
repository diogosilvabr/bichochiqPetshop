const menuBtn = document.querySelector('.hamburger-menu');
const menuScreen = document.querySelector('.menu-screen');

const menu = document.querySelector('.menu');

// Adiciona o evento de click no botão
menuBtn.addEventListener('click', function() {
  menu.classList.add('active');
  menuScreen.classList.add('active-menu');
});

// Adiciona o evento de click no documento
menuScreen.addEventListener('click', function(event) {
  if (!menu.contains(event.target) && !menuBtn.contains(event.target)) {
    menu.classList.remove('active');
    menuScreen.classList.remove('active-menu');
  }
});

const menuLists = document.querySelectorAll('.menu-list');

menuLists.forEach(menuList => {
  const menuItem = menuList.querySelector('.menu-item');
  const submenu = menuList.querySelector('.submenu');

  //submenu.classList.remove('active');

  menuItem.addEventListener('click', () => {
    submenu.classList.toggle('active');
  });
});