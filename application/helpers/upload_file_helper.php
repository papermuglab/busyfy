<?php

function uploadProfile($product_id, $files) {
    $CI = & get_instance();
    $config = array(
        'upload_path' => 'uploads/product/',
        'allowed_types' => 'jpg|gif|png|jpeg',
        'overwrite' => 1,
    );

    $CI->load->library('upload', $config);
    foreach ($files['name'] as $key => $image) {
        $_FILES['images[]']['name'] = $files['name'][$key];
        $_FILES['images[]']['type'] = $files['type'][$key];
        $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
        $_FILES['images[]']['error'] = $files['error'][$key];
        $_FILES['images[]']['size'] = $files['size'][$key];
        $rand = mt_rand(10, 99);
        $name = date('YmdHis') . $rand;
        $fileName = $name . '_' . $image;

        $images[] = $fileName;

        $config['file_name'] = $fileName;
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('images[]')) {
            $response = $CI->upload->data();
            $params['image_name'] = $response['file_name'];
            $params['product_id'] = $product_id;
            $CI->dml->insert(TBL_PRODUCT_IMAGES, $params);
        }
    }
    return true;
}

function uploadFile($filename, $filePath) {
    $CI = & get_instance();
    $rand = mt_rand(10, 99);
    $config = array(
        'upload_path' => 'uploads/' . $filePath,
        'allowed_types' => 'jpg|png|jpeg|pdf',
        'overwrite' => 1,
        'file_name' => date('YmdHis') . $rand
    );

    $CI->load->library('upload');
    $CI->upload->initialize($config);
    if (!$CI->upload->do_upload($filename)) {
        return $CI->upload->display_errors();
    } else {
        $upload_data = $CI->upload->data();
    }
    return $upload_data['file_name'];
}

function resize($fileName, $path, $type) {
    $height = $width = '';
    if ($type == 1) {
        $height = 500;
        $width = 500;
    } else {
        $height = 200;
        $width = 600;
    }
    $CI = & get_instance();
    $CI->load->library('image_lib');
    $configone['image_library'] = 'gd2';
    $configone['source_image'] = 'uploads/' . $path . $fileName;
    $configone['create_thumb'] = FALSE;
    $configone['maintain_ratio'] = TRUE;
    $configone['width'] = $width;
    $configone['height'] = $height;
    $CI->image_lib->initialize($configone);
    $CI->image_lib->resize();
    //cropping
    $configcrop['image_library'] = 'gd2';
    $configcrop['source_image'] = 'uploads/' . $path . $fileName;
    $configcrop['create_thumb'] = FALSE;
    $configcrop['maintain_ratio'] = FALSE;
    $configcrop['height'] = $height;
    $configcrop['width'] = $width;
    $CI->image_lib->initialize($configcrop);
    $CI->image_lib->crop();
    $CI->image_lib->clear();
}
