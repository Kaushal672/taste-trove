const nav = document.querySelector('header');
const stars = document.querySelectorAll('.form-rating .fa-star');
const ratingInput = document.querySelector('#rating');

// shrink the navbar height when scrolled
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

// smooth scroll for reiview
document
    .querySelector('.scroll-to__link')
    .addEventListener('click', function (e) {
        e.preventDefault();
        document
            .getElementById('reviews__section')
            .scrollIntoView({ behavior: 'smooth' });
    });

// fill review stars when clicked
document.querySelector('.form-rating').addEventListener('click', function (e) {
    e.preventDefault();

    if (e.target.classList.contains('fa-star')) {
        const rating = e.target.dataset.value;
        ratingInput.value = rating;

        for (let i = 0; i < stars.length; i++) {
            if (i < rating) {
                stars[i].classList.replace('fa-regular', 'fa-solid');
            } else {
                stars[i].classList.replace('fa-solid', 'fa-regular');
            }
        }
    }
});

// handle the click to event to open the popup options
document.querySelector('.comments').addEventListener('click', function (e) {
    e.preventDefault();

    if (e.target.classList.contains('ellipsis')) {
        let modal = e.target.nextElementSibling;
        modal.style.display = 'block';
        handleClickOutside(e.target, modal);
    }
});

// to check if user clicked outside the popup & close it
function handleClickOutside(elem, mdl) {
    const outSideClickListener = function (evt) {
        if (!mdl.contains(evt.target) && !elem.contains(evt.target)) {
            mdl.style.display = 'none';
            document.removeEventListener('click', outSideClickListener);
        }
    };

    document.addEventListener('click', outSideClickListener);
}
