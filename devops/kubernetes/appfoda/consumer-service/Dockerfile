# Escolhe uma imagem base com Java
FROM openjdk:17-jdk-alpine

# Define um argumento para o nome do JAR gerado pelo Maven
ARG JAR_FILE=target/consumer-service-0.0.1-SNAPSHOT.jar

# Copia o JAR para dentro da imagem
COPY ${JAR_FILE} app.jar

# Define o comando que será executado quando o container iniciar
ENTRYPOINT ["java","-jar","/app.jar"]