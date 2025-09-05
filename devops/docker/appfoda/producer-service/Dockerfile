# 1️⃣ Escolhe uma imagem base com Java
FROM openjdk:17-jdk-alpine

# 2️⃣ Define um argumento para o nome do JAR gerado pelo Maven
ARG JAR_FILE=target/producer-service-0.0.1-SNAPSHOT.jar

# 3️⃣ Copia o JAR para dentro da imagem
COPY ${JAR_FILE} app.jar

# 4️⃣ Define o comando que será executado quando o container iniciar
ENTRYPOINT ["java","-jar","/app.jar"]
