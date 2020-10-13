let navbar = (function () {

  const mainNavBar = document.getElementById("navbar");
  const navBarToggle = document.getElementsByClassName('navbar-icon')[0];
  const breakpoint = 800;
  navBarToggle.addEventListener('click', toggleNavMenu);

  document.querySelector('#navbar ul').addEventListener('click', function (e) {
      if (e.target.tagName.toLowerCase() === 'li') {
          toggleNavMenu();
      }
  });

  document.addEventListener('keyup', escapeKeyPressed)

  function toggleNavMenu(e) {

      if (!telaMenor) return;

      if (mainNavBar.classList.contains('nav-menu-abre') === false) {
          mainNavBar.className += " nav-menu-abre";
      } else {
          mainNavBar.className = "main-nav";
          navBarToggle.className = 'navbar-icon';
      }

      atualiza();
  }

  function escapeKeyPressed(e, x) {

      if (!telaMenor) return;

      if (e.key === 'Escape') {

          let isMenuOpen = mainNavBar.classList.contains('nav-menu-abre');

          if (isMenuOpen) {
              mainNavBar.classList.toggle('nav-menu-abre', false);
              atualiza();
          }
      }
  }

  function atualiza() {

      if (!telaMenor) return;
      let symbol = (mainNavBar.classList.contains('nav-menu-abre')) ? 'x' : '&equiv;';
      navBarToggle.className += ' fechar';
      document.querySelector('.navbar-icon').innerHTML = symbol;
  }


  function telaMenor() {
      return document.documentElement.clientWidth < breakpoint;
  }


  $('.nav-link li').click(function(e) {
      $('.nav-link li').removeClass('ativo');
      $(this).addClass('ativo').siblings('li').removeClass('ativo');

      $('section#'+$(this).data('rel')+'').stop().fadeIn(400, 'linear').siblings('section').stop().fadeOut(400, 'linear'); 
  });

})();