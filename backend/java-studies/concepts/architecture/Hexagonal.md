## Hexagonal arch concepts and overview

Objetivamente, a arquitetura hexagonal, também conhecida como "ports and adapters" consiste em uma arquitetura onde o domínio independe de ferramentas externas, framework, db e etc..
Para que o modelo permaneça integro, ele disponibiliza portas que são interfaces para a comunicação com adapters, que é onde fica a implementação dessas ferramentas externas. Com isso, quando precisarmos substituir alguma ferramenta externa, só mudamos os adapters, tornando o software mais flexivel.