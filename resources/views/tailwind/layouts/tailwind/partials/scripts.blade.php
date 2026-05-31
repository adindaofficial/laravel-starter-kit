<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

            if (! table) {
                return null;
            }

            const finalOptions = Object.assign({
                destroy: true,
                autoWidth: false,
                info: true,
                lengthChange: true,
                ordering: true,
                paging: true,
                pagingType: 'simple_numbers',
                responsive: true,
                searching: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                dom: '<"starter-dt-toolbar"lf>rt<"starter-dt-footer"ip>',
                layout: {
                    topStart: 'pageLength',
                    topEnd: 'search',
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                },
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
                        next: 'Next',
                        previous: 'Prev'
                    }
                }
            }, options);

            if (window.jQuery && window.jQuery.fn && window.jQuery.fn.DataTable) {
                return window.jQuery(selector).DataTable(finalOptions);
            }

            if (typeof DataTable !== 'undefined') {
                return new DataTable(selector, finalOptions);
            }

            console.error('DataTables library is not loaded.');

            return null;
        },
        initDataTables: function () {
            document.querySelectorAll('.starter-datatable').forEach(function (table) {
                if (table.dataset.datatableReady === '1') {
                    return;
                }

                table.dataset.datatableReady = '1';
                const actionIndex = table.querySelectorAll('thead th').length - 1;
                const columnDefs = [
                    { targets: actionIndex, orderable: false, searchable: false }
                ];

                if (table.id === 'usersTable') {
                    columnDefs.push(
                        { targets: 0, width: '6%', className: 'starter-col-no', orderable: false, searchable: false },
                        { targets: 1, width: '29%' },
                        { targets: 2, width: '32%' },
                        { targets: 3, width: '19%' },
                        { targets: 4, width: '14%', className: 'starter-col-actions' }
                    );
                }

                const dataTableOptions = {
                    order: table.id === 'usersTable' ? [[1, 'asc']] : [[0, 'asc']],
                    columnDefs: columnDefs
                };

                if (table.id === 'usersTable') {
                    dataTableOptions.drawCallback = function () {
                        const api = this.api();
                        const pageInfo = api.page.info();

                        api.column(0, { page: 'current' }).nodes().each(function (cell, index) {
                            const number = cell.querySelector('[data-row-number]');

                            if (number) {
                                number.textContent = pageInfo.start + index + 1;
                            }
                        });

                        if (window.lucide) {
                            window.lucide.createIcons();
                        }
                    };
                }

                window.StarterKit.dataTable('#' + table.id, dataTableOptions);
            });
        },
        openModal: function (id) {
            const modal = document.getElementById(id);

            if (! modal) {
                return;
            }

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            requestAnimationFrame(function () {
                modal.querySelector('[data-starter-modal-backdrop]')?.classList.remove('opacity-0');
                modal.querySelector('[data-starter-modal-panel]')?.classList.remove('opacity-0', 'scale-95', 'translate-y-2');
            });
        },
        closeModal: function (modal) {
            if (! modal) {
                return;
            }

            modal.querySelector('[data-starter-modal-backdrop]')?.classList.add('opacity-0');
            modal.querySelector('[data-starter-modal-panel]')?.classList.add('opacity-0', 'scale-95', 'translate-y-2');

            setTimeout(function () {
                modal.classList.add('hidden');

                if (! document.querySelector('[data-starter-modal]:not(.hidden)')) {
                    document.body.classList.remove('overflow-hidden');
                }
            }, 160);
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

        const profile = document.querySelector('[data-starter-profile]');
        const profileButton = document.querySelector('[data-starter-profile-button]');
        const profileMenu = document.querySelector('[data-starter-profile-menu]');

        const closeProfileMenu = function () {
            profileMenu?.classList.add('hidden');
            profileButton?.setAttribute('aria-expanded', 'false');
        };

        profileButton?.addEventListener('click', function (event) {
            event.stopPropagation();
            profileMenu?.classList.toggle('hidden');
            profileButton.setAttribute('aria-expanded', profileMenu?.classList.contains('hidden') ? 'false' : 'true');
            lucide.createIcons();
        });

        document.addEventListener('click', function (event) {
            if (profile && ! profile.contains(event.target)) {
                closeProfileMenu();
            }
        });

        window.StarterKit.initDataTables();

        document.addEventListener('click', function (event) {
            const close = event.target.closest('[data-starter-modal-close]');
            const backdrop = event.target.closest('[data-starter-modal-backdrop]');

            if (close) {
                window.StarterKit.closeModal(close.closest('[data-starter-modal]'));
            }

            if (backdrop) {
                window.StarterKit.closeModal(backdrop.closest('[data-starter-modal]'));
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape') {
                return;
            }

            closeProfileMenu();

            document.querySelectorAll('[data-starter-modal]:not(.hidden)').forEach(function (modal) {
                window.StarterKit.closeModal(modal);
            });
        });

        @if (session('status'))
            window.StarterKit.toast('Berhasil', @json(session('status')));
        @endif
    });
</script>
