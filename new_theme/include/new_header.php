<?php
session_start();  
include "conn.php";

if(empty($_SESSION['um_fullname'])) {
    header('Location:index.php');   
    exit;
} else { 
    $user_role = $_SESSION['user_role']; 
    $um_id = $_SESSION['um_id'];     
    $um_fullname = $_SESSION['um_fullname'];             
    $isstatus = $_SESSION['isstatus'];                 
    $um_image = $_SESSION['um_image'] ?? 'default-avatar.png';
    $email_id = $_SESSION['emailid'] ?? '';                 
    $um_mobileno = $_SESSION['um_mobileno'] ?? '';                 
    $address = $_SESSION['address'] ?? '';
    $createddate = $_SESSION['createddate'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $company_name." - ".$_SESSION['fy_name'] ?? 'NABL Lab'; ?></title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --sidebar-width: 0; /* We'll use macOS-style dock instead */
            --header-height: 70px;
            --dock-height: 80px;
            --transition-speed: 0.3s;
            --mac-dock-bg: rgba(40, 40, 40, 0.8);
            --mac-dock-border: rgba(255, 255, 255, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        
        body {
            background-color: #f3f4f6;
            overflow-x: hidden;
        }
        
        /* Header Style */
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 1000;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .search-bar {
            position: relative;
            width: 350px;
        }
        
        .search-bar input {
            width: 100%;
            padding: 10px 15px 10px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            font-size: 14px;
            background-color: #f5f5f5;
            transition: all 0.3s;
        }
        
        .search-bar input:focus {
            outline: none;
            border-color: #4a90e2;
            background-color: #fff;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #757575;
            font-size: 16px;
        }
        
        .header-right {
            display: flex;
            align-items: center;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 15px 5px 5px;
            border-radius: 30px;
            background: #f5f5f5;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .user-profile:hover {
            background: #e8e8e8;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
            margin-right: 5px;
        }
        
        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            line-height: 1.2;
        }
        
        .user-role {
            font-size: 12px;
            color: #757575;
            margin-top: 2px;
        }
        
        .dropdown-icon {
            color: #757575;
            font-size: 12px;
            transition: transform 0.3s;
        }
        
        .user-profile:hover .dropdown-icon {
            transform: translateY(1px);
        }
        
        /* macOS Style Dock */
        .mac-dock {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            height: var(--dock-height);
            background: var(--mac-dock-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 18px;
            padding: 0 12px;
            display: flex;
            align-items: flex-end;
            z-index: 1000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--mac-dock-border);
        }
        
        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-logo {
            max-width: 80%;
            max-height: 40px;
            transition: all var(--transition-speed);
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
        }
        
        .menu-item:hover, .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .menu-item i {
            font-size: 1.25rem;
            width: 24px;
            margin-right: 1rem;
            text-align: center;
        }
        
        .menu-text {
            white-space: nowrap;
            transition: opacity var(--transition-speed);
        }
        
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height var(--transition-speed);
            padding-left: 2.5rem;
            background: rgba(0, 0, 0, 0.1);
        }
        
        .submenu.show {
            max-height: 1000px;
        }
        
        .submenu .menu-item {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .menu-item.has-submenu::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1.5rem;
            transition: transform var(--transition-speed);
        }
        
        .menu-item.has-submenu.open::after {
            transform: rotate(180deg);
        }
        
        /* Main Content */
        .main-content {
            margin: 0;
            padding: calc(var(--header-height) + 20px) 20px calc(var(--dock-height) + 40px) 20px;
            min-height: 100vh;
            transition: all var(--transition-speed);
        }
        
        /* Collapsed State */
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar.collapsed .sidebar-logo {
            width: 40px;
            opacity: 0;
            position: absolute;
        }
        
        .sidebar.collapsed .menu-text,
        .sidebar.collapsed .menu-item::after {
            opacity: 0;
            width: 0;
            display: none;
        }
        
        .sidebar.collapsed .menu-item {
            justify-content: center;
            padding: 0.75rem 0;
        }
        
        .sidebar.collapsed .menu-item i {
            margin-right: 0;
            font-size: 1.5rem;
        }
        
        .sidebar.collapsed .submenu {
            position: absolute;
            left: 100%;
            top: 0;
            width: 220px;
            background: #1e40af;
            border-radius: 0 4px 4px 0;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            display: none;
            padding-left: 0;
        }
        
        .sidebar.collapsed .menu-item:hover .submenu {
            display: block;
        }
        
        .sidebar.collapsed ~ .app-header {
            left: var(--sidebar-collapsed-width);
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Toggle Button */
        .sidebar-toggle {
            background: none;
            border: none;
            color: #4b5563;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
        }
        
        .sidebar-toggle:hover {
            background: #f3f4f6;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .app-header {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-toggle {
                display: block !important;
                margin-right: 1rem;
            }
        }
        
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #4b5563;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- macOS Style Dock -->
    <div class="mac-dock" id="dock">
        <div class="dock-container">
            <a href="#" class="dock-item" title="Dashboard">
                <img src="images/nav_icon/dashboard.svg" alt="Dashboard" class="dock-icon">
                <span class="dock-label">Dashboard</span>
            </a>
            
            <div class="dock-divider"></div>
            
            <a href="#" class="dock-item" title="Master Setup">
                <img src="images/nav_icon/master_setup.svg" alt="Master Setup" class="dock-icon">
                <span class="dock-label">Master Setup</span>
            </a>
            
            <a href="#" class="dock-item" title="HR">
                <img src="images/nav_icon/hr.svg" alt="HR" class="dock-icon">
                <span class="dock-label">HR</span>
            </a>
            
            <a href="#" class="dock-item" title="Purchase">
                <img src="images/nav_icon/purchase.svg" alt="Purchase" class="dock-icon">
                <span class="dock-label">Purchase</span>
            </a>
            
            <a href="#" class="dock-item" title="Audit & MRM">
                <img src="images/nav_icon/audit.svg" alt="Audit" class="dock-icon">
                <span class="dock-label">Audit</span>
            </a>
            
            <a href="#" class="dock-item" title="Reports">
                <img src="images/nav_icon/reports.svg" alt="Reports" class="dock-icon">
                <span class="dock-label">Reports</span>
            </a>
            
            <div class="dock-divider"></div>
            
            <a href="#" class="dock-item" title="Settings">
                <img src="images/nav_icon/settings.svg" alt="Settings" class="dock-icon">
                <span class="dock-label">Settings</span>
            </a>
        </div>
    </div>

    <!-- Header -->
    <header class="app-header">
        <div class="header-left">
            <div class="search-bar">
                <i class="fas fa-search search-icon"></i>
                <input type="text" placeholder="Search for anything...">
            </div>
        </div>
        
        <div class="header-right">
            <div class="user-profile">
                <img src="uploads/<?php echo htmlspecialchars($um_image); ?>" alt="<?php echo htmlspecialchars($um_fullname); ?>" class="user-avatar" onerror="this.src='images/default-avatar.png'">
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($um_fullname); ?></div>
                    <div class="user-role"><?php echo htmlspecialchars($user_role); ?></div>
                </div>
                <i class="fas fa-chevron-down dropdown-icon"></i>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Your page content will go here -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Welcome to NABL Lab Management System</h5>
                    <p class="card-text">Select an option from the sidebar to get started.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Toggle sidebar
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        
        // Toggle sidebar collapse/expand
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            const icon = sidebarToggle.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('fa-chevron-left');
                icon.classList.add('fa-chevron-right');
            } else {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-left');
            }
        });
        
        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
        
        // Handle submenu toggle
        const menuItems = document.querySelectorAll('.has-submenu');
        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                // Don't toggle if clicking on a submenu link
                if (e.target.tagName === 'A' && e.target.closest('.submenu')) {
                    return;
                }
                
                // Toggle the submenu
                const submenu = item.querySelector('.submenu');
                if (submenu) {
                    item.classList.toggle('open');
                    submenu.classList.toggle('show');
                }
            });
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
        
        // Handle window resize
        function handleResize() {
            if (window.innerWidth > 1024) {
                sidebar.classList.remove('show');
            }
        }
        
        window.addEventListener('resize', handleResize);
        
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            // Add tooltips to menu items when sidebar is collapsed
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                if (item.querySelector('.menu-text')) {
                    const tooltip = document.createElement('span');
                    tooltip.className = 'menu-tooltip';
                    tooltip.textContent = item.querySelector('.menu-text').textContent;
                    item.appendChild(tooltip);
                }
            });
        });
    </script>
</body>
</html>
