<?php

namespace dao\ticusers;

use dao\DBConnection;
use PDO;

class UsersDAO
{

    public function getAllUsersDAO()
    {

        try {

            $users = (object)[];

            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $sql = "SELECT u.id, u.nombre, u.apellidos, 
                    (
                        (
                            SELECT COUNT(p.id_usuario) FROM permisos p WHERE p.id_usuario=u.id AND p.id_rol=4
                        ) > 0
                    ) AS is_tic
                    FROM users u";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (\Exception $exception) {

        } finally {
            $dbConnection->disconnect();
        }

        return $users;
    }

    public function modUserTic($id, $isTic)
    {

        try {
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $insertado = true;

            if ($isTic) {
                $stmt = $db->prepare("INSERT INTO permisos (id_usuario,id_rol) VALUES (:id,4)");
                $stmt->bindParam(":id", $id);
                $success = $stmt->execute();
            } else {
                $stmt = $db->prepare("DELETE FROM permisos WHERE id_usuario=:id AND id_rol=4");
                $stmt->bindParam(":id", $id);
                $success = $stmt->execute();
            }
        } catch (\Exception $exception) {
            $success = false;
        } finally {
            $dbConnection->disconnect();
        }
        return $success;
    }
}