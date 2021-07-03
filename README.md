# Doctrine 2 com PHP puro: ORM e DBAL

## O que é doctrine

O Doctrine é um wrapper/invólucro sobre o PDO. Ele adiciona algumas conveniências além do PDO direto, bem como um QueryBuilder/criador de consultas. É o mais popular projeto voltado para Database Storage e Object Mapping e é adotado pelos grandes frameworks em PHP.

A maior vantagem do Doctrine ORM é que ele cria uma cópia do seu banco de dados em forma de objetos, cada tabela tem a sua própria classe PHP e cada campo é uma variável. Esse conceito é chamado de entidade, ou seja, cada objeto (classe) é uma entidade do Doctrine ORM que pode ser usada para gerar o seu banco de dados completo, O Doctrine ORM dispensa o uso de classes para disponibilizar o banco de dados, ele é o model e o migration da sua aplicação.

Olhando por outro ângulo, cada entidade é também um registro no banco, cada vez que criamos um novo objeto e preenchemos seus atributos (variáveis) com dados estamos na verdade trabalhando com um registro no banco de dado, na sequência apenas dizemos ao Doctrine para realizar a ação final (rodar o comando SQL), esta tarefa é o flush.

Essa integração com ORM é perfeita para quem trabalha com Orientação a Objetos, você trata o banco como objeto PHP, não precisa se preocupar com nenhuma linha de SQL e se você perder o caminho, um simples var_dump te ajuda, afinal é tudo PHP.

Tanto facilida o uso do banco de dados como separa as camadas de negócios e de bancos de dados.

Doctrine ORM é um mapeador objeto-relacional (ORM) para PHP 7.1+ que fornece persistência transparente para objetos PHP. Ele usa o padrão Data Mapper no coração, visando uma separação completa entre o seu domínio e a lógica de negócios da persistência em um sistema de gerenciamento de banco de dados relacional.

O benefício do Doctrine para o programador é a capacidade de se concentrar na lógica de negócios orientada a objetos e se preocupar com a persistência apenas como um problema secundário. Isso não significa que a persistência seja minimizada pela Doutrina 2, no entanto, acreditamos que há benefícios consideráveis para a programação orientada a objetos se a persistência e as entidades forem mantidas separadas.

Pelo que vi até o momento o Doctrine é um assunto para usuários avançados. Digo isso pelo nível dos tutoriais e até da documentação oficial que parece se referir a quem já conhece o assunto. Em algumas partes da documentação oficial aborda um arquivo de configuração mas nem chega a dizer o nome do arquivo nem onde pode ser encotnrado. Isso me fez gastar um bom tempo procurando um exemplo simples, onde eu pudesse instalar (simples), configurar (demorei a entender) e criar um crud bem simples. Enrtei no grupo de PHP e somente dois colegas o usam. Elogiam mas não me ajudaram com tutoriais. Um deles falou que não acha a documentação dificil. Acredito, mas eu achei, pelo menos até começar a entender.

Que o Doctrine é muito bom nunca tive dúvidas. Isto porque sei que é usado pelos grandes frameworks PHP.

Até que encontrei este exemplo no Github

https://github.com/doctrine/doctrine2-orm-tutorial

Que segue a documentação oficial

https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/tutorials/getting-started.html

Como gostei muito do exemplo, que me salvou e o autor arquivou o repositório, então criei um fork e estou enriquecendo com dicas, tutoriais e outros exemplos.

Com este eu consegui andar. Executei com sucesso, customizei e criei alguns cruds de uma tabela minha para demonstração.

## Exemplos

Na pasta Exemplos tem exemplos do ORM (o original e mais quatro CRUDs que adicionei) e do DBAL (Dois CRUDs).

O Doctrine tem uma enorme quantidade de projetos. Aqui estou abordando apenas algumas coisas sobre dois projetos: ORM e DBAL. Trago aqui apenas o básico destes dois assuntos, que tem muito mais recursos. Aqui trago apenas o caminho das pedras, o pontapé para que você possa usar, ver se vale a pena e se valer se aprofundar nas ferramentas, se for o caso, pois o que estou mostrando sozinho já é útil.

## Docs
A pasta Docs vem com alguns PDFs de tutoriais que encontrei e com a documentação do ORM e do DBAL. Eu copiei para o LibreOffice toda ou quase documentação do ORM (173 páginas) e exportei para PDF e  também com o DBAL.

## Tools

Na apsta tools tem alguns exemplos raros que encontrei sobre o assunto. Alguns nem cheguei a testar.

Depois que consegui rodar o ORM, então fui atraz do DBAL, que já ouvi ser mais simples. Desta vez eu consegui entender um totorial que antes eu li mas não consegui fazer funcionar. Antes eu havia tentado fazer funcionar o DBAL seguindo a documentação oficial mas sem sucesso. Agora, depois de já entender como se configura (a configuração é a mesma para o ORM e para o DBAL) então consegui criar um CRUD com o DBAL, que realmente é muito mais simples que o ORM.

Agora consegui fazer algo de que gosto e me motiva bastante: pegar algo complexo, mas que seja útil e explicar de forma simples. Algo somente é complicado enquanto não enendemos. Mas tem coisa que mesmo sendo simples é trabalhosa. Meu objetivo maior, sempre que estudo algo e geralmente estudo para ensinar, é tornar simples e fácil, ou seja, que não dê trabalho.

Sinto ter conseguido isso com o Doctrine, tando com o ORM quanto com o DBAL. Sinceros votos de que eu tenha conseguido e que vocẽ possa tirar proveito desta excelente ferramenta.

## O que é DBAL

DBAL - Database Abstraction Layer. É o projeto do Doctrine que corresponde ao PDO. É a camada de abastração do banco de dados que facilita a codificação das operações com o banco de dados. Mas cada um de nós tem um certo background e muitas outras diferenças em relação aos outros. Então não vou dizer que é a solução ideal para você. Mas se você está aqui então que tal experimentar e ver se vale a penas para você usar? Teste e veja.

## Recursos do Doctrine
O projeto Doctrine tem muitos recursos. Aqui abordo somente (até o momento) o ORM e o DBAL. Vale ressaltar que aqui estou mostrando apenas o básico, pois agora estou aprendendo e tanto o ORM quando o DBAL tem uma enorme quantidade de recursos ainda não abordados e estou usando somente com PHP puro e me parece que isso já fica mais simples e melhor que usando PDO.
