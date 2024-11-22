# CHAPTER 7: NULLS

Varre os argumentos na ordem e retorna o valor da primeira opção que inicialmente não é nulla

<hr>

## COALESCE

```sql
    DECLARE @MyInt int -- variable is null until it is set with value.
    DECLARE @MyInt2 int -- variable is null until it is set with value.
    DECLARE @MyInt3 int -- variable is null until it is set with value.
    SET @MyInt3 = 3
    SELECT COALESCE (@MyInt, @MyInt2 ,@MyInt3 ,5) -- Returns 3 : value of @MyInt3.
```

<br>
<hr>
<br>

## ISNULL()
A função IsNull aceita dois parâmetros e retorna o segundo parâmetro se o primeiro for nulo

IsNull retorna o mesmo tipo de dado de check expression

```sql
DECLARE @MyInt int -- All variables are null until they are set with values.
SELECT ISNULL(@MyInt, 3) -- Returns 3.
```