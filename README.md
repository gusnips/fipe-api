# fipe-api

## How to install

Edit fipe_con to use your mysql connection user/password and database  

Create the database and import data

In mysql: `create database fipe`

Import initial data: `mysql -uroot -p fipe < fipe.sql`

Run in your browser fipe_form.php and start the process to import the data  

Run localhost/fipe-api/api/fipe.php?cod=004481-4 to get the car data  

## Webservices  

`/api/fipe.php?cod=004481-4` nome do carro pela fipe  

`/api/marcas.php` lista de marcas  

`/api/veiculos.php?cod=21` lista de carros de uma marca, passando id da marca

`/api/veiculo.php?cod=4828` lista de anos de um modelo, passando id do modelo

`/api/veiculoano.php?cod=4828&ano=2013-1` dados de um carro, passando id do modelo e id do ano

## Add webservices

api folder has the webservice api's, edit as your will  

## Update

run localhost/fipe_form.php and start the process
