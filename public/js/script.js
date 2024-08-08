// Function to activate a menu item
function activateMenuItem(item) {
    const li = item.parentElement;
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

    allSideMenu.forEach(i => {
        i.parentElement.classList.remove('active');
    });
    li.classList.add('active');

    // Save the active state to local storage
    localStorage.setItem('activeMenuItem', item.getAttribute('href'));
}

// Initialize sidebar state from local storage
function initializeSidebar() {
    const activeMenuItem = localStorage.getItem('activeMenuItem');
    if (activeMenuItem) {
        const item = document.querySelector(`#sidebar .side-menu.top li a[href="${activeMenuItem}"]`);
        if (item) {
            activateMenuItem(item);
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    initializeSidebar();

    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
    allSideMenu.forEach(item => {
        item.addEventListener('click', function () {
            activateMenuItem(item);
        });
    });

    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');

    menuBar.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
    });

    const searchButton = document.querySelector('#content nav form .form-input button');
    const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
    const searchForm = document.querySelector('#content nav form');

    searchButton.addEventListener('click', function (e) {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    if (window.innerWidth < 768) {
        sidebar.classList.add('hide');
    } else if (window.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }

    window.addEventListener('resize', function () {
        if (this.innerWidth > 576) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });

    const switchMode = document.getElementById('switch-mode');

    switchMode.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    });
});
