using System;
using System.ComponentModel.DataAnnotations;

namespace CharlyStore.Models
{
    // Modèle utilisé pour l'achat d'un produit
    public class AcheterProduit
    {
        // Clé primaire de l'entité
        [Key]
        public int Id { get; set; }

        // Nom de l'acheteur, requis
        [Required(ErrorMessage = "Le champ Nom est requis.")]
        public string Name { get; set; }

        // Date de naissance de l'acheteur, requis
        [Required(ErrorMessage = "Le champ Date de naissance est requis.")]
        public DateOnly Birthday { get; set; }

        // Numéro de téléphone de l'acheteur, requis
        [Required(ErrorMessage = "Le champ Téléphone est requis.")]
        public string Phone { get; set; }

        // Produit acheté, requis
        [Required(ErrorMessage = "Le champ Produit est requis.")]
        public string Produit { get; set; }

        // Date de l'achat, initialisée à la date et heure actuelles
        public DateTime Date { get; set; } = DateTime.Now;
    }
}
