<?php
class Utilisateur
{
    private $pdo;
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $email;
    private $motDePasse;
    private $date_naissance;
    private $genre;
    private $preference;
    private $bio;
    private $localisation;
    private $dateInscription;

    public function __construct(array $data = []) {
        $this->hydrate($data);
    }


    private function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Vérifie si un utilisateur avec cet e-mail existe et renvoie ses informations
   
    public function getId()
    {
        return $this->id;
    }


    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    public function setDateNaissance($date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPreference()
    {
        return $this->preference;
    }

    public function setPreference($preference): self
    {
        $this->preference = $preference;

        return $this;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getLocalisation()
    {
        return $this->localisation;
    }

    public function setLocalisation($localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }
    public function getDateInscription()
    {
        return $this->dateInscription;
    }


    public function setDateInscription($dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }
}
?>