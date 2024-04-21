const nav = document.querySelector('header');

window.addEventListener('scroll', () => {
    const position = document.documentElement.scrollTop;
    if (position >= 100) {
        nav.classList.add('shrink');
        nav.classList.remove('grow');
    } else {
        nav.classList.remove('shrink');
        nav.classList.add('grow');
    }
});
