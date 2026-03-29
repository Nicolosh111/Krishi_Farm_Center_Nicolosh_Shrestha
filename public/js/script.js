function toggleMenu(){
    const links = document.querySelector('.nav-links');
    const auth = document.querySelector('.nav-auth');
    const hamburgerIcon = document.querySelector('.hamburger i');

    // Toggle menu
    links.classList.toggle('nav-active');
    auth.classList.toggle('nav-active');

    // Toggle icon
    if(hamburgerIcon.classList.contains('fa-bars')){
        hamburgerIcon.classList.remove('fa-bars');
        hamburgerIcon.classList.add('fa-xmark'); // cross icon
    } else {
        hamburgerIcon.classList.remove('fa-xmark');
        hamburgerIcon.classList.add('fa-bars'); // hamburger icon
    }
}

// dropdown profile
function toggleProfileMenu(event) {
  event.stopPropagation(); // prevent immediate close when clicking icon
  document.querySelector('.dashboard').classList.toggle('active');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
  const profile = document.querySelector('.dashboard');
  if (profile.classList.contains('active') && !profile.contains(e.target)) {
    profile.classList.remove('active');
  }
});
