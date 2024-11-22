# CHAPTER 9: DATES

## Formating using CONVERT

É possível usar a função CONVERT para converter um dado datetime para uma string formatada.

```sql
SELECT GETDATE() AS [Result] -- return: data atual
```

Também existem algumas formatações padrão para formatos específicos. Aqui está a lista de opções do SQL Server:

```sql
DECLARE @convert_code INT = 100 -- references: table
SELECT CONVERT(VARCHAR(30), GETDATE(), @convert_code) AS [Result]
```

> - 100 "Jul 21 2016 7:56AM"
> - 101 "07/21/2016"
> - 102 "2016.07.21"
> - 103 "21/07/2016"
> - 104 "21.07.2016"
> - 105 "21-07-2016"
> - 106 "21 Jul 2016"
> - 107 "Jul 21, 2016"
> - 108 "07:57:05"
> - 109 "Jul 21 2016 7:57:45:707AM"
> - 110 "07-21-2016"
> - 111 "2016/07/21"
> - 112 "20160721"
> - 113 "21 Jul 2016 07:57:59:553"
> - 114 "07:57:59:553"
> - 120 "2016-07-21 07:57:59"
> - 121 "2016-07-21 07:57:59.553"
> - 126 "2016-07-21T07:58:34.340"
> - 127 "2016-07-21T07:58:34.340"
> - 130 "16 ???? 1437 7:58:34:340AM"
> - 131 "16/10/1437 7:58:34:340AM"

```sql
SELECT GETDATE() AS [Result] -- 2016-07-21 07:56:10.927
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),100) AS [Result] -- Jul 21 2016 7:56AM
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),101) AS [Result] -- 07/21/2016
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),102) AS [Result] -- 2016.07.21
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),103) AS [Result] -- 21/07/2016
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),104) AS [Result] -- 21.07.2016
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),105) AS [Result] -- 21-07-2016
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),106) AS [Result] -- 21 Jul 2016
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),107) AS [Result] -- Jul 21, 2016
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),108) AS [Result] -- 07:57:05
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),109) AS [Result] -- Jul 21 2016 7:57:45:707AM
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),110) AS [Result] -- 07-21-2016
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),111) AS [Result] -- 2016/07/21
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),112) AS [Result] -- 20160721
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),113) AS [Result] -- 21 Jul 2016 07:57:59:553
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),114) AS [Result] -- 07:57:59:553
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),120) AS [Result] -- 2016-07-21 07:57:59
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),121) AS [Result] -- 2016-07-21 07:57:59.553
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),126) AS [Result] -- 2016-07-21T07:58:34.340
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),127) AS [Result] -- 2016-07-21T07:58:34.340
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),130) AS [Result] -- 16 ???? 1437 7:58:34:340AM
UNION SELECT CONVERT(VARCHAR(30),GETDATE(),131) AS [Result] -- 16/10/1437 7:58:34:340AM
```
<br>
<hr>
<br>

## Date & Time formatting using FORMAT

é possível utilizar a nova função FORMAT()
Com isso, você consegue transformar seu campo DATETIME dentro de um VARCHAR customizado.

```sql
DECLARE @Date DATETIME = '2016-09-05 00:01:02.333'
SELECT FORMAT(@Date, N'dddd, MMMM dd, yyyy hh:mm:ss tt')

-- return: Monday, September 05, 2016 12:01:02 AM
```

## Arguments
- Para o DATETIME 2023-01-13 00:20:03.333, o próximo gráfico mostra quais seriam as saidas para cada argumento:

<br>

| Argument | Output |
|------|------|
| yyyy  | 2016  |
| yy  | 16  |
| MMMM | September |
| MM | 09 |
| M | 9 |
| dddd | Monday |
| ddd | Mon |
| dd | 05 |
| d | 5 |
| HH | 00 |
| H | 0 |
| hh | 12 |
| h | 12 |
| mm | 01 |
| m | 1 |
| ss | 02 |
| s | 2 |
| tt | AM |
| t  | A |
| fff | 333 |
| ff | 33 |
| f | 3 |

<hr>

- Você pode fornecer um único argumento para a função FORMAT() para gerar uma saída pre-formatada:

```sql
DECLARE @Date DATETIME = '2016-09-05 00:01:02.333'
SELECT FORMAT(@Date, N'U')
-- return: Monday, September 05, 2016 4:01:02 AM
```
| Single Argument | Output |
|------|------|
| D | Monday, September 05, 2016 |
| d | 9/5/2016 |
| F | Monday, September 05, 2016 12:01:02 AM |
| f | Monday, September 05, 2016 12:01 AM |
| G | 9/5/2016 12:01:02 AM |
| g | 9/5/2016 12:01 AM |
| M | September 05 |
| O | 2016-09-05T00:01:02.3330000 |
| R | Mon, 05 Sep 2016 00:01:02 GMT |
| s | 2016-09-05T00:01:02 |
| T | 12:01:02 AM |
| t | 12:01 AM |
| U | Monday, September 05, 2016 4:01:02 AM |
| u | 2016-09-05 00:01:02Z |
| Y | September, 2016 |

- Acima estamos utilizando a cultura americana (en-US culture). Podemos específicar uma cultura diferente utilizando um terceiro parâmetro no FORMAT()

```sql
    DECLARE @Date DATETIME = '2016-09-05 00:01:02.333'
    SELECT FORMAT(@Date, N'U', 'zh-cn')
    -- return: 2016年9月5日 4:01:02
```

## DATEADD for adding and substracting time periods

- General syntax:

```sql
DATEADD (datepart, number, datetime_expr)
```

- Para medidas de tempo, números positivos adicionam enquanto negativos reduzem.

```sql
    DECLARE @now DATETIME2 = GETDATE();
    SELECT @now; --2016-07-21 14:39:46.4170000
    SELECT DATEADD(YEAR, 1, @now) --2017-07-21 14:39:46.4170000
    SELECT DATEADD(QUARTER, 1, @now) --2016-10-21 14:39:46.4170000
    SELECT DATEADD(WEEK, 1, @now) --2016-07-28 14:39:46.4170000
    SELECT DATEADD(DAY, 1, @now) --2016-07-22 14:39:46.4170000
    SELECT DATEADD(HOUR, 1, @now) --2016-07-21 15:39:46.4170000
    SELECT DATEADD(MINUTE, 1, @now) --2016-07-21 14:40:46.4170000
    SELECT DATEADD(SECOND, 1, @now) --2016-07-21 14:39:47.4170000
    SELECT DATEADD(MILLISECOND, 1, @now)--2016-07-21 14:39:46.4180000
```

- Note que DATEADD também aceita abreviações no parâmetro datepart. O uso dessas abreviações geralmente é desencorajador e também pode ser confuso.

## Create a function to calculate a person's age on a specific date

Essa função vai pegar 2 parâmetros datetimes, the DOB, and a date to check the age at

```sql
    CREATE FUNCTION [dbo].[Calc_Age]
    (
    @DOB datetime , @calcDate datetime
    )
    RETURNS int
    AS
    BEGIN
    declare @age int
    IF (@calcDate < @DOB )
    RETURN -1
    -- If a DOB is supplied after the comparison date, then return -1
    SELECT @age = YEAR(@calcDate) - YEAR(@DOB) +
    CASE WHEN DATEADD(year,YEAR(@calcDate) - YEAR(@DOB)
    ,@DOB) > @calcDate THEN -1 ELSE 0 END

    RETURN @age

    END
```
```sql
    --eg to check the age today of someone born on 1/1/2000
    SELECT dbo.Calc_Age('2000-01-01',Getdate())
```

## Get the current DateTime

As funções nativas GETDATE and GETUTCDATE cada uma retorna a data e tempo atuais sem o timezone offset. <br>
<br>
O valor retornado de ambas as funções é baseado no sistema operacional do computador em que a instância do SQL Server está rodando. <br><br>

O valor de retorno do GETDATE representa o tempo atual no mesmo timezone do sistema operacional. O valor retornado pelo GETUTCDATE representa o UTC time atual. <br><br>

Ambas as funções podem ser incluidas em uma claúsula <strong>SELECT</strong> em uma consulta ou como parte de uma expressão booleana em uma claúsula <strong>WHERE</strong><br><br>

### Examples
```sql
    -- example query that selects the current time in both the server time zone and UTC
    SELECT GETDATE() as SystemDateTime, GETUTCDATE() as UTCDateTime
    -- example query records with EventDate in the past.
    SELECT * FROM MyEvents WHERE EventDate < GETDATE()
```
There are a few other built-in functions that return different variations of the current date-time:
```sql
    SELECT
    GETDATE(), --2016-07-21 14:27:37.447
    GETUTCDATE(), --2016-07-21 18:27:37.447
    CURRENT_TIMESTAMP, --2016-07-21 14:27:37.447
    SYSDATETIME(), --2016-07-21 14:27:37.4485768
    SYSDATETIMEOFFSET(),--2016-07-21 14:27:37.4485768 -04:00
    SYSUTCDATETIME() --2016-07-21 18:27:37.4485768
```

