<?php
class Ventas {


private  PDO $db;

public function __construct(PDO $db)
{
    $this->db = $db;
}

// Método para obtener todos los accesorios de los carros
public function getAll():array{
    $stmt = $this->db->query("SELECT v.id, nombreCliente, idProducto, p.nombre, cantidad, total from ventas v left join productos p on v.idProducto = p.id");
    return $stmt->fetchAll();  

}

public function findById(int $id): ?array{
    $stmt = $this->db->prepare("SELECT id, nombreCliente, idProducto, cantidad, total from ventas WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}


// Método para crear un nuevo accesorio
public function create (array $data):bool{
    $stmtP = $this->db->prepare("SELECT precio from productos WHERE id = :id");
    $stmtP->execute([':id' => $data['idProducto']]);
    $precio = $stmtP->fetch();

    $total = $precio['precio'] * $data['cantidad'];
    $data['total'] = $total;

    $stmt=$this->db->prepare("INSERT INTO ventas (nombreCliente, idProducto, cantidad, total) VALUES (:nombreCliente, :idProducto, :cantidad, :total)");
    return $stmt->execute([
        ':nombreCliente' => $data['nombreCliente'],
        ':idProducto' => $data['idProducto'],
        ':cantidad' => $data['cantidad'],
        ':total' => $data['total']
]);


}


//función para eliminar un usuario por su ID
public function delete(int $id):bool{
    $stmt = $this->db->prepare("DELETE FROM ventas WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}   


//Función para actualizar un usuario existente
function update(int $id, array $data):bool
{
    $stmt = $this->db->prepare("UPDATE ventas SET nombreCliente = :nombreCliente, idProducto = :idProducto, cantidad = :cantidad, total = :total WHERE id = :id");
    return $stmt->execute([
        ':id' => $id,
        ':nombreCliente' => $data['nombreCliente'],
        ':idProducto' => $data['idProducto'],
        ':cantidad' => $data['cantidad'],
        ':total' => $data['total']
    ]);
}







}



?>