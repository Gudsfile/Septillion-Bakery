
<?php
    class Connect
{
    public static function connexion() {
        try {
    return new PDO("mysql:host=localhost;dbname=septillion","root","123456");
        }
        catch(PDOException $e) {
            die('<h3>Erreur!</h3>');
        }
        return $bdd;
    }
}
?>
