<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    :root {
        --starter-primary: #2563eb;
        --starter-primary-dark: #1e3a8a;
        --starter-primary-soft: #dbeafe;
        --starter-primary-ink: #172554;
        --starter-surface: #ffffff;
        --starter-border: #dbe3ef;
        --starter-muted: #64748b;
        --starter-sidebar-width: 17.75rem;
    }

    .starter-body {
        background: #f4f7fb;
        color: #1f2937;
    }

    .starter-shell {
        min-height: 100vh;
    }

    .starter-main {
        min-width: 0;
    }

    .min-w-0 {
        min-width: 0;
    }

    .starter-sidebar {
        background: linear-gradient(180deg, #1d4ed8 0%, #1e40af 52%, #1e3a8a 100%);
        box-shadow: inset -1px 0 0 rgba(255, 255, 255, .08);
        color: #eff6ff;
        min-height: 100vh;
        padding: 1rem;
        width: var(--starter-sidebar-width);
    }

    .starter-brand {
        border-bottom: 1px solid rgba(255, 255, 255, .14);
        margin-bottom: 1rem;
        padding: .25rem .25rem 1rem;
    }

    .starter-brand-icon,
    .starter-sidebar-card-icon {
        align-items: center;
        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .22);
        border-radius: .5rem;
        color: #ffffff;
        display: inline-flex;
        height: 2.5rem;
        justify-content: center;
        width: 2.5rem;
    }

    .text-blue-100 {
        color: #dbeafe;
    }

    .starter-sidebar-section {
        padding: .35rem .25rem;
    }

    .starter-sidebar-label {
        color: #bfdbfe;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: 0;
        margin: .75rem .75rem .5rem;
        text-transform: uppercase;
    }

    .starter-sidebar-nav .nav-link,
    .starter-offcanvas-nav .nav-link {
        align-items: center;
        border-radius: .5rem;
        color: rgba(239, 246, 255, .82);
        display: flex;
        font-weight: 600;
        gap: .75rem;
        min-height: 2.625rem;
        padding: .625rem .75rem;
    }

    .starter-sidebar-nav .nav-link:hover,
    .starter-sidebar-nav .nav-link.active,
    .starter-offcanvas-nav .nav-link:hover,
    .starter-offcanvas-nav .nav-link.active {
        background: rgba(255, 255, 255, .16);
        color: #ffffff;
    }

    .starter-sidebar-nav .nav-link i,
    .starter-offcanvas-nav .nav-link i {
        font-size: 1.05rem;
        width: 1.25rem;
    }

    .starter-sidebar-card {
        align-items: center;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .16);
        border-radius: .5rem;
        display: flex;
        gap: .75rem;
        padding: .85rem;
    }

    .starter-topbar {
        border-bottom: 1px solid var(--starter-border);
        min-height: 4.25rem;
        z-index: 1020;
    }

    .starter-icon-button {
        align-items: center;
        border: 1px solid var(--starter-border);
        border-radius: .5rem;
        display: inline-flex;
        height: 2.5rem;
        justify-content: center;
        width: 2.5rem;
    }

    .starter-search {
        align-items: center;
        background: #f8fafc;
        border: 1px solid var(--starter-border);
        border-radius: .5rem;
        color: var(--starter-muted);
        gap: .5rem;
        min-width: min(23rem, 34vw);
        padding: 0 .75rem;
    }

    .starter-search .form-control {
        background: transparent;
        border: 0;
        box-shadow: none;
        min-height: 2.5rem;
        padding-left: 0;
    }

    .starter-user-menu {
        align-items: center;
        border: 1px solid transparent;
        display: inline-flex;
        gap: .625rem;
        min-height: 2.5rem;
        padding: .25rem .5rem;
    }

    .starter-user-menu:hover {
        background: #f8fafc;
        border-color: var(--starter-border);
    }

    .starter-avatar {
        align-items: center;
        background: var(--starter-primary-soft);
        border-radius: 999px;
        color: var(--starter-primary);
        display: inline-flex;
        height: 2.25rem;
        justify-content: center;
        width: 2.25rem;
    }

    .starter-content {
        padding: 1.25rem;
    }

    .starter-page-header {
        background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
        border: 1px solid var(--starter-border);
        border-radius: .5rem;
        margin-bottom: 1.25rem;
        padding: 1.25rem;
    }

    .starter-page-kicker {
        color: var(--starter-primary);
        font-size: .75rem;
        font-weight: 800;
        text-transform: uppercase;
    }

    .starter-footer {
        border-top: 1px solid var(--starter-border);
    }

    .starter-table-card,
    .card {
        border-radius: .5rem;
    }

    .starter-table-card .card-header {
        background: #ffffff;
        border-color: var(--starter-border);
    }

    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select,
    .dt-container .dt-input {
        border: 1px solid var(--starter-border) !important;
        border-radius: .5rem !important;
        min-height: 2.375rem;
    }

    .page-link,
    .dt-container .dt-paging-button {
        border-radius: .5rem !important;
    }

    .active > .page-link,
    .page-link.active,
    .dt-container .dt-paging-button.current {
        background: var(--starter-primary) !important;
        border-color: var(--starter-primary) !important;
        color: #ffffff !important;
    }

    .starter-mobile-sidebar {
        background: linear-gradient(180deg, #1d4ed8 0%, #1e3a8a 100%);
        color: #eff6ff;
    }

    @media (min-width: 992px) {
        .starter-content {
            padding: 1.75rem;
        }
    }
</style>
