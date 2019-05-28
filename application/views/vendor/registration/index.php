<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo PROJECT_NAME . ' - Registration'; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h2 class="text-center"><?php echo PROJECT_NAME; ?> - Vendor Registration</h2>
            <form method="POST" action="<?php echo base_url('registration/save'); ?>" enctype="multipart/form-data" autocomplete="off">
                <h3>Personal Details</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Owner Name</label>
                        <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Owner name" value="<?php if(set_value('owner_name')){ echo set_value('owner_name'); } ?>">
                        <?php echo form_error('owner_name'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php if(set_value('email')){ echo set_value('email'); } ?>">
                        <?php echo form_error('email'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Mobile</label>
                        <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php if(set_value('mobile')){ echo set_value('mobile'); } ?>">
                        <?php echo form_error('mobile'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" name='password' id="inputPassword4" placeholder="Password">
                        <?php echo form_error('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label for="inputAddress">Residential Address</label>
                        <input type="text" class="form-control" name="residential_address" id="residential_address" placeholder="Residential Address" value="<?php if(set_value('residential_address')){ echo set_value('residential_address'); } ?>">
                        <?php echo form_error('residential_address'); ?>
                    </div>
                </div>
                <h3>Company Details</h3>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputCity">Company Name</label>
                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="<?php if(set_value('company_name')){ echo set_value('company_name'); } ?>">
                        <?php echo form_error('company_name'); ?>
                    </div>
                    <?php $domainTypes = getDomainTypes(); ?>
                    <div class="form-group col-md-4">
                        <label for="inputState">Select Domain Type</label>
                        <select id="domain_type" name="domain_type" class="form-control">
                            <option value="">Select</option>
                            <?php foreach ($domainTypes AS $key => $value): ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('domain_type')){ if(set_value('domain_type') == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('domain_type'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputCity">Billing/Company Address</label>
                        <input type="text" class="form-control" name="billing_address" id="billing_address" placeholder="Billing/Company Address" value="<?php if(set_value('billing_address')){ echo set_value('billing_address'); } ?>">
                        <?php echo form_error('billing_address'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Latitude (Company Location)</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php if(set_value('latitude')){ echo set_value('latitude'); } ?>">
                        <?php echo form_error('latitude'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Logitude (Company Location)</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php if(set_value('longitude')){ echo set_value('longitude'); } ?>">
                        <?php echo form_error('longitude'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">GST No</label>
                        <input type="text" class="form-control" name="gst_no" id="gst_no" placeholder="GST No" value="<?php if(set_value('gst_no')){ echo set_value('gst_no'); } ?>">
                        <?php echo form_error('gst_no'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Upload GST Document</label>
                        <input type="file" class="form-control" name="gst_doc" id="gst_doc" accept=".png,.jpg,.jpeg,.pdf">
                        <?php echo form_error('gst_doc'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">PAN No</label>
                        <input type="text" class="form-control" name="pan_no" id="pan_no" placeholder="PAN No" value="<?php if(set_value('pan_no')){ echo set_value('pan_no'); } ?>">
                        <?php echo form_error('pan_no'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Upload PAN Document</label>
                        <input type="file" class="form-control" name="pan_doc" id="pan_doc" accept=".png,.jpg,.jpeg,.pdf">
                        <?php echo form_error('pan_doc'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">TIN No(Taxpayer Identification Number)</label>
                        <input type="text" class="form-control" name="tin_no" id="tin_no" placeholder="TIN No(Taxpayer Identification Number)" value="<?php if(set_value('tin_no')){ echo set_value('tin_no'); } ?>">
                        <?php echo form_error('tin_no'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Upload TIN Document</label>
                        <input type="file" class="form-control" name="tin_doc" id="tin_doc" accept=".png,.jpg,.jpeg,.pdf">
                        <?php echo form_error('tin_doc'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Service Tax ID</label>
                        <input type="text" class="form-control" name="service_tax_id" id="service_tax_id" placeholder="Service Tax ID" value="<?php if(set_value('service_tax_id')){ echo set_value('service_tax_id'); } ?>">
                        <?php echo form_error('service_tax_id'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Upload Service Tax ID Document</label>
                        <input type="file" class="form-control" name="service_tax_doc" id="service_tax_doc" accept=".png,.jpg,.jpeg,.pdf">
                        <?php echo form_error('service_tax_doc'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputPassword4">Upload Company Logo</label>
                        <input type="file" class="form-control" name="logo" id="logo" accept=".png,.jpg,.jpeg">
                        <?php echo form_error('logo'); ?>
                    </div>
                </div>
                <h3>Bank Details</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="<?php if(set_value('bank_name')){ echo set_value('bank_name'); } ?>">
                        <?php echo form_error('bank_name'); ?>
                    </div>
                    <?php $accountTypes = getBankAccountTypes(); ?>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Select Account Type</label>
                        <select name="account_type" id="account_type" class="form-control">
                            <option value="">Select</option>
                            <?php foreach ($accountTypes AS $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php if(set_value('account_type')){ if(set_value('account_type') == $key){ echo 'selected'; } } ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('account_type'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Account No</label>
                        <input type="number" class="form-control" name="account_no" id="account_no" placeholder="Account No" value="<?php if(set_value('account_no')){ echo set_value('account_no'); } ?>">
                        <?php echo form_error('account_no'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">IFSC Code</label>
                        <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code" value="<?php if(set_value('ifsc_code')){ echo set_value('ifsc_code'); } ?>">
                        <?php echo form_error('ifsc_code'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Register me</button>
            </form>
        </div>

    </body>
</html>
