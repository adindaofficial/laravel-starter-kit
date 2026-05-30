<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    brand: {
                        50: '#eff6ff',
                        100: '#dbeafe',
                        200: '#bfdbfe',
                        500: '#2563eb',
                        600: '#1d4ed8',
                        700: '#1e40af',
                        800: '#1e3a8a',
                        950: '#172554'
                    }
                },
                boxShadow: {
                    panel: '0 18px 45px rgba(15, 23, 42, .08)'
                }
            }
        }
    };
</script>
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    html {
        scroll-behavior: smooth;
    }

    ::selection {
        background: #bfdbfe;
        color: #172554;
    }

    .dt-container {
        color: #334155;
        width: 100%;
    }

    .dataTables_wrapper,
    .dt-container {
        color: #334155;
        width: 100%;
    }

    .starter-dt-toolbar,
    .starter-dt-footer {
        align-items: center;
        background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
        border: 1px solid #e2e8f0;
        border-radius: .75rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-between;
        padding: .85rem;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .03);
    }

    .starter-dt-toolbar {
        margin-bottom: 1rem;
    }

    .starter-dt-footer {
        margin-top: 1rem;
    }

    .dt-container .dt-layout-row {
        align-items: center;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: .75rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-between;
        margin: 0 0 1rem;
        padding: .85rem;
    }

    .dt-container .dt-layout-row:last-child {
        margin: 1rem 0 0;
    }

    .dt-container .dt-input {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: .5rem;
        min-height: 2.375rem;
        padding: .375rem .75rem;
    }

    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: .5rem;
        min-height: 2.375rem;
        padding: .375rem .75rem;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .dt-container .dt-input:focus,
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
        outline: none;
    }

    .dt-container .dt-paging-button {
        border: 1px solid #cbd5e1 !important;
        border-radius: .5rem !important;
        color: #334155 !important;
        margin: 0 .125rem;
        padding: .35rem .65rem !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #cbd5e1 !important;
        border-radius: .5rem !important;
        color: #334155 !important;
        margin: 0 .125rem;
        padding: .35rem .65rem !important;
        transition: background .15s ease, border-color .15s ease, color .15s ease;
    }

    .dt-container .dt-paging-button:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #eff6ff !important;
        border-color: #bfdbfe !important;
        color: #1d4ed8 !important;
    }

    .dt-container .dt-paging-button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
    }

    .dt-container .dt-paging-button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        background: #f8fafc !important;
        color: #94a3b8 !important;
        cursor: not-allowed !important;
    }

    .dt-container table.dataTable thead th {
        background: #f8fafc;
        border-bottom: 1px solid #cbd5e1;
        color: #475569;
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: 0;
        text-transform: uppercase;
    }

    .dt-container table.dataTable tbody td {
        border-color: #e2e8f0;
        padding-bottom: .85rem;
        padding-top: .85rem;
    }

    .dt-container .dt-search label,
    .dt-container .dt-length label,
    .dt-container .dt-info,
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_info {
        color: #64748b;
        font-size: .875rem;
    }

    .dt-container .dt-search input,
    .dataTables_wrapper .dataTables_filter input {
        min-width: min(18rem, 70vw);
    }

    .dt-container .dt-search,
    .dt-container .dt-length,
    .dt-container .dt-paging,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_paginate {
        align-items: center;
        display: flex;
        gap: .5rem;
    }

    .dt-container .dt-search label,
    .dt-container .dt-length label,
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label {
        align-items: center;
        display: flex;
        gap: .5rem;
    }

    @media (max-width: 640px) {
        .dt-container .dt-layout-row,
        .starter-dt-toolbar,
        .starter-dt-footer,
        .dt-container .dt-search,
        .dt-container .dt-length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_paginate,
        .dt-container .dt-search label,
        .dt-container .dt-length label,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_length label {
            align-items: stretch;
            flex-direction: column;
            width: 100%;
        }

        .dt-container .dt-search input,
        .dt-container .dt-length select,
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            width: 100%;
        }
    }
</style>
