document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const hamburgerBtns = document.querySelectorAll('[data-hamburger-toggle]');

    function toggleSidebar() {
        const isOpen = !sidebar.classList.contains('-translate-x-full');

        if (isOpen) {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
            hamburgerBtns.forEach(btn => {
                const icon = btn.querySelector('.material-symbols-outlined');
                if (icon) icon.textContent = 'menu';
            });
        } else {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            hamburgerBtns.forEach(btn => {
                const icon = btn.querySelector('.material-symbols-outlined');
                if (icon) icon.textContent = 'close';
            });
        }
    }

    hamburgerBtns.forEach(btn => {
        btn.addEventListener('click', toggleSidebar);
    });

    overlay?.addEventListener('click', toggleSidebar);

    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                toggleSidebar();
            }
        });
    });
});
