    </div>
  </div>
</div>
<script>
  (function () {
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('sidebarOverlay');
    var toggle = document.getElementById('menuToggle');
    if (!sidebar || !overlay || !toggle) return;
    function close() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }
    toggle.addEventListener('click', function () {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('open');
    });
    overlay.addEventListener('click', close);
  })();
</script>
</body>
</html>
