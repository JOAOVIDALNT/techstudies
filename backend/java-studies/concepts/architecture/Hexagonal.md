## Hexagonal arch concepts and overview

Objetivamente, a arquitetura hexagonal, também conhecida como "ports and adapters" consiste em uma arquitetura onde o domínio independe de ferramentas externas, framework, db e etc..
Para que o modelo permaneça integro, ele disponibiliza portas que são interfaces para a comunicação com adapters, que é onde fica a implementação dessas ferramentas externas. Com isso, quando precisarmos substituir alguma ferramenta externa, só mudamos os adapters, tornando o software mais flexivel.

### Estrutura

Como estrutura, as partes essenciais, que são denominadores comuns de todas as minhas referências, são as seguintes:

- Domain -> parecido com o que já temos em Clean Arch deve guardar a estrutura integra dos modelos em Models e além disso, dispõe das Ports, que podemos segregar entre in e out, sendo in tudo aquilo que chega pra ser tratado e out tudo o que a nossa aplicação dispõe pra serviços externos ex: db (imagino que exhanges também) !PESQUISAR.

Um exemplo de estrutura de dominio que curti:

domain
    model (pure entities)
    port
        in (UseCases (contract))
        out (RepositoryPort (contract))
    service (services that implements usecases with pure entites calling repository port)
adapter
    in 
        web
            controller
    out
        persistence
            entity
            repository
            mapper (optional)
            OrderRepositoryAdapter -> implement repositoryPort and use jpa (or any other) repository definition
config
    AppConfig -> define beans for UseCases, should receive dependenci by parameter and return the service who implements the usecase

Observações
- podemos também estruturar com um package "application" e transferir o services e usecases pra lá.
- Pensei em também adaptar sufixos useCases para ServicePort, nomemclatura passa a fazer mais sentido no contexto geral.



