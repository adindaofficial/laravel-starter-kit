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
