
## Fundamentos do Modelo Rico no Contexto de DDD

Domain-Driven Design (DDD) promove o modelo rico como padrão central para representação do domínio de negócios. Esta abordagem vai além da simples estruturação de dados, transformando as entidades em representações inteligentes do negócio.

### Princípios Essenciais:

1. **Comportamento sobre Dados**: As classes não são meros recipientes de dados, mas sim representações ativas das regras e processos de negócio.
    
2. **Encapsulamento Rigoroso**: Os detalhes de implementação são escondidos, expondo apenas interfaces significativas para o domínio.
    
3. **Responsabilidade Clara**: Cada objeto tem responsabilidades bem definidas dentro do contexto limitado (Bounded Context).

## Componentes do Modelo Rico em DDD

## **1. Entities (Entidades)**

### **O que são?**

- Objetos com **identidade única** que persistem ao longo do tempo.
    
- São **mutáveis** (seu estado pode mudar, mas sua identidade permanece).
    
- Exemplos: `Cliente`, `Pedido`, `ContaBancaria`.
    

### **Características**

✅ **Identidade única**: Dois clientes com o mesmo nome são diferentes se tiverem IDs diferentes.  
✅ **Comportamento encapsulado**: Regras de negócio ficam dentro da entidade.  
✅ **Ciclo de vida gerenciado**: Podem ser criados, modificados e excluídos.

### **Exemplo**

```java
public class Cliente {
    private UUID id; // Identidade única
    private String nome;
    private Email email; // Value Object
    
    public void alterarEmail(Email novoEmail) {
        if (novoEmail == null) throw new IllegalArgumentException("Email inválido");
        this.email = novoEmail;
    }
}
```
## **2. Value Objects (Objetos de Valor)**

### **O que são?**

- Representam **características imutáveis** sem identidade única.
    
- São definidos **pelos seus atributos**, não por um ID.
    
- Exemplos: `Endereço`, `Dinheiro`, `DataRange`.
    

### **Características**

✅ **Imutáveis**: Uma vez criados, não mudam (evitam efeitos colaterais).  
✅ **Sem identidade**: Dois Value Objects com os mesmos valores são considerados iguais.  
✅ **Comportamento autônomo**: Podem ter lógica de validação e operações.

### **Exemplo**
```java
public final class Endereco {
    private final String rua;
    private final String cidade;
    private final String cep;

    public Endereco(String rua, String cidade, String cep) {
        this.rua = Objects.requireNonNull(rua);
        this.cidade = Objects.requireNonNull(cidade);
        this.cep = validarCep(cep); // Lógica de validação interna
    }

    // Métodos de acesso, mas sem setters (imutável)
}
```

## **3. Aggregates (Agregados)**

### **O que são?**

- Um **grupo de entidades e value objects** tratados como uma **única unidade**.
    
- Possui uma **Aggregate Root (Raiz de Agregado)**, que é o ponto de entrada para operações.
    
- Garante **consistência transacional** dentro do agregado.
    

### **Regras Importantes**

🔹 **Acesso externo só pela raiz** (ex.: `Pedido` controla `ItensPedido`).  
🔹 **Invariantes devem ser mantidas** (ex.: Um pedido não pode ter valor negativo).  
🔹 **Transações não devem cruzar agregados** (use Domain Events para comunicação).

### **Exemplo**

```java
public class Pedido { // Aggregate Root
    private UUID id;
    private List<ItemPedido> itens; // Entidade dentro do agregado
    private StatusPedido status;

    public void adicionarItem(Produto produto, int quantidade) {
        if (status == StatusPedido.FINALIZADO) {
            throw new IllegalStateException("Pedido já finalizado");
        }
        itens.add(new ItemPedido(produto, quantidade));
    }
}
```

## **4. Domain Services (Serviços de Domínio)**

### **O que são?**

- **Operações que não pertencem naturalmente a uma entidade ou value object**.
    
- Representam **regras de negócio que envolvem múltiplos agregados** ou lógica complexa.
    
- Exemplos: `TransferenciaBancariaService`, `ProcessadorDePagamentos`.
    

### **Quando usar?**

✔ **Quando a operação não faz parte de um objeto específico**.  
✔ **Quando coordena múltiplas entidades**.  
✔ **Quando envolve infraestrutura externa** (ex.: chamadas a APIs).

### **Exemplo**

```java
public class TransferenciaBancariaService {
    public void transferir(Conta origem, Conta destino, BigDecimal valor) {
        if (origem == destino) throw new IllegalArgumentException("Contas iguais");
        origem.debitar(valor); // Lógica dentro da entidade Conta
        destino.creditar(valor);
        // Pode publicar um Domain Event se necessário
    }
}
```


## **5. Domain Events (Eventos de Domínio)**

### **O que são?**

- **Notificações de algo relevante que aconteceu no domínio**.
    
- Permitem **desacoplar componentes** e reagir a mudanças.
    
- Exemplos: `PedidoConfirmadoEvent`, `SaldoInsuficienteEvent`.
    

### **Quando usar?**

✔ **Para comunicação entre agregados** (evitando acoplamento direto).  
✔ **Para disparar ações secundárias** (ex.: enviar e-mail após um pedido).  
✔ **Para auditoria e rastreabilidade**.

### **Exemplo**

```java
public class PedidoConfirmadoEvent {
    private UUID pedidoId;
    private LocalDateTime dataConfirmacao;
    // Outros dados relevantes
}

// Na raiz do agregado (Pedido):
public void confirmar() {
    this.status = StatusPedido.CONFIRMADO;
    DomainEvents.publish(new PedidoConfirmadoEvent(this.id, LocalDateTime.now()));
}
```

## **Resumo Final**

|Conceito|Descrição|Exemplo|
|---|---|---|
|**Entity**|Objeto com identidade única e estado mutável|`Cliente`, `Pedido`|
|**Value Object**|Objeto imutável sem identidade|`Endereco`, `Dinheiro`|
|**Aggregate**|Grupo de entidades/vOs com uma raiz|`Pedido` (contém `ItensPedido`)|
|**Domain Service**|Lógica que não pertence a uma entidade|`TransferenciaBancariaService`|
|**Domain Event**|Notificação de algo importante|`PedidoConfirmadoEvent`|

### **Principais Benefícios**

✅ **Clareza**: O código reflete o negócio.  
✅ **Encapsulamento**: Regras ficam onde fazem sentido.  
✅ **Consistência**: Invariantes são protegidas.  
✅ **Flexibilidade**: Eventos permitem extensão sem acoplamento.


