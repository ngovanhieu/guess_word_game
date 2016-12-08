<?php 

function set_active($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

//add image to Public folder
function uploadImage($image, $path, $delete = false) {
    try {
        if ($image) {
            $uploadDir = public_path(sprintf($path));

            if ($delete) {
                File::cleanDirectory($uploadDir);
            }

            $imageName= time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $imageName);

            return $imageName;
        }
    } catch (Exception $e) {
        Log::error($e);
    }

    return null;
}
