<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    brand: {
                        50: '#eff6ff',
                        100: '#dbeafe',
                        500: '#2563eb',
                        600: '#1d4ed8',
                        700: '#1e40af',
                        800: '#1e3a8a'
                    }
                }
            }
        }
    };
</script>
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
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

    .dt-container .dt-paging-button {
        border: 1px solid #cbd5e1 !important;
        border-radius: .5rem !important;
        margin: 0 .125rem;
        padding: .35rem .65rem !important;
    }

    .dt-container .dt-paging-button.current {
        background: #2563eb !important;
        color: #ffffff !important;
    }

    .dt-container table.dataTable thead th {
        border-bottom: 1px solid #cbd5e1;
    }
</style>
