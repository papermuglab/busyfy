<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Vendor Management - <?php echo isset($vendor) ? 'Edit' : 'Add'; ?></h1>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <form id="editProfile" action="<?php echo base_url('admin/vendor/save'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="vendor_id" id="vendor_id" value="<?php if(isset($vendor)){ echo $vendor['vendor_id']; } ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#personalDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="personalDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Personal Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="personalDetails">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter owner name" name="owner_name" id="owner_name" value="<?php if(set_value('owner_name')){ echo set_value('owner_name'); }elseif(isset($vendor['owner_name'])){ echo $vendor['owner_name']; } ?>">
                                <?php echo form_error('owner_name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php if(isset($vendor['email'])){ echo $vendor['email']; } ?>" <?php if(isset($vendor['email'])){ echo 'readonly'; } ?>>
                                <?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile" value="<?php if(isset($vendor['mobile'])){ echo $vendor['mobile']; } ?>" <?php if(isset($vendor['mobile'])){ echo 'readonly'; } ?>>
                                <?php echo form_error('mobile'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter residential address" name="residential_address" id="mobile" value="<?php if(set_value('residential_address')){ echo set_value('residential_address'); }elseif(isset($vendor['residential_address'])){ echo $vendor['residential_address']; } ?>">
                                <?php echo form_error('residential_address'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#bankDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="bankDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Bank Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="bankDetails">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter bank name" name="bank_name" id="bank_name" value="<?php if(set_value('bank_name')){ echo set_value('bank_name'); }elseif(isset($bank['bank_name'])){ echo $bank['bank_name']; } ?>">
                                <?php echo form_error('bank_name'); ?>
                            </div>
                            <?php $bankAccounts = getBankAccountTypes(); ?>
                            <div class="form-group">
                                <select class="form-control" name="account_type" id="bank_account_type">
                                    <option value="">Select Account Type</option>
                                    <?php foreach($bankAccounts AS $key => $account): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($bank)){ if($bank['account_type'] == $key){ echo 'selected'; } } ?>><?php echo $account; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('account_type'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter account no" name="account_no" id="account_no" value="<?php if(set_value('account_no')){ echo set_value('account_no'); }elseif(isset($bank['account_no'])){ echo $bank['account_no']; } ?>">
                                <?php echo form_error('account_no'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter ifsc code" name="ifsc_code" id="ifsc_code" value="<?php if(set_value('ifsc_code')){ echo set_value('ifsc_code'); }elseif(isset($bank['ifsc_code'])){ echo $bank['ifsc_code']; } ?>">
                                <?php echo form_error('ifsc_code'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#caFeedback" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="caFeedback">
                        <h6 class="m-0 font-weight-bold text-primary">CA Feedback</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="caFeedback">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter feedback comment" name="comment" id="comment" value="<?php if(set_value('comment')){ echo set_value('comment'); }elseif(isset($company['comment'])){ echo $company['comment']; } ?>">
                                <?php echo form_error('comment'); ?>
                            </div>
                            <?php $accountTypes = getAccountStatus(); ?>
                            <div class="form-group">
                                <select class="form-control" name="status" id="status">
                                    <option value="">Select Account Type</option>
                                    <?php foreach($accountTypes AS $key => $account): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($vendor)){ if($vendor['status'] == $key){ echo 'selected'; } } ?>><?php echo $account; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('status'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#companyDetails" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="companyDetails">
                        <h6 class="m-0 font-weight-bold text-primary">Company Details</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="companyDetails">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter company name" name="company_name" id="company_name" value="<?php if(set_value('company_name')){ echo set_value('company_name'); }elseif(isset($vendor['company_name'])){ echo $vendor['company_name']; } ?>">
                                <?php echo form_error('company_name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter billing/company address" name="billing_address" id="billing_address" value="<?php if(set_value('billing_address')){ echo set_value('billing_address'); }elseif(isset($vendor['billing_address'])){ echo $vendor['billing_address']; } ?>">
                                <?php echo form_error('billing_address'); ?>
                            </div>
                            <?php $domainTypes = getDomainTypes(); ?>
                            <div class="form-group">
                                <select class="form-control" name="domain_type" id="domain_type">
                                    <option value="">Select Domain Type</option>
                                    <?php foreach($domainTypes AS $key => $type): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($vendor)){ if($vendor['domain_type'] == $key){ echo 'selected'; } } ?>><?php echo $type; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('domain_type'); ?>
                            </div>
                            <div class="form-group">
                                <label>GST No</label>
                                <input type="text" class="form-control" placeholder="Enter GST No" name="gst_no" id="gst_no" value="<?php if(set_value('gst_no')){ echo set_value('gst_no'); }elseif(isset($company['gst_no'])){ echo $company['gst_no']; } ?>">
                                <?php echo form_error('gst_no'); ?>
                            </div>
                            <div class="form-group">
                                <label>GST No Verified?</label>
                                <div class="form-check form-check-inline">
                                    <input name="gst_verified" class="form-check-input" type="radio" value="1" <?php if(isset($company)){ if($company['gst_verified'] == 1){ echo 'checked'; } } ?>>
                                    <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="gst_verified" class="form-check-input" type="radio" value="0" <?php if(isset($company)){ if($company['gst_verified'] == 0){ echo 'checked'; } }else{ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="inlineCheckbox2">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>GST No Comment (IF GST No have some issue.)</label>
                                <input type="text" class="form-control" placeholder="Enter GST No Comment" name="gst_comment" id="gst_comment" value="<?php if(set_value('gst_comment')){ echo set_value('gst_comment'); }elseif(isset($company['gst_comment'])){ echo $company['gst_comment']; } ?>">
                                <?php echo form_error('gst_comment'); ?>
                            </div>
                            <?php if(isset($company['gst_doc']) && !empty($company['gst_doc'])): ?>
                            <div class="form-group">
                                <a onclick="showDocument('<?php echo base_url('uploads/gst/'.$company['gst_doc']); ?>')" href="javascript:void(0)">View GST document</a>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>PAN No</label>
                                <input type="text" class="form-control" placeholder="Enter Pan No" name="pan_no" id="pan_no" value="<?php if(set_value('pan_no')){ echo set_value('pan_no'); }elseif(isset($company['pan_no'])){ echo $company['pan_no']; } ?>">
                                <?php echo form_error('pan_no'); ?>
                            </div>
                            <div class="form-group">
                                <label>PAN No Verified?</label>
                                <div class="form-check form-check-inline">
                                    <input name="pan_verified" class="form-check-input" type="radio" value="1" <?php if(isset($company)){ if($company['pan_verified'] == 1){ echo 'checked'; } } ?>>
                                    <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="pan_verified" class="form-check-input" type="radio" value="0" <?php if(isset($company)){ if($company['pan_verified'] == 0){ echo 'checked'; } }else{ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="inlineCheckbox2">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>PAN No Comment (IF PAN No have some issue.)</label>
                                <input type="text" class="form-control" placeholder="Enter PAN No Comment" name="pan_comment" id="pan_comment" value="<?php if(set_value('pan_comment')){ echo set_value('pan_comment'); }elseif(isset($company['pan_comment'])){ echo $company['pan_comment']; } ?>">
                                <?php echo form_error('pan_comment'); ?>
                            </div>
                            <?php if(isset($company['pan_doc']) && !empty($company['pan_doc'])): ?>
                            <div class="form-group">
                                <a onclick="showDocument('<?php echo base_url('uploads/pan/'.$company['pan_doc']); ?>')" href="javascript:void(0)">View PAN document</a>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>TIN No</label>
                                <input type="text" class="form-control" placeholder="Enter TIN No" name="tin_no" id="tin_no" value="<?php if(set_value('tin_no')){ echo set_value('tin_no'); }elseif(isset($company['tin_no'])){ echo $company['tin_no']; } ?>">
                                <?php echo form_error('tin_no'); ?>
                            </div>
                            <div class="form-group">
                                <label>TIN No Verified?</label>
                                <div class="form-check form-check-inline">
                                    <input name="tin_verified" class="form-check-input" type="radio" value="1" <?php if(isset($company)){ if($company['tin_verified'] == 1){ echo 'checked'; } } ?>>
                                    <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="tin_verified" class="form-check-input" type="radio" value="0" <?php if(isset($company)){ if($company['tin_verified'] == 0){ echo 'checked'; } }else{ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="inlineCheckbox2">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>TIN No Comment (IF TIN No have some issue.)</label>
                                <input type="text" class="form-control" placeholder="Enter TIN No Comment" name="tin_comment" id="tin_comment" value="<?php if(set_value('tin_comment')){ echo set_value('tin_comment'); }elseif(isset($company['tin_comment'])){ echo $company['tin_comment']; } ?>">
                                <?php echo form_error('tin_comment'); ?>
                            </div>
                            <?php if(isset($company['tin_doc']) && !empty($company['tin_doc'])): ?>
                            <div class="form-group">
                                <a onclick="showDocument('<?php echo base_url('uploads/tin/'.$company['tin_doc']); ?>')" href="javascript:void(0)">View TIN document</a>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Service tax ID</label>
                                <input type="text" class="form-control" placeholder="Enter Service tax ID" name="service_tax_id" id="service_tax_id" value="<?php if(set_value('service_tax_id')){ echo set_value('service_tax_id'); }elseif(isset($company['service_tax_id'])){ echo $company['service_tax_id']; } ?>">
                                <?php echo form_error('service_tax_id'); ?>
                            </div>
                            <div class="form-group">
                                <label>Service tax ID Verified?</label>
                                <div class="form-check form-check-inline">
                                    <input name="service_tax_id_verified" class="form-check-input" type="radio" value="1" <?php if(isset($company)){ if($company['service_tax_id_verified'] == 1){ echo 'checked'; } } ?>>
                                    <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="service_tax_id_verified" class="form-check-input" type="radio" value="0" <?php if(isset($company)){ if($company['service_tax_id_verified'] == 0){ echo 'checked'; } }else{ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="inlineCheckbox2">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Service tax ID Comment (IF Service tax ID have some issue.)</label>
                                <input type="text" class="form-control" placeholder="Enter Service tax ID Comment" name="service_tax_id_comment" id="service_tax_id_comment" value="<?php if(set_value('service_tax_id_comment')){ echo set_value('service_tax_id_comment'); }elseif(isset($company['service_tax_id_comment'])){ echo $company['service_tax_id_comment']; } ?>">
                                <?php echo form_error('service_tax_id_comment'); ?>
                            </div>
                            <?php if(isset($company['service_tax_doc']) && !empty($company['service_tax_doc'])): ?>
                            <div class="form-group">
                                <a onclick="showDocument('<?php echo base_url('uploads/service_tax/'.$company['service_tax_doc']); ?>')" href="javascript:void(0)">View Service tax document</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <a href="#" class="btn btn-primary btn-icon-split" onclick="history.back();">
                            <span class="text">Cancel</span>
                        </a>
                        <button class="btn btn-success btn-icon-split" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Save</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->
<?php $this->view('admin/vendor/view-file-modal'); ?>