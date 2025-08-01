 <footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025. Notix</span>
  </div>
</footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('../../assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('../../assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('../../assets/js/template.js') }}"></script>
    <script src="{{ asset('../../assets/js/settings.js') }}"></script>
    <script src="{{ asset('../../assets/js/todolist.js') }}"></script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault();

            fetch("{{ route('logout') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = "/"; // logoutdan keyin qayerga yuborish
                } else {
                    alert("Logoutda xatolik yuz berdi");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>

    @stack('scripts')
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
  </body>
</html>
