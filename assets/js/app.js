document.addEventListener('DOMContentLoaded', function () {
  let navbarBurger = document.getElementById('toggle-sidebar');
  navbarBurger.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('shrinked');
    document.getElementById('toggle-sidebar').classList.toggle('shrinked');
    document.getElementById('navbar').classList.toggle('shrinked');
    this.children[0].classList.toggle('icon-circle-right');
    this.children[0].classList.toggle('icon-circle-left');
  });
  let userDropDown = document.getElementById('user-dropdown');
  userDropDown.addEventListener('click', function () {
    userDropDown.classList.toggle('open');
  });
  window.addEventListener("keydown",function (e) {
    if (e.keyCode === 114 || (e.ctrlKey && e.keyCode === 75)) {
        e.preventDefault();
        document.getElementById('search').focus();
    }
  });
});
