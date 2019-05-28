</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo PROJECT_NAME; ?> 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('admin/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url('admin'); ?>';
</script>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/admin/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/jquery.validate.js"></script>
<script src="<?php echo base_url('assets/admin/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/admin/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/admin/'); ?>js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url('assets/admin/'); ?>js/common.js"></script>
<script src="<?php echo base_url('assets/admin/'); ?>js/validation-forms.js"></script>
<script>
    $('#filter_button').on('click', function () {
        var keyWord = encodeURI($('#key_word').val());
        var status = encodeURI($('#status').val());
        if (status == '') {
            status = 0;
        }
        var offset = $('#offset').val();
        var url = $('#url').val();
        window.location.href = url + keyWord + '/' + status + '/' + offset;
    });
</script>
</body>

</html>