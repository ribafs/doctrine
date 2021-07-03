# Tutorial do Doctrine 2 ORM

Tradução da algo deste tutorial e adição de algumas funcionalidades, como um CRUD para a tabela 

customers: id, name, email e ssn

Este é o código para o tutorial do Doctrine 2 ORM

Este tutorial agora usa somente composer. Pode encontrar o tutorial em:

https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html

## Installação:

Podemos clonar/efetuar download do repositório em

https://github.com/doctrine/doctrine2-orm-tutorial

Ou baixar via git com:

```bash
git clone https://github.com/doctrine/doctrine2-orm-tutorial.git  # or: git clone git@github.com:doctrine/doctrine2-orm-tutorial.git

cd doctrine2-orm-tutorial

composer install
```
O mais importante é ter o Entity Manager ($entityManager) disponível e o cli-config.php configurado corretamente.

## Configuração do banco de dados

O tutorial original usa o sqlite, mas usarei o mysql

Edite o bootstrap.php

E verá a configuração abaixo:

$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'teste2',
);

Veja que no arquivo acima ele define as tabelas nos arquivos da pasta src, sendo um para cada tabela e mais um que é um repositório para a bugs

## Anotation

Em src, estes arquivos definem a estrutura das tabelas através das propriedades.

Como exemplo, vejamos o Product.php

<?php
/**
 * @Entity @Table(name="products")
 */
class Product
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="string") */
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

Estes arquivos definem as tabelas especialmente nos comemntários, que não são comentários comuns.

O nome da tabela = products

Os nomes dos campos e seus tipos:

id - integer e AUTO_INCREMENT (indicado pelo @GeneratedValue)

name - string

Abaixo ele define os método getter e setter:

- getId(), visto que é auto incremento não precisa de getId()

- getName()

- setName($name)


Tendo este arquivo como modelo criarei um para a tabela clients

src/Customer.php

<?php
/**
 * @Entity @Table(name="customers")
 */
class Customer
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;
    /** @Column(type="string", length=40) */
    protected $name;
    /** @Column(type="string", length=40) */
    protected $email;
    /** @Column(type="string",length=15) */
    protected $ssn;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSsn()
    {
        return $this->ssn;
    }

    public function setSsn($ssn)
    {
        $this->ssn = $ssn;
    }
}

## Sequência

Sepois de definir os arquivos, executar os comandos

### Criar esquema do banco

    vendor/bin/doctrine orm:schema-tool:create

Verifique no MySQL se a tabela foi criada e se está correta.

## Adicionar registros

cd crud

php create_customer.php 'Ribamar FS' 'ribafs@gmail.com' '12312345'
php create_customer.php 'Elias EF' 'elias@gmail.com' '12317745'

Verifique no banco.

## Listar clientes

php list_customers.php

## Exibir um customers

php show_customer.php id

php show_customer.php 1

## Atualizar um customer

Alterar o nome do customer com id = 1

php update_customer.php <id> <new-name>|<new-email>|<new-ssn>

php update_customer.php 1 'Ribamar FS2'

Alterar o e-mail do customer com id = 1

php update_customer.php 1 'Ribamar FS' 'ribafs2@gmail.com' '12121'

Altero o campo que desejo ou vários e mantenho os damais

## Observação

Não precisamos usar os arquivos de config, apenas o arquivo em src.


