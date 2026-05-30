<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
    window.StarterKit = {
        toast: function (title, text, icon = 'success') {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                timer: 1600,
                showConfirmButton: false
            });
        },
        dataTable: function (selector, options = {}) {
            const table = document.querySelector(selector);

            if (! table || typeof DataTable === 'undefined') {
                return null;
            }

            return new DataTable(selector, Object.assign({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(difilter dari _MAX_ total data)',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: 'Tidak ada data tersedia',
                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Selanjutnya',
                        previous: 'Sebelumnya'
                    }
                }
            }, options));
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();

        const overlay = document.getElementById('starterMobileOverlay');
        const panel = document.getElementById('starterMobilePanel');
        const open = document.getElementById('starterMobileOpen');
        const closeButtons = document.querySelectorAll('[data-starter-mobile-close]');

        const openSidebar = function () {
            overlay?.classList.remove('hidden');
            requestAnimationFrame(function () {
                panel?.classList.remove('-translate-x-full');
            });
        };

        const closeSidebar = function () {
            panel?.classList.add('-translate-x-full');
            setTimeout(function () {
                overlay?.classList.add('hidden');
            }, 180);
        };

        open?.addEventListener('click', openSidebar);
        overlay?.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeSidebar();
            }
        });

        closeButtons.forEach(function (button) {
            button.addEventListener('click', closeSidebar);
        });

        document.getElementById('starterNavbarAlert')?.addEventListener('click', function () {
            window.StarterKit.toast('Ready', 'Starter kit aktif.');
        });
    });
</script>
