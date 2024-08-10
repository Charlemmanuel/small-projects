using CharlyStore.Data;
using CharlyStore.Models;
using CharlyStore.Models.Entities;
using Microsoft.AspNetCore.Mvc;

namespace CharlyStore.Controllers
{
    public class ClientsController : Controller
    {
        private readonly CharlesDb charlesDb;

        // Injecte l'instance de CharlesDb dans le contrôleur
        public ClientsController(CharlesDb charlesDb)
        {
            this.charlesDb = charlesDb;
        }

        // Affiche la vue d'achat (GET)
        [HttpGet]
        public IActionResult Acheter()
        {
            return View();
        }

        // Traite la demande d'achat (POST)
        [HttpPost]
        public async Task<IActionResult> Acheter(AcheterProduit cmd)
        {
            // Crée un nouveau client avec les données de la commande
            var client = new Client
            {
                Name = cmd.Name,
                Birthday = cmd.Birthday,
                Phone = cmd.Phone,
                Produit = cmd.Produit,
                Date = cmd.Date
            };

            // Ajoute le client à la base de données et sauvegarde les modifications
            await charlesDb.clients.AddAsync(client);
            await charlesDb.SaveChangesAsync();

            // Redirige vers la page de confirmation en passant l'ID du client
            return RedirectToAction("confirmation", new { clientId = client.Id });
        }

        // Affiche la vue de confirmation avec les détails du client (GET)
        [HttpGet]
        public async Task<IActionResult> Confirmation(int clientId)
        {
            // Recherche le client dans la base de données en utilisant son ID
            var client = await charlesDb.clients.FindAsync(clientId);
            if (client == null)
            {
                return NotFound();
            }

            return View(client);
        }
    }
}
