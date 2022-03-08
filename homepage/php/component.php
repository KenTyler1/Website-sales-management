<?php

function component($tenhh, $gia, $tenhinh, $mshh){
    $element = "
    
                        <div class=\"cartegory-right-content-item\">
                            <form action=\"category.php\" method=\"post\">
                                <a href=\"product.php\"><img src=\"$tenhinh\" alt=\"Image\"></a>
                                <h1>$tenhh</h1>
                                <p>$gia<sup>đ</sup></p>
                            </form>
                        </div>
    ";
    echo $element;
}

// function cartElement($tenhh, $gia, $tenhinh, $mshh){
//     $element = "
    
//     <form action=\"cart.php?action=remove&id=$mshh\" method=\"post\" class=\"cart-items\">
//                     <tr>
//                         <td><img src=\"$tenhinh\" alt=""></td>
//                         <td><p>$tenhh</p></td>
//                         <td><img src=\"image/spcolor.png\" alt=""></td>
//                         <td><input type=\"text\" value=\"1\" ></td>
//                         <td><p>$gia<sup>đ</sup></p></td>
//                         <td><span type=\"submit\" name=\"remove\">X</span></td>
//                     </tr>
//                 </form>
    
//     ";
//     echo  $element;
// }


