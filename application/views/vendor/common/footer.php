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
    var base_url = '<?php echo base_url('vendor'); ?>';
</script>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/vendor/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/vendor/'); ?>js/jquery.datetimepicker.full.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/vendor/js/jquery.validate.js"></script>
<script src="<?php echo base_url('assets/vendor/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/vendor/'); ?>js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url('assets/vendor/'); ?>js/common.js"></script>
<script src="<?php echo base_url('assets/vendor/'); ?>js/validation-forms.js"></script>
<script>
    jQuery.datetimepicker.setLocale('en');
    jQuery('#datetimepicker').datetimepicker({
	format:'Y-m-d H:i'
    });
    function showDocument(documentURL) {
        $('#uploadedDocument').attr('src', documentURL);
        $('#viewDoc').modal('show');
    }
    $('#filter_button').on('click', function () {
        var keyWord = $('#key_word').val() != '' ? encodeURI($('#key_word').val()) : 0;
        var status = encodeURI($('#status').val());
        var url = $('#url').val();
        window.location.href = url + keyWord + '/' + status;
    });
    $('#task_vendor_id').on('change', function(){
        var vendorID = $(this).val();
        $.get(base_url + '/task/getData', {vendorID: vendorID}, function(data){
            var result = JSON.parse(data);
            $('#single_cost').val('');
            $('#total_cost').val('');
            $('#product_id').empty().append('<option value="">Select Product</option>');
            $('#staff_id').empty().append('<option value="">Select Staff member</option>');
            $.each(result['products'], function(index, value){
                $('#product_id').append('<option value="'+value['id']+'">'+value['name']+'</option>');
            });
            $.each(result['staff'], function(index, value){
                $('#staff_id').append('<option value="'+value['id']+'">'+value['name']+'</option>');
            });
        });
    });
    $('#product_id').on('change', function(){
        var productID = $(this).val();
        $.get(base_url + '/product/getProductPrice', {productID: productID}, function(data){
            $('#single_cost').val(data);
        });
    });
    $('#quantity').on('keyup', function(){
        var cost = parseFloat($('#single_cost').val());
        var quantity = parseInt($(this).val());
        var total = cost * quantity;
        if (!isNaN(total)) {
            $('#total_cost').val(cost * quantity);
        }
    });
    <?php if(isset($status)): ?>
        $('#accountModal').modal('show');
    <?php endif; ?>
</script>
</body>

</html>