# Infrastructure migrations
Eu costumava usar o visual studio com nuget console pra administrar migrations, então quando precisei usar o cli do dotnet ef, encontrei o seguinte problema pra projeto com DDD:
via CLI a definição do startup project não é feita automaticamente, por isso é preciso rodar assim:

```bash 
dotnet ef migrations add InitialMigration
  --project projeto.Infrastructure
  --startup-project projeto.API
```