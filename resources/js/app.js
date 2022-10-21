import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const closeSidebarButtons = document.querySelectorAll('button.close-sidebar');
    closeSidebarButtons.forEach(button => button.addEventListener('click', (e) => closeSidebar(e)));

    const openSidebarButtons = document.querySelectorAll('button.open-sidebar');
    openSidebarButtons.forEach(button => button.addEventListener('click', (e) => openSidebar(e)));
});

function closeSidebar(e) {
    const mobileSidebar = document.querySelector('#mobile-sidebar');
    mobileSidebar.classList.remove('flex')
    mobileSidebar.classList.add('hidden');
}

function openSidebar(e) {
    const mobileSidebar = document.querySelector('#mobile-sidebar');
    mobileSidebar.classList.add('flex')
    mobileSidebar.classList.remove('hidden');
}
