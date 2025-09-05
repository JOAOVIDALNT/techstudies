- mvn clean package -DskipTests
em cada um dos serviços pra gerar o .jar em target/

- docker-compose up --build
pra subir os containers. Lembre que é necessário a definição do Dockerfile

O compose é bem simples, todas as definições pro uso dessas aplicações estão documentadas no próprio arquvivo docker-compose.

Vou replicar esse mesmo exemplo utilizando kubernetes, que tem o mesmo propósito de orquestração que o docker-compose, só que muito mais poderoso, escalável, de alta disponibilidade, podendo fazer balanceamento de carga, reinicio automatico e etc.

O compose continua ótimo para desenvolvimento e testes rápidos.