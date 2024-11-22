## TRY_PARSE()

- Sintaxe: TRY_PARSE(string_value AS data_type [Using culture])

> - string value deve ser uma representação válida ou o TRY_PARSE retorna null (NVARCHAR(4000))
> - data type deve ser data ou numérico
> - culture é opicional para formatar, caso a cultura seja inválida retorna erro

```sql
    DECLARE @fakeDate AS varchar(10);
    DECLARE @realDate AS VARCHAR(10);
    SET @fakeDate = 'iamnotadate';
    SET @realDate = '13/09/2015';
    SELECT TRY_PARSE(@fakeDate AS DATE); --NULL as the parsing fails
    SELECT TRY_PARSE(@realDate AS DATE); -- NULL due to type mismatch
    SELECT TRY_PARSE(@realDate AS DATE USING 'Fr-FR'); -- 2015-09-13
```

<br>
<hr>
<br>

## Parse com TRY_CONVERT()

- Sintaxe: TRY_CONVERT(data_type [(length)], expression [, style])

em caso de sucesso, retorna o valor convetido, caso contrário retorna nulo.

- Style é um parâmetro opicional que determina a formatação, supondo que você quer a data "Jan, 13 2000" você deve informar o estilo '111'.

```sql
    DECLARE @sampletext AS VARCHAR(10);
    SET @sampletext = '123456';
    DECLARE @realDate AS VARCHAR(10);
    SET @realDate = '13/09/2015’;
    SELECT TRY_CONVERT(INT, @sampletext); -- 123456
    SELECT TRY_CONVERT(DATETIME, @sampletext); -- NULL
    SELECT TRY_CONVERT(DATETIME, @realDate, 111); -- Sep, 13 2015
```