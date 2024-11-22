# CHAPTER 8: VARIABLES

## Declare a Table Variable

```sql
    DECLARE @Employees TABLE
    (
    EmployeeID INT NOT NULL PRIMARY KEY,
    FirstName NVARCHAR(50) NOT NULL,
    LastName NVARCHAR(50) NOT NULL,
    ManagerID INT NULL
    )
```
<hr>
Ao criar uma tabela normal, utilizamos a sintaxe 'CREATE TABLE Name (Columns)'. Ao criar uma tabela variavel, utilizamos a sintaxe 'DECLARE @Name TABLE (Columns)'

Para referênciar uma tabela dentro de um SELECT, o SQL Server obriga você a declarar um alias para a tabela, caso contrário retornará um erro.

```sql
    DECLARE @Table1 TABLE (Example INT)
    DECLARE @Table2 TABLE (Example INT)
    /*
    -- the following two commented out statements would generate an error:
    SELECT *
    FROM @Table1
    INNER JOIN @Table2 ON @Table1.Example = @Table2.Example
    SELECT *
    FROM @Table1
    WHERE @Table1.Example = 1
    */
    -- but these work fine:
    SELECT *
    FROM @Table1 T1
    INNER JOIN @Table2 T2 ON T1.Example = T2.Example
    SELECT *
    FROM @Table1 Table1
    WHERE Table1.Example = 1
```

<br>
<hr>
<br>

## Updating variables using SELECT

É possível atualizar multiplas variáveis de uma vez utilizando SELECT

```sql
    DECLARE @Variable1 INT, @Variable2 VARCHAR(10)
    SELECT @Variable1 = 1, @Variable2 = 'Hello'
    PRINT @Variable1
    PRINT @Variable2
```

Ao atualizar uma variável utilizando SELECT, caso sejam vários valores, o útlimo será o valor considerado, ao menos que exista parâmetro de filtro.

```sql
    CREATE TABLE #Test (Example INT)
    INSERT INTO #Test VALUES (1), (2)
    DECLARE @Variable INT
    SELECT @Variable = Example
    FROM #Test
    ORDER BY Example ASC
    PRINT @Variable
    -- return: 2
```
- Exemplo de parâmetro pra filtrar

```sql
    SELECT TOP 1 @Variable = Example
    FROM #Test
    ORDER BY Example ASC
    PRINT @Variable
    -- return: 1
```
- Se não houver linhas retornadas para a consulta, o valor da variável não muda.

```sql
    SELECT TOP 0 @Variable = Example
    FROM #Test
    ORDER BY Example ASC
    PRINT @Variable
    -- still return: 1
```

<br>
<hr>
<br>

### Declare multiple variables at once, with initial values:

```sql
    DECLARE
    @Var1 INT = 5,
    @Var2 NVARCHAR(50) = N'Hello World',
    @Var3 DATETIME = GETDATE()
```

<br>
<hr>
<br>

### Updating a variable using SET

```sql
    DECLARE @VariableName INT
    SET @VariableName = 1
    PRINT @VariableName
    -- return: 1
```
- Utilizando o SET podemos atualizar apenas 1 variável por vez.

<br>
<hr>
<br>

## Updating variables by selecting from a table

Dependendo da estrutura dos seus dados, você pode criar variáveis que atualizam dinamicamente.

```sql
    DECLARE @CurrentID int = (SELECT TOP 1 ID FROM Table ORDER BY CreateDate desc)
    DECLARE @Year int = 2014
    DECLARE @CurrentID int = (SELECT ID FROM Table WHERE Year = @Year)
```

- Na maioria dos casos, é preciso garantir que a consulta retorne apenas um valor quando se utiliza esse método

<br>
<hr>
<br>

## Compound assignment operators
> ### Supported compound operators:
> - += Add and assign
> - -= Subtract and assign
> - *= Multiply and assign
> - /= Divide and assign
> - %= Modulo and assign
> - &= Bitwise AND and assign
> - ^= Bitwise XOR and assign
> - |= Bitwise OR and assig

### Example usage:
```sql
    DECLARE @test INT = 42;
    SET @test += 1;
    PRINT @test; --43
    SET @test -= 1;
    PRINT @test; --42
    SET @test *= 2
    PRINT @test; --84
    SET @test /= 2;
    PRINT @test; --42
```
