import './styles/style.scss';

function scrollToSection(id) {
    let section = document.getElementById(id);
    section.scrollIntoView({behavior: "smooth"});
}

