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
   OUTLINEARCHITECTURES - BLACK & ORANGE THEME (COMPLETE FIX)
   ============================================ */

        /* CSS Variables */
        :root {
            --oa-orange: #C8622A;
            --oa-orange-dark: #A84E1E;
            --oa-orange-light: #E07840;
            --oa-orange-soft: #F5A97F;
            --oa-black: #000000;
            --oa-black-dark: #0A0A0A;
            --oa-black-light: #1A1A1A;
            --oa-gray: #2A2A2A;
            --oa-gray-light: #3A3A3A;
            --oa-white: #FFFFFF;
        }

        /* ============================================
   GLOBAL TEXT COLORS
   ============================================ */
        body,
        .app-main,
        .app-content {
            background: var(--oa-white) !important;
            color: #000000 !important;
        }

        /* ALL text on black backgrounds MUST be white */
        .bg-dark,
        .bg-black,
        [style*="background-color: black"],
        [style*="background:#000"],
        .sidebar-dark-primary,
        .app-sidebar,
        .app-footer,
        .modal-header,
        .card-header.bg-dark,
        .card-header.bg-black {
            color: var(--oa-white) !important;
        }

        .app-header.navbar {
            background: #000000 !important;
            background: linear-gradient(90deg, #000000 0%, #0A0A0A 50%, #111111 100%) !important;
            border-bottom: 2px solid var(--oa-orange);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.5);
        }

        /* ============================================
   SIDEBAR - BLACK BACKGROUND, WHITE TEXT
   ============================================ */
        .app-sidebar {
            background: #000000 !important;
            background: linear-gradient(180deg, #000000 0%, #0A0A0A 50%, #111111 100%) !important;
        }

        .app-sidebar * {
            color: var(--oa-white) !important;
        }

        .sidebar-brand {
            background: rgba(0, 0, 0, 0.5) !important;
            border-bottom: 1px solid var(--oa-orange);
        }

        .brand-link {
            color: var(--oa-white) !important;
        }

        .brand-link:hover {
            background: rgba(200, 98, 42, 0.15) !important;
        }

        /* Nav Headers */
        .nav-header {
            color: var(--oa-orange) !important;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-size: 0.7rem;
        }

        /* Main Nav Links */
        .nav-sidebar>.nav-item>.nav-link {
            color: var(--oa-white) !important;
            background: transparent !important;
            border-left: 3px solid transparent;
        }

        .nav-sidebar>.nav-item>.nav-link:hover {
            background: rgba(200, 98, 42, 0.2) !important;
            color: var(--oa-white) !important;
            border-left: 3px solid var(--oa-orange);
        }

        .nav-sidebar>.nav-item>.nav-link.active {
            background: linear-gradient(90deg, var(--oa-orange) 0%, var(--oa-orange-light) 100%) !important;
            color: var(--oa-white) !important;
            border-left: 3px solid var(--oa-white);
            box-shadow: 0 2px 12px rgba(200, 98, 42, 0.5);
        }

        /* Nav Icons */
        .nav-sidebar .nav-icon {
            color: var(--oa-orange) !important;
        }

        .nav-sidebar>.nav-item>.nav-link.active .nav-icon {
            color: var(--oa-white) !important;
        }

        /* Treeview */
        .nav-treeview {
            background: rgba(0, 0, 0, 0.5) !important;
            border-left: 2px solid var(--oa-orange);
        }

        .nav-treeview .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .nav-treeview .nav-link:hover {
            background: rgba(200, 98, 42, 0.2) !important;
            color: var(--oa-white) !important;
        }

        .nav-treeview .nav-link.active {
            background: linear-gradient(90deg, rgba(200, 98, 42, 0.3) 0%, transparent 100%) !important;
            color: var(--oa-white) !important;
            border-left: 2px solid var(--oa-orange);
        }

        /* Chevron Arrows */
        .nav-arrow {
            color: var(--oa-orange) !important;
        }

        /* ============================================
   NAVBAR / HEADER - BLACK BACKGROUND, WHITE TEXT
   ============================================ */
        .app-header.navbar {
            background: #000000 !important;
            background: linear-gradient(90deg, #000000 0%, #0A0A0A 50%, #111111 100%) !important;
            border-bottom: 2px solid var(--oa-orange);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.5);
        }

        .navbar-nav .nav-link {
            color: var(--oa-white) !important;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(200, 98, 42, 0.2) !important;
            color: var(--oa-white) !important;
        }

        .navbar-nav .nav-link i {
            color: var(--oa-white);
        }

        .navbar-nav .nav-link:hover i {
            color: var(--oa-orange);
        }

        /* Notification Badge */
        .navbar-badge {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
            border: 1px solid var(--oa-white);
        }

        /* Dropdown - Dark background with white text */
        .dropdown-menu {
            background: #1A1A1A !important;
            border: 1px solid var(--oa-orange);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }

        .dropdown-menu * {
            color: var(--oa-white) !important;
        }

        .dropdown-item {
            color: var(--oa-white) !important;
        }

        .dropdown-item:hover {
            background: rgba(200, 98, 42, 0.2) !important;
            color: var(--oa-orange) !important;
        }

        .dropdown-header {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
        }

        .dropdown-divider {
            border-color: var(--oa-orange);
        }

        /* User Header */
        .user-header {
            background: linear-gradient(135deg, var(--oa-orange) 0%, var(--oa-orange-dark) 100%) !important;
            color: var(--oa-white) !important;
        }

        .user-header p,
        .user-header small {
            color: var(--oa-white) !important;
        }

        .user-header small {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* User Footer */
        .user-footer {
            background: #1A1A1A !important;
        }

        .user-footer .btn-default {
            background: #2A2A2A !important;
            border: 1px solid var(--oa-orange);
            color: var(--oa-white) !important;
        }

        .user-footer .btn-default:hover {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
        }

        /* ============================================
   FIX FOR USER DROPDOWN MENU VISIBILITY
   ============================================ */

        /* User dropdown toggle button text */
        .user-menu .nav-link.dropdown-toggle {
            color: var(--oa-white) !important;
            background: rgba(200, 98, 42, 0.2) !important;
            border: 1px solid var(--oa-orange);
            border-radius: 20px;
            padding: 6px 14px;
        }

        .user-menu .nav-link.dropdown-toggle:hover {
            background: rgba(200, 98, 42, 0.4) !important;
            color: var(--oa-white) !important;
        }

        /* User name text in dropdown toggle */
        .user-menu .nav-link .d-none.d-md-inline {
            color: var(--oa-white) !important;
        }

        /* Dropdown menu container */
        .user-menu .dropdown-menu {
            background: #1A1A1A !important;
            border: 1px solid var(--oa-orange);
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        }

        /* ALL text inside dropdown menu - WHITE */
        .user-menu .dropdown-menu * {
            color: var(--oa-white) !important;
        }

        /* User header section (orange gradient) */
        .user-menu .user-header {
            background: linear-gradient(135deg, var(--oa-orange) 0%, var(--oa-orange-dark) 100%) !important;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            padding: 20px;
        }

        .user-menu .user-header p {
            color: var(--oa-white) !important;
            font-size: 1rem;
            margin: 0;
        }

        .user-menu .user-header small {
            color: rgba(255, 255, 255, 0.85) !important;
            display: block;
            font-size: 0.75rem;
        }

        /* User body section */
        .user-menu .user-body {
            background: #1A1A1A !important;
            padding: 10px;
        }

        /* User footer section */
        .user-menu .user-footer {
            background: #1A1A1A !important;
            border-top: 1px solid var(--oa-orange);
            padding: 12px;
            border-radius: 0 0 8px 8px;
        }

        /* Buttons inside dropdown */
        .user-menu .user-footer .btn-default {
            background: #2A2A2A !important;
            border: 1px solid var(--oa-orange);
            color: var(--oa-white) !important;
            font-size: 0.85rem;
            padding: 5px 12px;
            border-radius: 5px;
        }

        .user-menu .user-footer .btn-default:hover {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
            border-color: var(--oa-white);
        }

        /* Profile button (left button) */
        .user-menu .user-footer .btn-default:first-child {
            float: left;
        }

        /* Sign out button (right button) */
        .user-menu .user-footer .btn-default.float-end {
            float: right;
        }

        /* Dropdown arrow */
        .user-menu .dropdown-toggle::after {
            color: var(--oa-orange) !important;
            margin-left: 8px;
        }

        /* ============================================
   CONTENT HEADER - BLACK BACKGROUND, WHITE TEXT (FIXED)
   ============================================ */
        .app-content-header {
            background: #000000 !important;
            background: linear-gradient(90deg, #000000 0%, #0A0A0A 50%, #1A1A1A 100%) !important;
            border-bottom: 2px solid var(--oa-orange);
            padding: 20px 0;
            margin: 0;
        }

        .app-content-header .container-fluid,
        .app-content-header .row,
        .app-content-header .col-sm-6 {
            background: transparent !important;
        }

        .app-content-header,
        .app-content-header * {
            background: transparent !important;
        }

        .app-content-header h3,
        .app-content-header .mb-0 {
            color: var(--oa-white) !important;
            font-weight: 600;
            text-shadow: none;
        }

        .app-content-header .breadcrumb {
            background: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid var(--oa-orange);
            border-radius: 8px;
            padding: 8px 16px;
            display: inline-flex;
        }

        .app-content-header .breadcrumb-item {
            color: var(--oa-orange) !important;
        }

        .app-content-header .breadcrumb-item a {
            color: var(--oa-white) !important;
            text-decoration: none;
        }

        .app-content-header .breadcrumb-item a:hover {
            color: var(--oa-orange) !important;
        }

        .app-content-header .breadcrumb-item.active {
            color: var(--oa-orange) !important;
            font-weight: 500;
        }

        .app-content-header .breadcrumb-item+.breadcrumb-item::before {
            color: var(--oa-white) !important;
            content: "/";
            padding: 0 8px;
        }

        .app-content-header .col-sm-6 h3 {
            background: transparent !important;
            color: var(--oa-white) !important;
        }

        .app-content-header .col-sm-6:first-child {
            background: transparent !important;
        }

        .app-content-header .col-sm-6:last-child {
            background: transparent !important;
            text-align: right;
        }

        .app-content-header::before,
        .app-content-header::after {
            display: none !important;
        }

        .app-content-header .card,
        .app-content-header .bg-white,
        .app-content-header .bg-light {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }

        /* ============================================
   MAIN CONTENT - WHITE BACKGROUND, BLACK TEXT
   ============================================ */


        /* ALL text on white background = BLACK */
        .app-main *:not(.btn):not(.dropdown-item):not(.modal-header *) {
            color: #000000;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label,
        div,
        small,
        strong,
        b {
            color: #000000 !important;
        }

        h1 {
            border-bottom: 3px solid var(--oa-orange);
        }

        /* ============================================
   BUTTONS
   ============================================ */
        .btn-primary {
            background: var(--oa-orange) !important;
            border: none !important;
            color: var(--oa-white) !important;
        }

        .btn-primary:hover {
            background: var(--oa-orange-dark) !important;
            color: var(--oa-white) !important;
        }

        .btn-secondary {
            background: #2A2A2A !important;
            border: 1px solid var(--oa-orange) !important;
            color: var(--oa-white) !important;
        }

        .btn-secondary:hover {
            background: #3A3A3A !important;
            color: var(--oa-orange) !important;
        }

        .btn-danger {
            background: #dc2626 !important;
            border: none !important;
            color: var(--oa-white) !important;
        }

        .btn-success {
            background: #16a34a !important;
            border: none !important;
            color: var(--oa-white) !important;
        }

        .btn-warning {
            background: var(--oa-orange) !important;
            border: none !important;
            color: var(--oa-white) !important;
        }

        .btn-info {
            background: var(--oa-orange-light) !important;
            border: none !important;
            color: var(--oa-white) !important;
        }

        /* ============================================
   FORM ELEMENTS
   ============================================ */
        .form-control,
        select,
        textarea,
        input {
            background: var(--oa-white) !important;
            border: 1px solid #CCCCCC !important;
            color: #000000 !important;
        }

        .form-control:focus,
        select:focus,
        textarea:focus,
        input:focus {
            border-color: var(--oa-orange) !important;
            box-shadow: 0 0 0 0.2rem rgba(200, 98, 42, 0.25) !important;
        }

        .form-label {
            color: #000000 !important;
        }

        /* ============================================
   TABLES
   ============================================ */
        .table {
            background: var(--oa-white) !important;
            border: 1px solid #E0E0E0 !important;
            color: #000000 !important;
        }

        .table thead {
            background: #000000 !important;
        }

        .table thead th {
            color: var(--oa-white) !important;
            background: #000000 !important;
            border-bottom: 2px solid var(--oa-orange);
        }

        .table tbody tr {
            color: #000000 !important;
        }

        .table tbody td {
            color: #000000 !important;
        }

        .table tbody tr:hover {
            background: rgba(200, 98, 42, 0.05) !important;
        }

        /* ============================================
   CARDS
   ============================================ */
        .card {
            background: var(--oa-white) !important;
            border: 1px solid #E0E0E0 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: #F8F8F8 !important;
            border-bottom: 2px solid var(--oa-orange) !important;
        }

        .card-header * {
            color: #000000 !important;
        }

        .card-body * {
            color: #000000 !important;
        }

        .card-footer {
            background: #F8F8F8 !important;
            border-top: 1px solid #E0E0E0;
        }

        /* ============================================
   MODALS
   ============================================ */
        .modal-content {
            background: var(--oa-white) !important;
            border: 1px solid var(--oa-orange);
        }

        .modal-header {
            background: #000000 !important;
            border-bottom: 2px solid var(--oa-orange);
        }

        .modal-header * {
            color: var(--oa-white) !important;
        }

        .modal-body * {
            color: #000000 !important;
        }

        .modal-footer {
            border-top: 1px solid #E0E0E0;
        }

        /* ============================================
   ALERTS
   ============================================ */
        .alert-success {
            background: #F0FDF4 !important;
            border-left: 4px solid #16a34a !important;
            color: #000000 !important;
        }

        .alert-danger {
            background: #FEF2F2 !important;
            border-left: 4px solid #dc2626 !important;
            color: #000000 !important;
        }

        .alert-warning {
            background: #FFF7ED !important;
            border-left: 4px solid var(--oa-orange) !important;
            color: #000000 !important;
        }

        .alert-info {
            background: #EFF6FF !important;
            border-left: 4px solid var(--oa-orange-light) !important;
            color: #000000 !important;
        }

        /* ============================================
   PAGINATION
   ============================================ */
        .pagination .page-link {
            background: var(--oa-white) !important;
            color: var(--oa-orange) !important;
            border: 1px solid #E0E0E0;
        }

        .pagination .page-item.active .page-link {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
            border-color: var(--oa-orange);
        }

        .pagination .page-item .page-link:hover {
            background: rgba(200, 98, 42, 0.1) !important;
            color: var(--oa-orange-dark) !important;
        }

        /* ============================================
   FOOTER - BLACK BACKGROUND, WHITE TEXT
   ============================================ */
        .app-footer {
            background: #000000 !important;
            border-top: 2px solid var(--oa-orange);
        }

        .app-footer * {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .app-footer a {
            color: var(--oa-orange) !important;
        }

        .app-footer a:hover {
            color: var(--oa-orange-light) !important;
        }

        /* ============================================
   DETAIL/SHOW PAGES
   ============================================ */
        .show-page,
        .detail-page,
        .card-body .list-group-item,
        .dl-horizontal dt,
        .dl-horizontal dd,
        .description-list,
        .show-field {
            background: var(--oa-white) !important;
            color: #000000 !important;
        }

        /* ============================================
   BADGES & TAGS
   ============================================ */
        .badge-primary {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
        }

        .badge-secondary {
            background: #2A2A2A !important;
            color: var(--oa-white) !important;
        }

        /* ============================================
   NAV TABS
   ============================================ */
        .nav-tabs .nav-link {
            color: #000000 !important;
            background: #F8F8F8;
            border: 1px solid #E0E0E0;
        }

        .nav-tabs .nav-link.active {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
            border-color: var(--oa-orange);
        }

        /* ============================================
   PROGRESS BARS
   ============================================ */
        .progress {
            background: #E0E0E0 !important;
        }

        .progress-bar {
            background: var(--oa-orange) !important;
        }

        /* ============================================
   SCROLLBAR
   ============================================ */
        ::-webkit-scrollbar-track {
            background: #1A1A1A;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--oa-orange);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--oa-orange-light);
        }

        /* ============================================
   SELECTION HIGHLIGHT
   ============================================ */
        ::selection {
            background: var(--oa-orange);
            color: var(--oa-white);
        }

        ::-moz-selection {
            background: var(--oa-orange);
            color: var(--oa-white);
        }

        /* ============================================
   LINKS
   ============================================ */
        a:not(.nav-link):not(.dropdown-item):not(.btn) {
            color: var(--oa-orange) !important;
        }

        a:not(.nav-link):not(.dropdown-item):not(.btn):hover {
            color: var(--oa-orange-dark) !important;
        }

        /* ============================================
   RESPONSIVE
   ============================================ */
        @media (max-width: 768px) {
            .app-content-header h3 {
                color: var(--oa-white) !important;
            }

            .app-header.navbar {
                background: #000000 !important;
            }
        }

        /* ============================================
   UTILITY CLASSES
   ============================================ */
        .text-primary {
            color: var(--oa-orange) !important;
        }

        .bg-primary {
            background: var(--oa-orange) !important;
            color: var(--oa-white) !important;
        }

        .border-primary {
            border-color: var(--oa-orange) !important;
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
                                    Our Clients
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'clients']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'clients']) }}"
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
                                    <a href="{{ route('admin.page.create', ['slug' => 'cta']) }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'cta']) }}" class="nav-link">
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
                                    contact content
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'contact-content']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'contact-content']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-header">About</li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    about Banner
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'about-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'about-banner']) }}"
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
                                    Our Story Title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'our-story-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'our-story-title']) }}"
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
                                    Our Story
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'our-story']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'our-story']) }}"
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
                                    Our Value Title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'our-value-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'our-value-title']) }}"
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
                                    Our Values
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'our-values']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'our-values']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-header">Members</li>



                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Member Title
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'member-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'member-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    Members
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.members.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.members.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
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
                                    <a href="{{ route('admin.services.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.services.create') }}" class="nav-link">
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
                                    <a href="{{ route('admin.page.create', ['slug' => 'service-title']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'service-title']) }}"
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
                                    Service Content
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'service-content']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'service-content']) }}"
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
                                    Why Choose Us
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'why-choose-us-2']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'why-choose-us-2']) }}"
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
                                    why Choose Us Cards
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'why-choose-us-card']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'why-choose-us-card']) }}"
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
                                    Service Page Banner
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'service-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'service-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                        <li class="nav-header">Portfolio</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-collection"></i>
                                <p>
                                    Portfolio Categories
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.portfolio-categories.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.portfolio-categories.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-images"></i>
                                <p>
                                    Portfolios
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.portfolios.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.portfolios.create') }}" class="nav-link">
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
                                    Portfolio Page Banner
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'portfolio-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'portfolio-banner']) }}"
                                        class="nav-link">
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
        <i class="nav-icon bi bi-briefcase-fill"></i>
        <p>
            Contact Request
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Contact Enquiries</p>
            </a>
        </li>
    </ul>
</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>
                                    Contact Page Banner
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'contact-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'contact-banner']) }}"
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

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-briefcase-fill"></i>
                                <p>
                                    Apply Job Banner
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'apply-job-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'apply-job-banner']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">CUSTOM</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-seam"></i>
                                <p>
                                    Custom Css
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.custom-css.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.custom-css.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box-seam"></i>
                                <p>
                                    Custom Js
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.custom-javascript.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>List</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.custom-javascript.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-header">FOOTER</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-briefcase-fill"></i>
                                <p>
                                    Footer Content
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.create', ['slug' => 'footer-content']) }}"
                                        class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.page.index', ['slug' => 'footer-content']) }}"
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
