<?php

function createProduct($name,$price) {
    global $conn;
    $sql = "INSERT INTO produtos (nome, preco) VALUES ('$name', $price)";
    return $conn->query($sql);
}

function deleteProduct($id){
    global $conn;
    $sql = "DELETE FROM produtos WHERE id=$id";
    return $conn->query($sql);
}


?>
