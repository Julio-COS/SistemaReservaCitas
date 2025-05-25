<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>
    </div>

</div>
</body>
<script>
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
</script>
</html>