<?php
session_start();
foreach ($_SESSION['cart'] as $cart_data) {
    echo '<div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span class="ml-2"><a href="index.php"
        class="text-dark text-decoration-none"> Continue Shopping</a></span>';
    echo '</div>';
    echo '<hr>';
    echo '<h6 class="mb-0">Your Cart</h6>';
    echo '<div class="d-flex justify-content-between">';
    echo '<span>You have ' . count($_SESSION['cart']) . ' items in your cart</span>';
    echo ' </div>';
    echo '<div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">';
    echo '<div class="d-flex flex-row">';
    echo ' <div class="ml-2">';
    echo ' <span class="font-weight-bold d-block">' . $cart_data['name'] . '</span>';
    echo '<span class="spec"> ' . $cart_data['ticket_type'] . '</span>';
    echo ' </div>';
    echo ' </div>';
    echo '<span class="d-block ml-5 font-weight-bold">$' . $cart_data['price'] . '</span>';
    echo '<div class="d-flex flex-row align-items-center">';
    echo '<button class="border-0 btn" onclick="updateQuantity(' . $cart_data['ticket_type_id'] . ', \'decrease\')">-</button>';
    echo '<input type="number" name="quantity" class="quantity-input form-control mx-2 text-center" value="' . $cart_data['quantity'] . '" min="1">';
    echo '<button class="border-0 btn" onclick="updateQuantity(' . $cart_data['ticket_type_id'] . ', \'increase\')">+</button>';
    echo '<span class="d-block ml-5 font-weight-bold">$' . ($cart_data['quantity'] * $cart_data['price']) . '</span>';
    echo '<a class="text-danger ml-3" href="?remove=' . $cart_data['ticket_type_id'] . '"><i class="fa-solid fa-trash"></i></a>';
    echo '</div>';
    echo '</div>';
}
$newCartHTML = ob_get_clean();
echo $newCartHTML;
?>