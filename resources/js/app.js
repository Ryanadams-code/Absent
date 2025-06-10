import './bootstrap';

// Initialize Material Design 3 UI components
document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeSidebarButton = document.getElementById('close-sidebar-button');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileOverlay = document.getElementById('mobile-overlay');
    
    if (mobileMenuButton && mobileSidebar && mobileOverlay) {
        mobileMenuButton.addEventListener('click', function() {
            mobileSidebar.classList.remove('transform', '-translate-x-full');
            mobileOverlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
        
        function closeMobileSidebar() {
            mobileSidebar.classList.add('transform', '-translate-x-full');
            mobileOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
        if (closeSidebarButton) {
            closeSidebarButton.addEventListener('click', closeMobileSidebar);
        }
        
        mobileOverlay.addEventListener('click', closeMobileSidebar);
    }
    
    // User menu toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');
    
    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', function() {
            userMenu.classList.toggle('hidden');
        });
        
        // Close user menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }
    
    // Mobile profile button (for small screens)
    const mobileProfileButton = document.getElementById('mobile-profile-button');
    
    if (mobileProfileButton && userMenu) {
        mobileProfileButton.addEventListener('click', function() {
            userMenu.classList.toggle('hidden');
        });
    }
    
    // Add ripple effect to buttons (Material Design 3 feature)
    const buttons = document.querySelectorAll('button, .btn, a.inline-flex');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple-effect');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            button.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});