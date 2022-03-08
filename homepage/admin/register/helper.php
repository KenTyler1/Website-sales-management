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

function get_user_info($conn, $mskh){
    $query = "SELECT hotenkh, username, tencongty, sodienthoai, sofax FROM khachhang WHERE mskh=?";
    $q = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $mskh);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);
    return empty($row) ? false : $row;
}

