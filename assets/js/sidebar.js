    const toggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
    });

    document.querySelectorAll('.has-children').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.stopPropagation();
            const nextUl = this.querySelector('.nested');
            const toggle = this.querySelector('.toggle-btn');
            if (nextUl) {
                nextUl.classList.toggle('show');
                toggle.textContent = nextUl.classList.contains('show') ? '-' : '+';
            }
        });
    });