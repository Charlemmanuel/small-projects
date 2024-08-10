using CharlyStore.Models.Entities;
using Microsoft.EntityFrameworkCore;

namespace CharlyStore.Data;

    public class CharlesDb: DbContext
    {
        public CharlesDb(DbContextOptions<CharlesDb> options): base(options)
        {
            
        }

    public DbSet<Client> clients { get; set; }

   
}

