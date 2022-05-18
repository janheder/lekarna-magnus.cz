document.getElementById('navToggle').addEventListener('click', function() {
    document.body.classList.toggle('--navActive');
});
document.getElementById('backdrop').addEventListener('click', function() {
  document.body.classList.toggle('--navActive');
});
document.getElementById('closeMenu').addEventListener('click', function() {
  document.body.classList.toggle('--navActive');
});
document.getElementById('openHours').addEventListener('click', function() {
  document.body.classList.remove('--navActive');
});
