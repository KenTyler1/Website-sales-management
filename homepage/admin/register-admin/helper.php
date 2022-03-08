<?php 

function validate_input_text($textValue){
    if (!empty($textValue)){
        $trim_text = trim($textValue);
        // Xóa kí tự không hợp lệ
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return '';
}


function get_admin_info($conn, $msnv){
    $query = "SELECT hotennv, username, chucvu, sodienthoai, diachi FROM nhanvien WHERE msnv=?";
    $q = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $msnv);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);
    return empty($row) ? false : $row;
}

