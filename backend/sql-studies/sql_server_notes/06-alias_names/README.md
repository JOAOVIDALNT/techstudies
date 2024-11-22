# CHAPTER 6: Alias

## Alias derivado de table name

```sql
    CREATE TABLE AliasNameDemo(id INT,firstname VARCHAR(20),lastname VARCHAR(20))
    INSERT INTO AliasNameDemo
    VALUES (1,'MyFirstName','MyLastName')
    SELECT *
    FROM (SELECT firstname + ' ' + lastname
    FROM AliasNameDemo) a (fullname)
```

<br>
<hr>
<br>

## Utilizando AS

```sql
    CREATE TABLE AliasNameDemo (id INT,firstname VARCHAR(20),lastname VARCHAR(20))
    INSERT INTO AliasNameDemo
    VALUES (1,'MyFirstName','MyLastName')
    SELECT FirstName +' '+ LastName As FullName
    FROM AliasNameDemo
```

<br>
<hr>
<br>

## Utilizando '='

```sql
    CREATE TABLE AliasNameDemo (id INT,firstname VARCHAR(20),lastname VARCHAR(20))
    INSERT INTO AliasNameDemo
    VALUES (1,'MyFirstName','MyLastName')
    SELECT FullName = FirstName +' '+ LastName
    FROM AliasNameDemo
```
<br>
<hr>
<br>

## Sem utilizar o AS

```sql
    CREATE TABLE AliasNameDemo (id INT,firstname VARCHAR(20),lastname VARCHAR(20))
    INSERT INTO AliasNameDemo
    VALUES (1,'MyFirstName','MyLastName')
    SELECT FirstName +' '+ LastName FullName
    FROM AliasNameDemo
```