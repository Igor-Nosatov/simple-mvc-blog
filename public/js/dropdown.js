if (window.screen.width <= 768)
{
    let menuHeading = document.querySelector('.side-menu__heading');
    let menuContent = document.querySelector('.side-menu__content');
    let caret = document.querySelector('.caret');

    menuHeading.addEventListener('click', () => {
        caret.classList.contains('fa-caret-down') ?
        caret.classList.replace('fa-caret-down', 'fa-caret-up') :
        caret.classList.replace('fa-caret-up', 'fa-caret-down');
        
        menuContent.classList.contains('dropDown') ? 
        menuContent.classList.toggle('dropDownClose') :
        menuContent.classList.toggle('dropDown');
    });
}
