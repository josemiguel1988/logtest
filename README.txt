REST API para criação de utilizadores

Requisitos (Windows):
1 - Xampp
2 - Composer
3 - Postman

Procedimentos:
1 - Colocar a pasta depois de descomprimida na pasta htdocs do xampp (nome do projeto pode ser alterado para LogTest).
2 -  Ter no Xampp Control Panel a opção Apache e MySql a correr.
3 - No url http://localhost/phpmyadmin/ criar uma nova base de dados chamada logtest.
4 - Através da linha de comandos aceder a pasta e dentro dela executar php artisan migrate para carregar as tabelas e composer i para atualizar o projecto.
5 - Abrindo o postman adicionar os seguintes endpoints:
  5.1 - POST http://localhost/LogTest/public/api/users
  5.2 - GET http://localhost/LogTest/public/api/users
  5.3 - DELETE http://localhost/LogTest/public/api/users/{id}
  5.4 - PUT http://localhost/LogTest/public/api/users/{id}
  5.5 - GET http://localhost/LogTest/public/api/users/{id}
6 - O 5.1 e o 5.4 necessita de um body em JSON com os seguintes dados preenchidos:
    6.1 - name (string) 
    6.2 - email (email válido)
    6.3 - birthday (string data no formato YYYY-MM-DD
    6.4 - gender (string)
    Nota: O email é validado nos 2 endpoints de modo a que não haja 2 utilizadores com o mesmo email.
7 - Os endpoints 5.3,5.4 e 5.5 é necessário indicar o id do utilizador no url para validar se ele existe na bd e caso exista fazer a respetiva ação, caso contrário mensagem de erro.   
