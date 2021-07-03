# Alguns conceitos em Doctrine

## Entities

Entidades são objetos PHP que podem ser identificados em muitas solicitações por um identificador único ou chave primária. Essas classes não precisam estender nenhuma interface ou classe base abstrata. Uma classe de entidade não deve ser final ou conter métodos finais. Além disso, ele não deve implementar clone ou wakeup, a menos que o faça com segurança.

Uma entidade contém propriedades persistentes. Uma propriedade persistível é uma variável de instância da entidade que é salva e recuperada do banco de dados pelos recursos de mapeamento de dados do Doctrine.

## DQL

DQL não é SQL

Você pode se perguntar por que começamos a escrever SQL no início deste caso de uso. Não usamos um ORM para nos livrar de toda a infindável escrita manual de SQL? Doctrine apresenta DQL, que é melhor descrito como linguagem de consulta de objeto e é um dialeto de OQL e semelhante a HQL ou JPQL. Não conhece o conceito de colunas e tabelas, mas apenas aquelas de Entidade-Classe e propriedade. Usar os metadados que definimos antes permite consultas muito curtas, distintas e poderosas.

Uma razão importante pela qual o DQL é favorável à API de consulta da maioria dos ORMs é sua semelhança com o SQL. A linguagem DQL permite construções de consulta que a maioria dos ORMs não: GROUP BY mesmo com HAVING, Sub-selects, Fetch-Joins de classes aninhadas, resultados mistos com entidades e dados escalares como COUNT () resultados e muito mais. Usando DQL, você raramente chegará ao ponto em que deseja jogar seu ORM no dumpster, porque ele não oferece suporte a alguns dos conceitos SQL mais poderosos.

Se precisar construir sua consulta dinamicamente, você pode usar o QueryBuilder recuperado chamando $entityManager->createQueryBuilder(). Há mais detalhes sobre isso na parte relevante da documentação.

Como último recurso, você ainda pode usar SQL nativo e uma descrição do conjunto de resultados para recuperar entidades do banco de dados. O DQL se resume a uma instrução SQL nativa e uma instância ResultSetMapping em si. Usando o SQL nativo, você pode até usar procedimentos armazenados para recuperação de dados ou fazer uso de consultas avançadas de banco de dados não portáteis, como as consultas recursivas do PostgreSql.


