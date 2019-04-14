<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
    <form id="editProfile" action="<?php echo base_url('vendor/profile/save'); ?>" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" value="<?php if(set_value('name')){ echo set_value('name'); }elseif(isset($vendorRow['name'])){ echo $vendorRow['name']; } ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php if(isset($vendorRow['email'])){ echo $vendorRow['email']; } ?>" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter mobile" name="mobile" id="mobile" value="<?php if(isset($vendorRow['mobile'])){ echo $vendorRow['mobile']; } ?>" readonly>
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
                                <input type="text" class="form-control" placeholder="Enter bank name" name="bank_name" id="bank_name" value="<?php if(set_value('bank_name')){ echo set_value('bank_name'); }elseif(isset($bankRow['bank_name'])){ echo $bankRow['bank_name']; } ?>">
                                <?php echo form_error('bank_name'); ?>
                            </div>
                            <?php $bankAccounts = getBankAccountTypes(); ?>
                            <div class="form-group">
                                <select class="form-control" name="bank_account_type" id="bank_account_type">
                                    <option value="">Select Account Type</option>
                                    <?php foreach($bankAccounts AS $key => $account): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($bankRow)){ if($bankRow['account_type'] == $key){ echo 'selected'; } } ?>><?php echo $account; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('bank_account_type'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter account no" name="account_no" id="account_no" value="<?php if(set_value('account_no')){ echo set_value('account_no'); }elseif(isset($bankRow['account_no'])){ echo $bankRow['account_no']; } ?>">
                                <?php echo form_error('account_no'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter ifsc code" name="ifsc_code" id="ifsc_code" value="<?php if(set_value('ifsc_code')){ echo set_value('ifsc_code'); }elseif(isset($bankRow['ifsc_code'])){ echo $bankRow['ifsc_code']; } ?>">
                                <?php echo form_error('ifsc_code'); ?>
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
                                <input type="text" class="form-control" placeholder="Enter company name" name="company_name" id="company_name" value="<?php if(set_value('company_name')){ echo set_value('company_name'); }elseif(isset($vendorRow['company_name'])){ echo $vendorRow['company_name']; } ?>">
                                <?php echo form_error('company_name'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter billing/company address" name="billing_address" id="billing_address" value="<?php if(set_value('billing_address')){ echo set_value('billing_address'); }elseif(isset($vendorRow['billing_address'])){ echo $vendorRow['billing_address']; } ?>">
                                <?php echo form_error('billing_address'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter latitude" name="latitude" id="latitude" value="<?php if(set_value('latitude')){ echo set_value('latitude'); }elseif(isset($vendorRow['latitude'])){ echo $vendorRow['latitude']; } ?>">
                                <?php echo form_error('latitude'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter longitude" name="longitude" id="longitude" value="<?php if(set_value('longitude')){ echo set_value('longitude'); }elseif(isset($vendorRow['longitude'])){ echo $vendorRow['longitude']; } ?>">
                                <?php echo form_error('longitude'); ?>
                            </div>
                            <?php $domainTypes = getDomainTypes(); ?>
                            <div class="form-group">
                                <select class="form-control" name="domain_type" id="domain_type">
                                    <option value="">Select Domain Type</option>
                                    <?php foreach($domainTypes AS $key => $type): ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($vendorRow)){ if($vendorRow['domain_type'] == $key){ echo 'selected'; } } ?>><?php echo $type; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('domain_type'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter GST No" name="gst_no" id="gst_no" value="<?php if(set_value('gst_no')){ echo set_value('gst_no'); }elseif(isset($vendorRow['gst_no'])){ echo $vendorRow['gst_no']; } ?>">
                                <?php echo form_error('gst_no'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Pan No" name="pan_no" id="pan_no" value="<?php if(set_value('pan_no')){ echo set_value('pan_no'); }elseif(isset($vendorRow['pan_no'])){ echo $vendorRow['pan_no']; } ?>">
                                <?php echo form_error('pan_no'); ?>
                            </div>
                            <div class="form-group">
                                <label>Select Licence copy</label>
                                <input type="file" class="form-control" placeholder="Select Licence copy" name="licence_copy" id="licence_copy" accept=".png,.jpg,.jpeg,.pdf">
                            </div>
                            <div class="form-group">
                                <label>Select Incorporation certification</label>
                                <input type="file" class="form-control" placeholder="Select Incorporation certification" name="incorporation_copy" id="incorporation_copy" accept=".png,.jpg,.jpeg,.pdf">
                            </div>
                            <?php if(isset($vendorRow['licence_copy_file']) && !empty($vendorRow['licence_copy_file'])): ?>
                            <div class="form-group">
                                <a target="_blank" href="<?php echo base_url('uploads/vendor/'.$vendorRow['licence_copy_file']); ?>">View Licence Copy</a>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($vendorRow['incorporation_certification_file']) && !empty($vendorRow['incorporation_certification_file'])): ?>
                            <div class="form-group">
                                <a target="_blank" href="<?php echo base_url('uploads/vendor/'.$vendorRow['incorporation_certification_file']); ?>">View Incorporation certification</a>
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