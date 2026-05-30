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

    .dt-container .dt-layout-row {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-between;
        margin: 0 0 1rem;
    }

    .dt-container .dt-input {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: .5rem;
        min-height: 2.375rem;
        padding: .375rem .75rem;
    }

    .dt-container .dt-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
        outline: none;
    }

    .dt-container .dt-paging-button {
        border: 1px solid #cbd5e1 !important;
        border-radius: .5rem !important;
        margin: 0 .125rem;
        padding: .35rem .65rem !important;
    }

    .dt-container .dt-paging-button:hover {
        background: #eff6ff !important;
        color: #1d4ed8 !important;
    }

    .dt-container .dt-paging-button.current {
        background: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
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
    .dt-container .dt-info {
        color: #64748b;
        font-size: .875rem;
    }

    .dt-container .dt-search input {
        min-width: min(18rem, 70vw);
    }
</style>
