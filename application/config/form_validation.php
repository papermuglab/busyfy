<?php
/*
 * 1. registration
 * 2. login
 * 3. change_password
 * 4. admin_edit_profile
 * 5. vendor_edit_profile
 * 6. admin_vendor_add_profile
 * 7. admin_vendor_edit_profile
 * 8. 
 * 9. 
 * 10.  
 */
$config = array(
    'registration' => array(
        array(
            'field' => 'owner_name',
            'label' => 'Owner name',
            'rules' => 'required|trim|alpha_numeric_spaces'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|is_unique['.TBL_VENDORS.'.email]|valid_email'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|is_unique['.TBL_VENDORS.'.mobile]|integer'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'residential_address',
            'label' => 'Residential address',
            'rules' => 'required'
        ),
        array(
            'field' => 'company_name',
            'label' => 'Company name',
            'rules' => 'required|alpha_numeric_spaces|trim'
        ),
        array(
            'field' => 'domain_type',
            'label' => 'Domain type',
            'rules' => 'required'
        ),
        array(
            'field' => 'billing_address',
            'label' => 'Billing address',
            'rules' => 'required'
        ),
        array(
            'field' => 'bank_name',
            'label' => 'Bank name',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_type',
            'label' => 'Account type',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_no',
            'label' => 'Account no',
            'rules' => 'required'
        ),
        array(
            'field' => 'ifsc_code',
            'label' => 'IFSC code',
            'rules' => 'required'
        ),
        array(
            'field' => 'gst_no',
            'label' => 'GST no',
            'rules' => 'required|is_unique['.TBL_VENDOR_COMPANY_DETAILS.'.gst_no]'
        ),
        array(
            'field' => 'pan_no',
            'label' => 'PAN no',
            'rules' => 'required|is_unique['.TBL_VENDOR_COMPANY_DETAILS.'.pan_no]'
        ),
        array(
            'field' => 'tin_no',
            'label' => 'TIN no',
            'rules' => 'required|is_unique['.TBL_VENDOR_COMPANY_DETAILS.'.tin_no]'
        ),
        array(
            'field' => 'service_tax_id',
            'label' => 'Service tax id',
            'rules' => 'required|is_unique['.TBL_VENDOR_COMPANY_DETAILS.'.service_tax_id]'
        ),
        array(
            'field' => 'gst_doc',
            'label' => 'GST document',
            'rules' => 'callback_checkGST'
        ),
        array(
            'field' => 'pan_doc',
            'label' => 'PAN document',
            'rules' => 'callback_checkPan'
        ),
        array(
            'field' => 'tin_doc',
            'label' => 'TIN document',
            'rules' => 'callback_checkTIN'
        ),
        array(
            'field' => 'service_tax_doc',
            'label' => 'Service tax document',
            'rules' => 'callback_checkServiceTax'
        ),
        array(
            'field' => 'logo',
            'label' => 'Logo',
            'rules' => 'callback_checkLogo'
        )
    ),
    'vendor_edit_profile' => array(
        array(
            'field' => 'owner_name',
            'label' => 'Owner name',
            'rules' => 'required|trim|alpha_numeric_spaces'
        ),
        array(
            'field' => 'residential_address',
            'label' => 'Residential address',
            'rules' => 'required'
        ),
        array(
            'field' => 'company_name',
            'label' => 'Company name',
            'rules' => 'required|alpha_numeric_spaces|trim'
        ),
        array(
            'field' => 'domain_type',
            'label' => 'Domain type',
            'rules' => 'required'
        ),
        array(
            'field' => 'billing_address',
            'label' => 'Billing address',
            'rules' => 'required'
        ),
        array(
            'field' => 'bank_name',
            'label' => 'Bank name',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_type',
            'label' => 'Account type',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_no',
            'label' => 'Account no',
            'rules' => 'required'
        ),
        array(
            'field' => 'ifsc_code',
            'label' => 'IFSC code',
            'rules' => 'required'
        ),
        array(
            'field' => 'gst_no',
            'label' => 'GST no',
            'rules' => 'required|callback_checkGSTNOUniqueness'
        ),
        array(
            'field' => 'pan_no',
            'label' => 'PAN no',
            'rules' => 'required|callback_checkPANNOUniqueness'
        ),
        array(
            'field' => 'tin_no',
            'label' => 'TIN no',
            'rules' => 'required|callback_checkTINNOUniqueness'
        ),
        array(
            'field' => 'service_tax_id',
            'label' => 'Service tax id',
            'rules' => 'required|callback_checkServiceTaxNOUniqueness'
        ),
        array(
            'field' => 'gst_doc',
            'label' => 'GST document',
            'rules' => 'callback_checkGST'
        ),
        array(
            'field' => 'pan_doc',
            'label' => 'PAN document',
            'rules' => 'callback_checkPan'
        ),
        array(
            'field' => 'tin_doc',
            'label' => 'TIN document',
            'rules' => 'callback_checkTIN'
        ),
        array(
            'field' => 'service_tax_doc',
            'label' => 'Service tax document',
            'rules' => 'callback_checkServiceTax'
        )
    ),
    'login' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|trim'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),
    'change_password' => array(
        array(
            'field' => 'old_password',
            'label' => 'Old Password',
            'rules' => 'required|trim|min_length[5]|max_length[20]'
        ),
        array(
            'field' => 'new_password',
            'label' => 'New Password',
            'rules' => 'required|trim|min_length[5]|max_length[20]'
        ),
        array(
            'field' => 're_type_password',
            'label' => 'Re-type New Password',
            'rules' => 'required|trim|matches[new_password]'
        )
    ),
    'admin_edit_profile' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
         array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email'
        )
    ),
    'admin_vendor_add_profile' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|trim|number|exact_length[10]'
        ),
        array(
            'field' => 'company_name',
            'label' => 'Company Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'bank_name',
            'label' => 'Bank Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'bank_account_type',
            'label' => 'Bank account type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'account_no',
            'label' => 'Account No',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'ifsc_code',
            'label' => 'IFSC Code',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'billing_address',
            'label' => 'Billing Address',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'latitude',
            'label' => 'Latitude',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'longitude',
            'label' => 'Longitude',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'domain_type',
            'label' => 'Domain Type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'gst_no',
            'label' => 'GST No',
            'rules' => 'required|trim|is_unique['.TBL_VENDORS.'].gst_no'
        ),
        array(
            'field' => 'pan_no',
            'label' => 'PAN No',
            'rules' => 'required|trim|is_unique['.TBL_VENDORS.'].pan_no'
        )
    ),
    'admin_vendor_edit_profile' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'company_name',
            'label' => 'Company Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'bank_name',
            'label' => 'Bank Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'bank_account_type',
            'label' => 'Bank account type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'account_no',
            'label' => 'Account No',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'ifsc_code',
            'label' => 'IFSC Code',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'billing_address',
            'label' => 'Billing Address',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'latitude',
            'label' => 'Latitude',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'longitude',
            'label' => 'Longitude',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'domain_type',
            'label' => 'Domain Type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'gst_no',
            'label' => 'GST No',
            'rules' => 'required|trim|callback_isUniqueGSTNo'
        ),
        array(
            'field' => 'pan_no',
            'label' => 'PAN No',
            'rules' => 'required|trim|callback_isUniquePANNo'
        )
    ),
    'vendor_add_staff' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|callback_checkEmailUniqueness'
        ),
        array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|trim|exact_length[10]|integer|callback_checkMobileUniqueness'
        )
    ),
    'vendor_add_product' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|trim|min_length[2]|max_length[200]'
        ),
        array(
            'field' => 'sku',
            'label' => 'SKU',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'type',
            'label' => 'Type',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'cost',
            'label' => 'Cost',
            'rules' => 'required|trim'
        )
    ),
    'admin_add_vendor' => array(
        array(
            'field' => 'owner_name',
            'label' => 'Owner name',
            'rules' => 'required|trim|alpha_numeric_spaces'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|callback_checkEmailUniqueness|valid_email'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|callback_checkMobileUniqueness|integer'
        ),
        array(
            'field' => 'residential_address',
            'label' => 'Residential address',
            'rules' => 'required'
        ),
        array(
            'field' => 'company_name',
            'label' => 'Company name',
            'rules' => 'required|alpha_numeric_spaces|trim'
        ),
        array(
            'field' => 'domain_type',
            'label' => 'Domain type',
            'rules' => 'required'
        ),
        array(
            'field' => 'billing_address',
            'label' => 'Billing address',
            'rules' => 'required'
        ),
        array(
            'field' => 'bank_name',
            'label' => 'Bank name',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_type',
            'label' => 'Account type',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_no',
            'label' => 'Account no',
            'rules' => 'required'
        ),
        array(
            'field' => 'ifsc_code',
            'label' => 'IFSC code',
            'rules' => 'required'
        ),
        array(
            'field' => 'gst_no',
            'label' => 'GST no',
            'rules' => 'required|callback_checkGSTNOUniqueness'
        ),
        array(
            'field' => 'pan_no',
            'label' => 'PAN no',
            'rules' => 'required|callback_checkPANNOUniqueness'
        ),
        array(
            'field' => 'tin_no',
            'label' => 'TIN no',
            'rules' => 'required|callback_checkTINNOUniqueness'
        ),
        array(
            'field' => 'service_tax_id',
            'label' => 'Service tax id',
            'rules' => 'required|callback_checkServiceTaxNOUniqueness'
        ),
        array(
            'field' => 'gst_doc',
            'label' => 'GST document',
            'rules' => 'callback_checkGST'
        ),
        array(
            'field' => 'pan_doc',
            'label' => 'PAN document',
            'rules' => 'callback_checkPan'
        ),
        array(
            'field' => 'tin_doc',
            'label' => 'TIN document',
            'rules' => 'callback_checkTIN'
        ),
        array(
            'field' => 'service_tax_doc',
            'label' => 'Service tax document',
            'rules' => 'callback_checkServiceTax'
        )
    ),
    'ca_edit_vendor' => array(
        array(
            'field' => 'owner_name',
            'label' => 'Owner name',
            'rules' => 'required|trim|alpha_numeric_spaces'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|callback_checkEmailUniqueness|valid_email'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|callback_checkMobileUniqueness|integer'
        ),
        array(
            'field' => 'residential_address',
            'label' => 'Residential address',
            'rules' => 'required'
        ),
        array(
            'field' => 'company_name',
            'label' => 'Company name',
            'rules' => 'required|alpha_numeric_spaces|trim'
        ),
        array(
            'field' => 'domain_type',
            'label' => 'Domain type',
            'rules' => 'required'
        ),
        array(
            'field' => 'billing_address',
            'label' => 'Billing address',
            'rules' => 'required'
        ),
        array(
            'field' => 'bank_name',
            'label' => 'Bank name',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_type',
            'label' => 'Account type',
            'rules' => 'required'
        ),
        array(
            'field' => 'account_no',
            'label' => 'Account no',
            'rules' => 'required'
        ),
        array(
            'field' => 'ifsc_code',
            'label' => 'IFSC code',
            'rules' => 'required'
        ),
        array(
            'field' => 'gst_no',
            'label' => 'GST no',
            'rules' => 'required|callback_checkGSTNOUniqueness'
        ),
        array(
            'field' => 'pan_no',
            'label' => 'PAN no',
            'rules' => 'required|callback_checkPANNOUniqueness'
        ),
        array(
            'field' => 'tin_no',
            'label' => 'TIN no',
            'rules' => 'required|callback_checkTINNOUniqueness'
        ),
        array(
            'field' => 'service_tax_id',
            'label' => 'Service tax id',
            'rules' => 'required|callback_checkServiceTaxNOUniqueness'
        ),
        array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required'
        )
    ),
    'error_prefix' => '<span style="color:red">',
    'error_suffix' => '</span>'
);
