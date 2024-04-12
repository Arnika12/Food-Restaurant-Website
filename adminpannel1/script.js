document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('.toggle-btn');
    const userBtn = document.querySelector('#user-btn');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                sidebar.classList.toggle('active');
            }
        });
    } else {
        console.log('Toggle button element not found');
    }

    if (userBtn) {
        userBtn.addEventListener('click', function() {
            const userBox = document.querySelector('.profile-detail');
            if (userBox) {
                userBox.classList.toggle('active');
            }
        });
    } else {
        console.log('User button element not found');
    }
});