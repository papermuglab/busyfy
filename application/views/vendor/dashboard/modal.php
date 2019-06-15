<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Account update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if ($status == '0'): ?>
                    <p>You're account is still under review.</p>
                <?php elseif ($status == '2'): ?>
                    <p>You're account has found some issue so please review the comment by CA and update your profile.</p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('vendor/profile'); ?>" class="btn btn-primary">Profile</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>