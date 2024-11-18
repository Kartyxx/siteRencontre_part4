<?php
require 'bean/UtilisateurBean.php';

class Utilisateur
{
    private $pdo;



    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }






    


    // Vérifie si le mot de passe est correct
    public function verifierMotDePasse($mot_de_passe)
    {
        return password_verify($mot_de_passe, $this->motDePasse);
    }

    // Retourne l'ID de l'utilisateur connecté
    public function getId()
    {
        return $this->id;
    }

    public function seConnecter($email, $mot_de_passe)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        //Si l'email existe et que le mot de passe correspond, on est loggué et redirigé avec la page index
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return null;
    }










    public function createUser(array $utilisateur)
    {
        $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (nom, prenom, pseudo, email, mot_de_passe, date_naissance, genre, preference, bio, localisation) VALUES :nom, :prenom, :pseudo, :email, :mot_de_passe, :date_naissance, :genre, :preference, :bio, :localisation)");

        $mdp=password_hash($utilisateur["mot_de_passe"], PASSWORD_DEFAULT);

        $stmt->bindParam(':nom', $utilisateur["nom"], PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $utilisateur["prenom"], PDO::PARAM_STR);
        $stmt->bindParam(':pseudo', $utilisateur["pseudo"], PDO::PARAM_STR);
        $stmt->bindParam(':email', $utilisateur["email"], PDO::PARAM_STR);
        $stmt->bindParam(':date_naissance', $utilisateur["date_naissance"], PDO::PARAM_STR);
        $stmt->bindParam(':genre', $utilisateur["genre"], PDO::PARAM_STR);
        $stmt->bindParam(':preference', $utilisateur["preference"], PDO::PARAM_STR);
        $stmt->bindParam(':bio', $utilisateur["bio"], PDO::PARAM_STR);
        $stmt->bindParam(':localisation', $utilisateur["localisation"], PDO::PARAM_STR);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }


    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Utilisateur($data) : null;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Utilisateur($data) : null;

    }


    public function findAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $user){
            $users[]=new Utilisateur($user);
        }
        return $users;
    }

  
}
