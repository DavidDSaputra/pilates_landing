<script>
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');
    
    let sidebarOpen = true;

    // Profile Dropdown Toggle
    if (profileButton && profileDropdown) {
        profileButton.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    }

    // Sidebar functionality
    function handleSidebarToggle() {
        const isDesktop = window.innerWidth >= 1024;
        
        if (isDesktop) {
            // Desktop: Toggle sidebar slide in/out
            sidebarOpen = !sidebarOpen;
            if (sidebarOpen) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        } else {
            // Mobile: Show sidebar with overlay
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            sidebarOpen = true;
        }
    }

    function closeSidebarMobile() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        sidebarOpen = false;
    }

    // Event listeners
    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', handleSidebarToggle);
    }
    
    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeSidebarMobile);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeSidebarMobile);
    }

    // Initialize sidebar state based on screen size
    function initSidebar() {
        const isDesktop = window.innerWidth >= 1024;
        if (isDesktop) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
            sidebarOpen = true;
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            sidebarOpen = false;
        }
    }

    // Initialize on load
    initSidebar();

    // Reinitialize on window resize
    window.addEventListener('resize', () => {
        const isDesktop = window.innerWidth >= 1024;
        if (isDesktop) {
            overlay.classList.add('hidden');
            if (sidebarOpen) {
                sidebar.classList.remove('-translate-x-full');
            }
        } else {
            if (!overlay.classList.contains('hidden')) {
                // Keep overlay visible if sidebar is open on mobile
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
</script>