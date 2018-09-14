<?php

Route::middleware(['web'])
->post(
    'easy-upload-lib/upload-file',
    'Novius\EasyUpload\Http\Controllers\EasyUploadController@upload'
)->name('easyupload.upload-file');
