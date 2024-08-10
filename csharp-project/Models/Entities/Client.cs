using System.ComponentModel.DataAnnotations;

namespace CharlyStore.Models.Entities
{
    // Modèle représentant un client
    public class Client
    {
        // Clé primaire de l'entité
        [Key]
        public int Id { get; set; }

        // Nom du client, requis
        [Required(ErrorMessage = "Le champ Nom est requis.")]
        public string Name { get; set; }

        // Date de naissance du client, requis
        [Required(ErrorMessage = "Le champ Date de naissance est requis.")]
        public DateOnly Birthday { get; set; }

        // Numéro de téléphone du client, requis
        [Required(ErrorMessage = "Le champ Téléphone est requis.")]
        public string Phone { get; set; }

        // Produit acheté par le client, requis
        [Required(ErrorMessage = "Le champ Produit est requis.")]
        public string Produit { get; set; }

        // Date de l'achat, initialisée à la date et heure actuelles
        public DateTime Date { get; set; } = DateTime.Now;
    }
}
