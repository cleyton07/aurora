// Menu fixo com scroll suave
const menuLinks = document.querySelectorAll('header nav ul li a');

menuLinks.forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(link.getAttribute('href'));
    if(target){
      window.scrollTo({
        top: target.offsetTop - 70,
        behavior: 'smooth'
      });
    }
  });
});

// Card hover efeito extra (opcional)
const cards = document.querySelectorAll('.card');
cards.forEach(card => {
  card.addEventListener('mouseenter', () => {
    card.style.zIndex = 10;
  });
  card.addEventListener('mouseleave', () => {
    card.style.zIndex = '';
  });
});
