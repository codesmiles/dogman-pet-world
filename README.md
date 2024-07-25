# Dogman Pet World

## Commands

- ```create:admin-user``` -> Create a new Filament custom admin user user custom
- ```alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'``` -> command for configuring shell alias from ```./vendor/bin/sail``` to ```sail up```
- ```php artisan make:filament-relation-manager ClientResource Employee user_id``` -> command for relating  UserResource to Employee

## TO DO List

1. Work on how disabled fields work
2. work on the autorizations form admin and regular models
3. Properly format the form fields and table fields
4. the  "client_id",in the user model not being input into the filament form so i will work debugging the update fields.
5. formating the relation manager to do it work.
