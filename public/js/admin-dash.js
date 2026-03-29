/* ---------------- PROFILE DROPDOWN ---------------- */
const profileBtn = document.getElementById('profileBtn');
const profileMenu = document.getElementById('profileMenu');
const menuBtn = document.getElementById('menuBtn');
const sidebar = document.querySelector('aside');

profileBtn?.addEventListener('click', () => {
    profileMenu.classList.toggle('hidden');
});

document.addEventListener('click', (e) => {
    if (!profileBtn.contains(e.target)) profileMenu.classList.add('hidden');
});

/* ---------------- SIDEBAR TOGGLE (mobile) ---------------- */
menuBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
});

/* ---------------- SECTION NAVIGATION ---------------- */
const links = document.querySelectorAll('.nav-link');
const sections = document.querySelectorAll('main section');

function showSection(section) {
    sections.forEach(sec => sec.classList.add('hidden'));
    document.getElementById(section)?.classList.remove('hidden');

    links.forEach(l => l.classList.remove('bg-yellow-500', 'text-white'));
    document.querySelector(`[data-section="${section}"]`)?.classList.add('bg-yellow-500', 'text-white');
}

document.addEventListener("DOMContentLoaded", () => {
    const hash = window.location.hash.replace('#', '');
    const urlParams = new URLSearchParams(window.location.search);
    const section = hash || urlParams.get('section') || 'dashboard';

    showSection(section);
});

/* Handle clicking nav links */
links.forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();
        const target = link.getAttribute('data-section');
        showSection(target);
        history.replaceState(null, "", `#${target}`); // updates URL without reload
    });
});

/* Handle Profile button inside dropdown */
const profileLink = document.getElementById('profileLink');

profileLink?.addEventListener('click', e => {
    e.preventDefault();
    showSection('profile');
    profileMenu.classList.add('hidden');
    history.replaceState(null, "", '#profile');
});

/* ---------------- FLASH MESSAGES AUTO HIDE ---------------- */
document.addEventListener("DOMContentLoaded", () => {
    const success = document.getElementById('flash-success');
    const error = document.getElementById('flash-error');
    const inputs = document.querySelectorAll('form input');

    function fadeOut(el) {
        if (!el) return;
        el.style.transition = "opacity .5s ease";
        el.style.opacity = "0";
        setTimeout(() => el.remove(), 500);
    }

    if (success) setTimeout(() => fadeOut(success), 3000);
    if (error) setTimeout(() => fadeOut(error), 5000);

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            const inlineErr = input.parentNode.querySelector('.error-msg');
            if (inlineErr) fadeOut(inlineErr);
        });
    });
});


document.addEventListener('click', function (e) {

    // OPEN MODAL
    if (e.target.classList.contains('view-profile-btn')) {
        const expertId = e.target.getAttribute('data-expert');

        fetch(`/experts/${expertId}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('expertModalContent').innerHTML = html;
                document.getElementById('expertModal').classList.remove('hidden');
            });
    }

    // CLOSE MODAL (inside button)
    if (e.target.id === 'closeModalInside') {
        document.getElementById('expertModal').classList.add('hidden');
    }

    // CLOSE MODAL (X button)
    if (e.target.id === 'closeModal') {
        document.getElementById('expertModal').classList.add('hidden');
    }
});

