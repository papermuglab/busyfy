<?php

$config = array(
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
    'vendor_edit_profile' => array(
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
    'error_prefix' => '<span style="color:red">',
    'error_suffix' => '</span>'
);
