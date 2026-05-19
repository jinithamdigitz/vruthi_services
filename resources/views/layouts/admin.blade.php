<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Panel</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="Admin Panel by MDIGTIZ SOFT SOLUTIONS" />
    <meta name="author" content="MDIGTIZ SOFT SOLUTIONS" />
    <meta name="description" content="." />
    <meta name="keywords" content="" />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.css') }}" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}"> <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />

    <!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />

    <style>
        /* ============================================
           BRAND COLOR VARIABLES - BLUE THEME
        ============================================ */
        :root {
            --brand-blue-dark: #0a2b4e;
            --brand-blue-primary: #1e3a8a;
            --brand-blue-ocean: #2563eb;
            --brand-blue-sky: #3b82f6;
            --brand-blue-light: #60a5fa;
            --brand-blue-soft: #93c5fd;
            --brand-white: #ffffff;

            /* Derived */
            --brand-dark-blue: #0f2c59;
            --brand-light-bg: #f0f9ff;
            --brand-glass-bg: rgba(255, 255, 255, 0.12);
            --brand-glass-border: rgba(255, 255, 255, 0.25);
        }

        /* ============================================
           SIDEBAR - Rich Dark Blue Gradient
        ============================================ */
        .app-sidebar {
            background: linear-gradient(160deg, #0a1628 0%, #0a2b4e 40%, #1e3a8a 100%) !important;
        }

        .sidebar-brand {
            background: rgba(0, 0, 0, 0.25) !important;
            border-bottom: 1px solid var(--brand-glass-border);
            backdrop-filter: blur(10px);
        }

        .brand-link {
            color: var(--brand-white) !important;
            background: transparent !important;
        }

        .brand-link:hover {
            background: var(--brand-glass-bg) !important;
        }

        /* Nav Headers */
        .nav-header {
            color: var(--brand-blue-soft) !important;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        /* Main Nav Links */
        .nav-sidebar>.nav-item>.nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            background: transparent !important;
            border-left: 3px solid transparent;
            transition: all 0.25s ease;
        }

        .nav-sidebar>.nav-item>.nav-link:hover {
            background: var(--brand-glass-bg) !important;
            backdrop-filter: blur(6px);
            color: var(--brand-white) !important;
            border-left: 3px solid var(--brand-blue-sky);
        }

        .nav-sidebar>.nav-item>.nav-link.active {
            background: linear-gradient(90deg, var(--brand-blue-ocean) 0%, var(--brand-blue-sky) 100%) !important;
            color: var(--brand-white) !important;
            border-left: 3px solid var(--brand-white);
            box-shadow: 0 2px 12px rgba(37, 99, 235, 0.45);
        }

        /* Nav Icons */
        .nav-sidebar .nav-icon {
            color: var(--brand-blue-light) !important;
        }

        .nav-sidebar>.nav-item>.nav-link.active .nav-icon {
            color: var(--brand-white) !important;
        }

        /* Treeview */
        .nav-treeview {
            background: rgba(0, 0, 0, 0.2) !important;
            border-left: 2px solid rgba(59, 130, 246, 0.35);
            margin-left: 8px;
        }

        .nav-treeview .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            background: transparent !important;
            transition: all 0.2s ease;
            font-size: 0.88rem;
        }

        .nav-treeview .nav-link:hover {
            background: var(--brand-glass-bg) !important;
            color: var(--brand-white) !important;
            padding-left: 1.5rem;
        }

        .nav-treeview .nav-link.active {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.35) 0%, transparent 100%) !important;
            color: var(--brand-white) !important;
            border-left: 2px solid var(--brand-blue-sky);
        }

        /* Chevron Arrows */
        .nav-arrow {
            color: var(--brand-blue-light) !important;
        }

        .nav-link[aria-expanded="true"] .nav-arrow {
            color: var(--brand-white) !important;
        }

        /* Open parent */
        .nav-item.menu-open>.nav-link {
            background: rgba(37, 99, 235, 0.08) !important;
            color: var(--brand-white) !important;
        }

        /* Scrollbar */
        .sidebar-wrapper::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--brand-blue-ocean), var(--brand-blue-sky));
            border-radius: 3px;
        }

        /* ============================================
           NAVBAR / HEADER - SAME RICH DARK BLUE GRADIENT AS SIDEBAR
        ============================================ */
        .app-header.navbar {
            background: linear-gradient(160deg, #0a1628 0%, #0a2b4e 45%, #1e3a8a 100%) !important;
            border-bottom: 2px solid rgba(59, 130, 246, 0.5);
            box-shadow: 0 2px 16px rgba(37, 99, 235, 0.45);
            position: relative;
        }

        /* Optional: subtle blue glow effect */
        .app-header.navbar::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--brand-blue-sky), var(--brand-blue-light), transparent);
            pointer-events: none;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.92) !important;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 6px;
            transition: all 0.25s ease;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(96, 165, 250, 0.25) !important;
            backdrop-filter: blur(8px);
            color: var(--brand-white) !important;
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link i {
            color: rgba(255, 255, 255, 0.9);
            transition: color 0.2s;
        }

        .navbar-nav .nav-link:hover i {
            color: var(--brand-blue-sky);
        }

        /* Notification Badge - enhanced with blue */
        .navbar-badge {
            background: linear-gradient(135deg, var(--brand-blue-sky) 0%, var(--brand-blue-ocean) 100%) !important;
            color: var(--brand-white) !important;
            font-weight: 700;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
        }

        /* Dropdown */
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid var(--brand-glass-border);
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.18);
            border-radius: 10px;
        }

        .dropdown-item {
            color: #2d2d2d;
            font-weight: 500;
            padding: 9px 16px;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.08) 0%, transparent 100%);
            color: var(--brand-blue-primary);
        }

        /* User Header - richer blue gradient */
        .user-header {
            background: linear-gradient(135deg, var(--brand-blue-primary) 0%, #0f2c59 50%, var(--brand-blue-ocean) 100%) !important;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .user-header p {
            color: var(--brand-white);
            margin: 0;
        }

        .user-header small {
            color: rgba(255, 255, 255, 0.85);
        }

        /* User Footer */
        .user-footer .btn-default {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            color: var(--brand-blue-primary);
            transition: all 0.25s ease;
            border-radius: 20px;
        }

        .user-footer .btn-default:hover {
            background: linear-gradient(135deg, var(--brand-blue-primary) 0%, var(--brand-blue-ocean) 100%);
            color: var(--brand-white);
            border-color: transparent;
            transform: translateY(-1px);
        }

        /* User Menu Toggle - matches sidebar dark blue */
        .user-menu .nav-link.dropdown-toggle {
            background: rgba(10, 43, 78, 0.5) !important;
            border: 1px solid rgba(59, 130, 246, 0.4);
            border-radius: 20px;
            padding: 6px 14px;
            transition: all 0.25s ease;
        }

        .user-menu .nav-link.dropdown-toggle:hover {
            background: rgba(30, 58, 138, 0.7) !important;
            border-color: var(--brand-blue-sky);
        }

        /* Dropdown Header */
        .dropdown-header {
            background: linear-gradient(90deg, var(--brand-blue-primary), var(--brand-blue-ocean));
            color: var(--brand-white);
            font-weight: 600;
        }

        .dropdown-divider {
            border-color: rgba(37, 99, 235, 0.15);
        }

        /* ============================================
           CONTENT HEADER (Page Title Bar) - Enhanced Blue Gradient
        ============================================ */
        .app-content-header {
            background: linear-gradient(90deg, #0a1628 0%, #0a2b4e 35%, #1e3a8a 70%, var(--brand-blue-ocean) 100%);
            color: var(--brand-white);
            padding: 28px 0;
            position: relative;
            overflow: hidden;
            border-bottom: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Subtle radial overlays - enhanced blue glow */
        .app-content-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 15% 85%, rgba(96, 165, 250, 0.2) 0%, transparent 45%),
                radial-gradient(circle at 85% 15%, rgba(37, 99, 235, 0.18) 0%, transparent 45%);
            pointer-events: none;
        }

        .app-content-header .container-fluid {
            position: relative;
            z-index: 2;
        }

        .app-content-header h3 {
            color: var(--brand-white);
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.2px;
        }

        /* Breadcrumb — glass pill with dark blue tint */
        .breadcrumb {
            background: rgba(10, 43, 78, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(96, 165, 250, 0.4);
            border-radius: 30px;
            padding: 8px 22px;
            margin-bottom: 0;
            display: inline-flex;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.9) !important;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .breadcrumb-item a:hover {
            color: var(--brand-blue-sky) !important;
            text-shadow: 0 0 4px rgba(59, 130, 246, 0.5);
        }

        .breadcrumb-item.active {
            color: var(--brand-blue-sky) !important;
            font-weight: 600;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.6);
        }

        /* ============================================
           MAIN CONTENT AREA
        ============================================ */
        .app-main {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .app-content {
            background: transparent;
            min-height: calc(100vh - 200px);
        }

        .container-fluid {
            padding: 20px;
        }

        /* Page headings - enhanced blue */
        h1 {
            color: var(--brand-blue-primary);
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 3px solid var(--brand-blue-sky);
            padding-bottom: 10px;
        }

        /* ============================================
           BUTTONS - Enhanced with richer blues
        ============================================ */
        .btn-primary {
            background: linear-gradient(135deg, var(--brand-blue-primary) 0%, #0f2c59 50%, var(--brand-blue-ocean) 100%);
            border: none;
            color: var(--brand-white);
            font-weight: 600;
            transition: all 0.25s ease;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0f2c59 0%, var(--brand-blue-primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.45);
            color: var(--brand-white);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, var(--brand-blue-sky) 100%);
            border: none;
            color: #212529;
            font-weight: 500;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, var(--brand-blue-sky) 0%, var(--brand-blue-ocean) 100%);
            transform: translateY(-1px);
            color: var(--brand-white);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border: none;
            font-weight: 500;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            transform: translateY(-1px);
        }

        /* Focus states */
        .btn:focus,
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.3);
            border-color: var(--brand-blue-sky);
        }

        /* Disabled */
        .btn:disabled {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            transform: none;
        }

        /* ============================================
           TABLES - Enhanced with blue accents
        ============================================ */
        .table {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(37, 99, 235, 0.15);
        }

        .table thead {
            background: linear-gradient(90deg, #0a1628 0%, #0a2b4e 50%, #1e3a8a 100%);
            color: var(--brand-white);
        }

        .table thead th {
            border: none;
            font-weight: 700;
            padding: 14px 16px;
            text-transform: uppercase;
            font-size: 0.82em;
            letter-spacing: 0.6px;
            color: var(--brand-white);
        }

        .table tbody tr {
            transition: all 0.25s ease;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.06) 0%, transparent 100%);
            transform: translateX(2px);
        }

        .table tbody td {
            padding: 12px 16px;
            border-color: rgba(37, 99, 235, 0.08);
            vertical-align: middle;
        }

        .table img {
            border-radius: 6px;
            border: 2px solid rgba(37, 99, 235, 0.15);
            transition: all 0.25s ease;
        }

        .table img:hover {
            border-color: var(--brand-blue-sky);
            transform: scale(1.05);
        }

        .table .btn {
            margin: 2px;
            font-size: 0.82em;
            padding: 5px 11px;
            border-radius: 5px;
        }

        .table form {
            display: inline-block;
            margin: 0;
        }

        /* ============================================
           CARDS / CONTAINERS - Glass with blue tint
        ============================================ */
        .container,
        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.1);
            border: 1px solid rgba(37, 99, 235, 0.12);
            margin-bottom: 20px;
        }

        .card:hover {
            box-shadow: 0 8px 28px rgba(37, 99, 235, 0.15);
            border-color: rgba(59, 130, 246, 0.25);
        }

        /* ============================================
           FOOTER - Rich dark blue gradient matching sidebar
        ============================================ */
        .app-footer {
            background: linear-gradient(160deg, #0a1628 0%, #0a2b4e 40%, #1e3a8a 100%);
            color: rgba(255, 255, 255, 0.9);
            border-top: 2px solid rgba(59, 130, 246, 0.3);
        }

        .app-footer a {
            color: var(--brand-blue-sky) !important;
            font-weight: 500;
            text-decoration: none;
        }

        .app-footer a:hover {
            color: var(--brand-blue-light) !important;
            text-decoration: underline;
        }

        /* ============================================
           PAGINATION
        ============================================ */
        nav[role="navigation"][aria-label="Pagination Navigation"] {
            font-size: 0.7rem;
        }

        nav[role="navigation"] .relative.inline-flex.items-center {
            padding: 0.125rem 0.375rem;
            min-height: 1.5rem;
            min-width: 1.5rem;
            font-size: 0.7rem;
        }

        nav[role="navigation"] .w-5.h-5 {
            width: 0.75rem;
            height: 0.75rem;
        }

        nav[role="navigation"] .text-sm {
            font-size: 0.7rem;
        }

        /* Pagination active state */
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--brand-blue-ocean) 0%, var(--brand-blue-sky) 100%);
            border-color: var(--brand-blue-sky);
            color: white;
        }

        .pagination .page-link {
            color: var(--brand-blue-primary);
            transition: all 0.2s;
        }

        .pagination .page-link:hover {
            background: rgba(37, 99, 235, 0.1);
            color: var(--brand-blue-ocean);
            border-color: var(--brand-blue-sky);
        }

        /* ============================================
           RESPONSIVE
        ============================================ */
        @media (max-width: 768px) {
            .app-content-header {
                padding: 18px 0;
            }

            .app-content-header h3 {
                font-size: 1.4rem;
                text-align: center;
                margin-bottom: 10px;
            }

            .breadcrumb {
                justify-content: center;
            }

            .navbar-nav .nav-link {
                padding: 7px 10px;
            }

            .user-menu .nav-link.dropdown-toggle {
                padding: 5px 10px;
                font-size: 0.9em;
            }

            .table {
                font-size: 0.88em;
            }

            .table .btn {
                font-size: 0.78em;
                padding: 4px 8px;
            }

            .app-header.navbar {
                background: linear-gradient(160deg, #0a1628 0%, #0a2b4e 45%, #1e3a8a 100%) !important;
            }
        }

        /* ============================================
           ADDITIONAL BLUE ACCENTS
        ============================================ */

        /* Form elements with blue focus */
        select:focus,
        textarea:focus,
        input:focus {
            border-color: var(--brand-blue-sky) !important;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.2) !important;
        }

        /* Active/selected items */
        .nav-link.active {
            background: linear-gradient(90deg, var(--brand-blue-ocean) 0%, var(--brand-blue-sky) 100%) !important;
        }

        /* Scrollbar for content area */
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--brand-blue-ocean), var(--brand-blue-sky));
            border-radius: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(37, 99, 235, 0.05);
        }

        /* Selection highlight */
        ::selection {
            background: rgba(37, 99, 235, 0.3);
            color: #0a1628;
        }

        /* Alert/notification bars */
        .alert-success {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(96, 165, 250, 0.05));
            border-left: 4px solid var(--brand-blue-ocean);
            color: #2d2d2d;
        }
    </style>

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="{{ route('home.index') }}" class="nav-link">Home</a>
                    </li>

                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->

                    <!--end::Navbar Search-->

                    <!--begin::Messages Dropdown Menu-->


                    <!--begin::Notifications Dropdown Menu-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-bell-fill"></i>
                            <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-item dropdown-header">0 Notifications</span>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <!--end::Notifications Dropdown Menu-->

                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{-- avatar if you have one --}}
                            {{-- <img src="{{ asset(auth()->user()->avatar ?? 'default.png') }}" class="user-image img-circle" alt="User Image"> --}}
                            <span class="d-none d-md-inline">
                                {{ auth()->user()->name ?? 'Guest' }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                {{-- show avatar again if desired --}}
                                <p>
                                    {{ auth()->user()->name ?? '' }}
                                    {{-- if you store a role or job title --}}
                                    <small>{{ auth()->user()->role?->name ?? '' }}</small>
                                    <small>
                                        Member since {{ optional(auth()->user()->created_at)->format('M. Y') }}
                                    </small>
                                </p>
                            </li>
                            <!--end::User Image-->

                            <!--begin::Menu Body-->
                            <li class="user-body">
                                {{-- any links or stats you want --}}
                            </li>
                            <!--end::Menu Body-->

                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('admin.users.show', auth()->id()) }}"
                                    class="btn btn-default btn-flat">
                                    Profile
                                </a>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat float-end">Sign
                                        out</button>
                                </form>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>

                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="/" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="/img/logo.png" alt="" width="75px" class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->

                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                        aria-label="Main navigation" data-accordion="false" id="navigation">



                        <li class="nav-header">Home</li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Home Banner
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'home-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'home-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    About Us Title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'about-us-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'about-us-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    About us
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'home-about-us']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'home-about-us']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Featured Work Title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'featured-work-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'featured-work-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Featured Work
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'featured-work']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'featured-work']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Why choose us title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'why-choose-us-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'why-choose-us-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Why choose us
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'why-choose-us']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'why-choose-us']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Counters
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'counter']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'counter']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Testimonials Title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'testimonials-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'testimonials-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Testimonials
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'testimonials']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'testimonials']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    CTA
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'cta']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'cta']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                       







                        <li class="nav-header">Services</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-briefcase"></i>
                                <p>
                                    Services
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('services.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('services.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Service Title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'service-title']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'service-title']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-header">Pages</li>





                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Logo
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'logo']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'logo']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>






                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Privacy
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'privacy']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'privacy']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-header">SEO</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.seo.index') }}"
                                class="nav-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>SEO Parameters
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                        </li>




                        <li class="nav-header">Contact</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Phone
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'phone']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'phone']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Email
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'email']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'email']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Address
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'address']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'address']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Timings
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'timings']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'timings']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Social media Icons
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'social-icons']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'social-icons']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
						<li class="nav-header">Careers</li>
									<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-briefcase-fill"></i>
									<p>
										 Jobs
										<i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ route('career-jobs.index') }}" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>List</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('career-jobs.create') }}" class="nav-link">
											<i class="nav-icon bi bi-circle"></i>
											<p>Create</p>
										</a>
									</li>
								</ul>
							</li>
							
									<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-briefcase-fill"></i>
									<p>
										Job Page Banner
										<i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									  <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'careers-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                     </li>
										<li class="nav-item">
											<a href="{{ route('admin.page.index', ['slug' => 'careers-banner']) }}"
												class="nav-link">
												<i class="nav-icon bi bi-circle"></i>
												<p>List</p>
											</a>
										</li>
								</ul>
							</li>
							
								<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-briefcase-fill"></i>
									<p>
										Job Page Highlights
										<i class="nav-arrow bi bi-chevron-right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									  <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'career-highlights']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                     </li>
										<li class="nav-item">
											<a href="{{ route('admin.page.index', ['slug' => 'career-highlights']) }}"
												class="nav-link">
												<i class="nav-icon bi bi-circle"></i>
												<p>List</p>
											</a>
										</li>
								</ul>
							</li>
							
							
							
                        <li class="nav-header">Settings</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Categories
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.post-categories.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.post-categories.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Users
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Roles
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    @stack('styles')
                    @yield('content')
                    @stack('scripts')

                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2014-2025&nbsp;
                <a href="https://mdigitz.com" class="text-decoration-none">MDIGITZ SOFT SOLUTIONS</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

            // Disable OverlayScrollbars on mobile devices to prevent touch interference
            const isMobile = window.innerWidth <= 992;

            if (
                sidebarWrapper &&
                OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                !isMobile
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->

    <!-- OPTIONAL SCRIPTS -->

    <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>

    <!-- sortablejs -->
    <script>
        new Sortable(document.querySelector('.connectedSortable'), {
            group: 'shared',
            handle: '.card-header',
        });

        const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    </script>

    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

    <!-- ChartJS -->
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    </script>

    <!-- jsvectormap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>

    <!-- jsvectormap -->
    <script>
        // World map by jsVectorMap
        new jsVectorMap({
            selector: '#world-map',
            map: 'world',
        });

        // Sparkline charts
        const option_sparkline1 = {
            series: [{
                data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
        sparkline1.render();

        const option_sparkline2 = {
            series: [{
                data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
        sparkline2.render();

        const option_sparkline3 = {
            series: [{
                data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
        sparkline3.render();
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--end::Script-->
</body>
<!--end::Body-->

</html>