var btn = document.querySelector('input');
var txt = document.querySelector('p');

btn.addEventListener('click', updateBtn);

function updateBtn() {
  if (btn.value === 'Je participe') {
    btn.value = 'Je ne participe plus';
    txt.textContent = 'Vous participez.';
  } else {
    btn.value = 'Je participe';
    txt.textContent = 'Vous ne participez pas.';
  }
}